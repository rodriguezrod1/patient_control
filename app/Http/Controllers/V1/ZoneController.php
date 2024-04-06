<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Zone;
Use App\Services\ZoneService;
use App\Traits\ApiResponser;


class ZoneController extends Controller
{

    use ApiResponser;

    protected $zoneService;

    public function __construct(ZoneService $zoneService)
    {
        $this->zoneService = $zoneService;
    }


    /**
     * @OA\Get(
     *    path="/api/zones",
     *    summary="List all zones",
     *    tags={"Zones"},
     *    @OA\Response(response="200", description="Returns list of all zones.")
     * )
     */
    public function index()
    {
        try {
            $zones = $this->zoneService->listAll();
            return $this->successResponse($zones);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving zones.', 500, $e);
        }
    }





    /**
     * @OA\Post(
     *  path="/api/zones",
     *  summary="Create a new zone",
     *  tags={"Zones"},
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="Senos",
     *                 description="Name of the zone."
     *              ),
     *              @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 example="Agrandamientos o reduciones de Senos",
     *                 description="Description of the zone."
     *              )
     *          )
     *      )
     *  ),
     *  @OA\Response(response="201", description="Returns the created zone.")
     * )
     */
    public function store(StoreZoneRequest $request)
    {
        try {
            $zone = $this->zoneService->create($request);
            return $this->successResponse($zone, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while storing the zone.', 500, $e);
        }
    }



    /**
     * @OA\Get(
     *    path="/api/zones/{id}",
     *    tags={"Zones"},
     *    summary="Get a specific zone",
     *    @OA\Parameter(description="ID of zone", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="200", description="Returns the requested zone.")
     * )
     */
    public function show(Zone $zone)
    {
        try {
            return $this->successResponse($zone);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the zone.', 500, $e);
        }
    }




    /**
     * @OA\Put(
     * path="/api/zones/{id}",
     * summary="Update a zone",
     * tags={"Zones"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the zone.",
     *     required=true,
     *     @OA\Schema(
     *         type="integer"
     *     )
     * ),
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="Senos",
     *                 description="Name of the zone."
     *              ),
     *              @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 example="Agrandamientos o reduciones de Senos",
     *                 description="Description of the zone."
     *              ),
     *         )
     *     )
     * ),
     * @OA\Response(response="200", description="Returns the updated  zone.")
     * )
     */
    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        try {
            $update = $this->zoneService->update($request->validated(), $zone);
            return $this->successResponse($update);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while updating the procedure.', 500, $e);
        }
    }




    /**
     * @OA\Delete(
     *    path="/api/zones/{id}",
     *    tags={"Zones"},
     *    summary="Delete a specific zone",
     *    @OA\Parameter(description="ID of zone", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="204", description="zone type deleted successfully.")
     * )
     */
    public function destroy(Zone $zone)
    {
        try {
            $this->zoneService->delete($zone);
            return $this->successResponse('', 204);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while deleting the zone.', 500, $e);
        }
    }
}
