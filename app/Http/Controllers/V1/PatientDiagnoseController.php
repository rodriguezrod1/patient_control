<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientDiagnoseRequest;
use App\Http\Requests\UpdatePatientDiagnoseRequest;
use App\Models\PatientDiagnose;
use App\Traits\ApiResponser;
use App\Services\PatientDiagnoseService;


class PatientDiagnoseController extends Controller
{

    use ApiResponser;

    protected $patientDiagnoseService;

    public function __construct(PatientDiagnoseService $patientDiagnoseService)
    {
        $this->patientDiagnoseService = $patientDiagnoseService;
    }



    /**
     * @OA\Get(
     *    path="/api/patient_diagnoses",
     *    summary="List all patient diagnose",
     *    tags={"Patient Diagnoses"},
     *    @OA\Response(response="200", description="Returns list of all patients diagnoses.")
     * )
     */
    public function index()
    {
        try {
            $patientDiagnose = $this->patientDiagnoseService->listAll();
            return $this->successResponse($patientDiagnose);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving patient diagnoses.', 500, $e);
        }
    }




    /**
     * @OA\Get(
     *    path="/api/patient_diagnoses/most-common",
     *    summary="List all patient diagnose",
     *    tags={"Patient Diagnoses"},
     *    @OA\Response(response="200", description="Returns list of all patients diagnoses.")
     * )
     */
    public function getMostCommonInLastSixMonths()
    {
        try {
            $commonDiagnoses = $this->patientDiagnoseService->getMostCommonInLastSixMonths();
            return $this->successResponse($commonDiagnoses);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving patient diagnoses most common.'.$e->getMessage(), 500, $e);
        }
    }




    /**
     * @OA\Post(
     *  path="/api/patient_diagnoses",
     *  summary="Create a new patient diagnose",
     *  tags={"Patient Diagnoses"},
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                 property="patient_id",
     *                 type="string",
     *                 example="1",
     *                 description="Patient Identifier."
     *              ),
     *              @OA\Property(
     *                 property="diagnose_id",
     *                 type="string",
     *                 example="1",
     *                 description="Diagnostic Identifier."
     *              ),
     *              @OA\Property(
     *                 property="observation",
     *                 type="string",
     *                 example="optional",
     *                 description="Diagnostic observations (optional)."
     *              ),
     *               @OA\Property(
     *                 property="creation",
     *                 type="string",
     *                 example="2024/04/08",
     *                 description="Creation Date"
     *              )
     *          )
     *      )
     *  ),
     *  @OA\Response(response="201", description="Returns the created patient diagnose.")
     * )
     */
    public function store(StorePatientDiagnoseRequest $request)
    {
        try {
            $patientDiagnose = $this->patientDiagnoseService->create($request);
            return $this->successResponse($patientDiagnose, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while storing the patient diagnose.', 419, $e);
        }
    }



    /**
     * @OA\Get(
     *    path="/api/patient_diagnoses/{id}",
     *    tags={"Patient Diagnoses"},
     *    summary="Get a specific diagnose",
     *    @OA\Parameter(description="ID of diagnoses", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="200", description="Returns the requested diagnose.")
     * )
     */
    public function show(PatientDiagnose $patientDiagnose)
    {
        try {
            $patientDiagnose->load(['patient', 'diagnose']);
            return $this->successResponse($patientDiagnose);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the patient diagnose.', 500, $e);
        }
    }




    /**
     * @OA\Put(
     * path="/api/patient_diagnoses/{id}",
     * summary="Update a  patient diagnose",
     * tags={"Patient Diagnoses"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the  patient diagnose.",
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
     *                 property="patient_id",
     *                 type="string",
     *                 example="1",
     *                 description="Patient Identifier."
     *              ),
     *              @OA\Property(
     *                 property="diagnose_id",
     *                 type="string",
     *                 example="1",
     *                 description="Diagnostic Identifier."
     *              ),
     *              @OA\Property(
     *                 property="observation",
     *                 type="string",
     *                 example="optional",
     *                 description="Diagnostic observations (optional)."
     *              ),
     *               @OA\Property(
     *                 property="creation",
     *                 type="string",
     *                 example="2024/04/08",
     *                 description="Creation Date"
     *              )
     *         )
     *     )
     * ),
     * @OA\Response(response="200", description="Returns the updated  patient diagnose.")
     * )
     */
    public function update(UpdatePatientDiagnoseRequest $request, PatientDiagnose $patientDiagnose)
    {
        try {
            $diagnoseUpdated = $this->patientDiagnoseService->update($request, $patientDiagnose);
            return $this->successResponse($diagnoseUpdated);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while updating the patient patient diagnose.', 419, $e);
        }
    }




    /**
     * @OA\Delete(
     *    path="/api/patient_diagnoses/{id}",
     *    tags={"Patient Diagnoses"},
     *    summary="Delete a specific diagnoses",
     *    @OA\Parameter(description="ID of diagnoses", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="204", description="patient diagnose type deleted successfully.")
     * )
     */
    public function destroy(PatientDiagnose $patientDiagnose)
    {
        try {
            $patientDiagnose->delete();
            return $this->successResponse([], 204);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while deleting the patient diagnose.', 500, $e);
        }
    }
}
