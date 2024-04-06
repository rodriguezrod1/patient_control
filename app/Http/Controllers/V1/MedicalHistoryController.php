<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicalHistoryRequest;
use App\Http\Requests\UpdateMedicalHistoryRequest;
use App\Models\MedicalHistory;
use App\Services\MedicalHistoryService;
use App\Traits\ApiResponser;


class MedicalHistoryController extends Controller
{
    use ApiResponser;


    protected $medicalHistoryService;

    public function __construct(MedicalHistoryService $medicalHistoryService)
    {
        $this->medicalHistoryService = $medicalHistoryService;
    }


    /**
     * @OA\Get(
     *    path="/api/medical_historys",
     *    summary="List all Medical Historys",
     *    tags={"Medical Historys"},
     *    @OA\Response(response="200", description="Returns list of all Medical Historys.")
     * )
     */
    public function index()
    {
        try {
            $medicalHistory = $this->medicalHistoryService->listAll();
            return $this->successResponse($medicalHistory);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving Medical Historys.', 500, $e);
        }
    }




    /**
     * @OA\Get(
     *    path="/api/medical_historys/{id}/procedure",
     *    summary="List all Medical Historys of procedure",
     *    tags={"Medical Historys"},
     *    @OA\Response(response="200", description="Returns list of all recipes of patient.")
     * )
     */
    public function listAllByProcedurestId(int $id)
    {
        try {
            $medicalHistorys = $this->medicalHistoryService->listAllBySubProcedurestId($id);
            return $this->successResponse($medicalHistorys);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving Medical Historys.', 500, $e);
        }
    }




    /**
     * @OA\Post(
     *  path="/api/medical_historys",
     *  summary="Create a new Medical Historys",
     *  tags={"Medical Historys"},
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
     *                 description="ID of the Medical Historys."
     *              ),
     *              @OA\Property(
     *                 property="procedure_id",
     *                 type="integer",
     *                 example="1",
     *                 description="ID of the Medical Historys."
     *              ),
     *              @OA\Property(
     *                 property="photographic_evidence",
     *                 type="string",
     *                 example="[]",
     *                 description="arreglo de fotografias cargadas."
     *              ),
     *              @OA\Property(
     *                 property="questions_answers",
     *                 type="string",
     *                 example="[]",
     *                 description="Arreglo de todas las preguntas y respuestas."
     *              ),
     *              @OA\Property(
     *                 property="appointment_date",
     *                 type="string",
     *                 example="2025-10-30",
     *                 description="Data time of the Medical Historys."
     *              ),
     *              @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="Pendiente",
     *                 description="'Pendiente', 'Aceptada', 'Rechazada'."
     *              ),
     *               @OA\Property(
     *                 property="note",
     *                 type="string",
     *                 example="Breve nota del paciente",
     *                 description="Note of the Medical Historys."
     *              )
     *          )
     *      )
     *  ),
     *  @OA\Response(response="201", description="Returns the created Medical Historys.")
     * )
     */
    public function store(StoreMedicalHistoryRequest $request)
    {
        try {
            $medicalHistory = $this->medicalHistoryService->create($request);
            return $this->successResponse($medicalHistory, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while storing the Medical Historys.', 500, $e);
        }
    }



    /**
     * @OA\Get(
     *    path="/api/medical_historys/{id}",
     *    tags={"Medical Historys"},
     *    summary="Get a specific Medical Historys",
     *    @OA\Parameter(description="ID of Medical Historys", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="200", description="Returns the requested Medical Historys.")
     * )
     */
    public function show(MedicalHistory $medicalHistory)
    {
        try {
            return $this->successResponse($medicalHistory);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the Medical Historys.', 500, $e);
        }
    }




    /**
     * @OA\Put(
     * path="/api/medical_historys/{id}",
     * summary="Update a Medical Historys",
     * tags={"Medical Historys"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the Medical Historys.",
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
     *                 description="ID of the Medical Historys."
     *              ),
     *              @OA\Property(
     *                 property="procedure_id",
     *                 type="integer",
     *                 example="1",
     *                 description="ID of the Medical Historys."
     *              ),
     *              @OA\Property(
     *                 property="photographic_evidence",
     *                 type="string",
     *                 example="[]",
     *                 description="Arreglo de fotografias cargadas."
     *              ),
     *              @OA\Property(
     *                 property="questions_answers",
     *                 type="string",
     *                 example="[]",
     *                 description="Arreglo de todas las preguntas y respuestas."
     *              ),
     *              @OA\Property(
     *                 property="appointment_date",
     *                 type="string",
     *                 example="30",
     *                 description="Data time of the Medical Historys."
     *              ),
     *              @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="Pendiente",
     *                 description="'Pendiente', 'Aceptada', 'Rechazada'."
     *              ),
     *               @OA\Property(
     *                 property="note",
     *                 type="string",
     *                 example="Breve nota del paciente",
     *                 description="Note of the Medical Historys."
     *              )
     *         )
     *     )
     * ),
     * @OA\Response(response="200", description="Returns the updated  Medical Historys.")
     * )
     */
    public function update(UpdateMedicalHistoryRequest $request, MedicalHistory $medicalHistory)
    {
        try {
            $update = $this->medicalHistoryService->update($request->validated(), $medicalHistory);
            return $this->successResponse($update);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while updating the Medical Historys.', 500, $e);
        }
    }




    /**
     * @OA\Delete(
     *    path="/api/medical_historys/{id}",
     *    tags={"Medical Historys"},
     *    summary="Delete a specific Medical Historys",
     *    @OA\Parameter(description="ID of Medical Historys", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="204", description="Sub Medical Historys type deleted successfully.")
     * )
     */
    public function destroy(MedicalHistory $medicalHistory)
    {
        try {
            $this->medicalHistoryService->delete($medicalHistory);
            return $this->successResponse('', 204);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while deleting the Medical Historys.', 500, $e);
        }
    }
}
