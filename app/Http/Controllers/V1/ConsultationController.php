<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Models\Consultation;
use App\Services\ConsultationService;
use App\Traits\ApiResponser;


class ConsultationController extends Controller
{

    use ApiResponser;


    protected $consultationService;

    public function __construct(ConsultationService $consultationService)
    {
        $this->consultationService = $consultationService;
    }


    /**
     * @OA\Get(
     *    path="/api/consultations",
     *    summary="List all Consultations",
     *    tags={"Consultations"},
     *    @OA\Response(response="200", description="Returns list of all Consultations.")
     * )
     */
    public function index()
    {
        try {
            $consultation = $this->consultationService->listAll();
            return $this->successResponse($consultation);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving Consultations.', 500, $e);
        }
    }




    /**
     * @OA\Get(
     *    path="/api/consultations/{id}/zone",
     *    summary="List all Consultations of zone",
     *    tags={"Consultations"},
     *    @OA\Response(response="200", description="Returns list of all recipes of patient.")
     * )
     */
    public function listAllByZoneId(int $id)
    {
        try {
            $consultations = $this->consultationService->listAllByZoneId($id);
            return $this->successResponse($consultations);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving Consultations.', 500, $e);
        }
    }




    /**
     * @OA\Post(
     *  path="/api/consultations",
     *  summary="Create a new Consultations",
     *  tags={"Consultations"},
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                 property="user_id",
     *                 type="integer",
     *                 example="1",
     *                 description="ID of the user."
     *              ),
     *              @OA\Property(
     *                 property="zone_id",
     *                 type="integer",
     *                 example="1",
     *                 description="ID of the zone."
     *              ),
     *              @OA\Property(
     *                 property="appointment_date",
     *                 type="string",
     *                 example="2025-10-30",
     *                 description="Data time of the Consultations."
     *              ),
     *              @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="Pendiente",
     *                 description="'Pendiente', 'Aceptada', 'Rechazada'."
     *              )
     *          )
     *      )
     *  ),
     *  @OA\Response(response="201", description="Returns the created Consultation.")
     * )
     */
    public function store(StoreConsultationRequest $request)
    {
        try {
            $consultation = $this->consultationService->create($request);
            return $this->successResponse($consultation, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while storing the Consultation.', 500, $e);
        }
    }



    /**
     * @OA\Get(
     *    path="/api/consultations/{id}",
     *    tags={"Consultations"},
     *    summary="Get a specific Consultations",
     *    @OA\Parameter(description="ID of Consultations", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="200", description="Returns the requested Consultation.")
     * )
     */
    public function show(Consultation $consultation)
    {
        try {
            return $this->successResponse($consultation);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the Consultation.', 500, $e);
        }
    }




    /**
     * @OA\Put(
     * path="/api/consultations/{id}",
     * summary="Update a Consultations",
     * tags={"Consultations"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the Consultations.",
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
     *                 property="user_id",
     *                 type="integer",
     *                 example="1",
     *                 description="ID of the user."
     *              ),
     *              @OA\Property(
     *                 property="zone_id",
     *                 type="integer",
     *                 example="1",
     *                 description="ID of the zone."
     *              ),
     *              @OA\Property(
     *                 property="appointment_date",
     *                 type="string",
     *                 example="2025-10-30",
     *                 description="Data time of the Consultations."
     *              ),
     *              @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="Pendiente",
     *                 description="'Pendiente', 'Aceptada', 'Rechazada'."
     *              )
     *         )
     *     )
     * ),
     * @OA\Response(response="200", description="Returns the updated  Consultations.")
     * )
     */
    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {
        try {
            $update = $this->consultationService->update($request->validated(), $consultation);
            return $this->successResponse($update);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while updating the Consultation.', 500, $e);
        }
    }




    /**
     * @OA\Delete(
     *    path="/api/consultations/{id}",
     *    tags={"Consultations"},
     *    summary="Delete a specific Consultations",
     *    @OA\Parameter(description="ID of Consultations", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="204", description="Sub Consultations type deleted successfully.")
     * )
     */
    public function destroy(Consultation $consultation)
    {
        try {
            $this->consultationService->delete($consultation);
            return $this->successResponse('', 204);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while deleting the Consultation.', 500, $e);
        }
    }


}
