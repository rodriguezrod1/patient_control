<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProcedureRequest;
use App\Http\Requests\UpdateProcedureRequest;
use App\Models\Procedure;
use App\Services\ProcedureService;
use App\Traits\ApiResponser;


class ProcedureController extends Controller
{
    use ApiResponser;

    protected $procedureService;

    public function __construct(ProcedureService $procedureService)
    {
        $this->procedureService = $procedureService;
    }


    /**
     * @OA\Get(
     *    path="/api/procedures",
     *    summary="List all procedures",
     *    tags={"Procedures"},
     *    @OA\Response(response="200", description="Returns list of all procedures.")
     * )
     */
    public function index()
    {
        try {
            $zones = $this->procedureService->listAll();
            return $this->successResponse($zones);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving procedures.', 500, $e);
        }
    }




    /**
     * @OA\Get(
     *    path="/api/procedures/{id}/zone",
     *    summary="List all procedure of zone",
     *    tags={"Procedures"},
     *    @OA\Response(response="200", description="Returns list of all procedure of zone.")
     * )
     */
    public function listAllByZonetId(int $id)
    {
        try {
            $zones = $this->procedureService->listAllByProcedurestId($id);
            return $this->successResponse($zones);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving procedure.', 500, $e);
        }
    }




    /**
     * @OA\Post(
     *  path="/api/procedures",
     *  summary="Create a new procedure",
     *  tags={"Procedures"},
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                 property="zone_id",
     *                 type="integer",
     *                 example="1",
     *                 description="ID of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="name_for_patient",
     *                 type="string",
     *                 example="Senos",
     *                 description="Name of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="medical_name",
     *                 type="string",
     *                 example="Agrandamientos o reduciones de Senos",
     *                 description="Description of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="price",
     *                 type="string",
     *                 example="30",
     *                 description="Price of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="days_stay",
     *                 type="integer",
     *                 example="30",
     *                 description="Days stay of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="weeks_recovery",
     *                 type="integer",
     *                 example="5",
     *                 description="Weeks recovery of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="anesthesia",
     *                 type="General",
     *                 example="5",
     *                 description="Type anesthesia of the procedure ('Local', 'General')."
     *              )
     *          )
     *      )
     *  ),
     *  @OA\Response(response="201", description="Returns the created procedure.")
     * )
     */
    public function store(StoreProcedureRequest $request)
    {
        try {
            $procedure = $this->procedureService->create($request);
            return $this->successResponse($procedure, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while storing the procedure. ', 500, $e);
        }
    }



    /**
     * @OA\Get(
     *    path="/api/procedures/{id}",
     *    tags={"Procedures"},
     *    summary="Get a specific procedure",
     *    @OA\Parameter(description="ID of procedure", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="200", description="Returns the requested procedure.")
     * )
     */
    public function show(Procedure $procedure)
    {
        try {
            return $this->successResponse($procedure);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the procedure.', 500, $e);
        }
    }




    /**
     * @OA\Put(
     * path="/api/procedures/{id}",
     * summary="Update a procedure",
     * tags={"Procedures"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the procedure.",
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
     *              @OA\Property(
     *                 property="zone_id",
     *                 type="integer",
     *                 example="1",
     *                 description="ID of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="name_for_patient",
     *                 type="string",
     *                 example="Lorenm",
     *                 description="Name of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="medical_name",
     *                 type="string",
     *                 example="Agrandamientos o reduciones de Senos",
     *                 description="Description of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="price",
     *                 type="string",
     *                 example="30",
     *                 description="Price of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="days_stay",
     *                 type="integer",
     *                 example="30",
     *                 description="Days stay of the procedure."
     *              ),
     *              @OA\Property(
     *                 property="weeks_recovery",
     *                 type="integer",
     *                 example="5",
     *                 description="Weeks recovery of the procedure."
     *              ),
     *               @OA\Property(
     *                 property="anesthesia",
     *                 type="General",
     *                 example="5",
     *                 description="Type anesthesia of the procedure ('Local', 'General')."
     *              )
     *         )
     *     )
     * ),
     * @OA\Response(response="200", description="Returns the updated  procedure.")
     * )
     */
    public function update(UpdateProcedureRequest $request, Procedure $procedure)
    {
        try {
            $update = $this->procedureService->update($request->validated(), $procedure);
            return $this->successResponse($update);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while updating the procedure.', 500, $e);
        }
    }




    /**
     * @OA\Delete(
     *    path="/api/procedures/{id}",
     *    tags={"Procedures"},
     *    summary="Delete a specific procedure",
     *    @OA\Parameter(description="ID of procedure", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="204", description="Sub procedure type deleted successfully.")
     * )
     */
    public function destroy(Procedure $procedure)
    {
        try {
            $this->procedureService->delete($procedure);
            return $this->successResponse('Delete', 204);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while deleting the procedure.', 500, $e);
        }
    }
}
