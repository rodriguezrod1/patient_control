<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\PatientService;


class PatientController extends Controller
{
    use ApiResponser;

    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }


    /**
     * @OA\Get(
     *    path="/api/patients",
     *    summary="List all patients",
     *    tags={"Patients"},
     *    @OA\Response(response="200", description="Returns list of all patients.")
     * )
     */
    public function index()
    {
        try {
            $patients = $this->patientService->listAll();
            return $this->successResponse($patients);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving patients.', 500, $e);
        }
    }




    /**
     * @OA\Get(
     *    path="/api/patients/search?query=Rod",
     *    summary="List all patients for filter",
     *    tags={"Patients"},
     *    @OA\Response(response="200", description="Returns list of all patients.")
     * )
     */
    public function search(Request $request)
    {
        try {
            $patients = $this->patientService->search($request);
            return $this->successResponse($patients);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving patients.'.$e->getMessage(), 500, $e);
        }
    }




    /**
     * @OA\Post(
     *  path="/api/patients",
     *  summary="Create a new treatment",
     *  tags={"Patients"},
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                 property="document",
     *                 type="string",
     *                 example="1246546565",
     *                 description="Identification document."
     *              ),
     *              @OA\Property(
     *                 property="first_name",
     *                 type="string",
     *                 example="Rod",
     *                 description="Patient first name"
     *              ),
     *              @OA\Property(
     *                 property="last_name",
     *                 type="string",
     *                 example="Rodríguez",
     *                 description="Patient last name"
     *              ),
     *              @OA\Property(
     *                 property="birth_date",
     *                 type="string",
     *                 example="1979/10/05",
     *                 description="Patient Birthday."
     *              ),
     *              @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 example="rod@gmail.com",
     *                 description="Contact email."
     *              ),
     *              @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 example="2255242242",
     *                 description="Contact phone."
     *              ),
     *              @OA\Property(
     *                 property="gender",
     *                 type="string",
     *                 example="Male",
     *                 description="Patient Genre (Male o Female)."
     *              )
     *          )
     *      )
     *  ),
     *  @OA\Response(response="201", description="Returns the created Patient.")
     * )
     */
    public function store(StorePatientRequest $request)
    {
        try {
            $patient = $this->patientService->store($request);
            return $this->successResponse($patient, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while storing the patient.', 419, $e);
        }
    }



    /**
     * @OA\Get(
     *    path="/api/patients/{id}",
     *    tags={"Patients"},
     *    summary="Get a specific Patient",
     *    @OA\Parameter(description="ID of Patient", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="200", description="Returns the requested Patient.")
     * )
     */
    public function show(Patient $patient)
    {
        try {
            $patient->load(['patient_diagnoses.diagnose']);
            return $this->successResponse($patient);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the Patient.', 419, $e);
        }
    }



    /**
     * @OA\Put(
     * path="/api/patients/{id}",
     * summary="Update a Patient",
     * tags={"Patients"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the Patient.",
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
     *                 property="document",
     *                 type="string",
     *                 example="1246546565",
     *                 description="Identification document."
     *              ),
     *              @OA\Property(
     *                 property="first_name",
     *                 type="string",
     *                 example="Rod",
     *                 description="Patient first name"
     *              ),
     *              @OA\Property(
     *                 property="last_name",
     *                 type="string",
     *                 example="Rodríguez",
     *                 description="Patient last name"
     *              ),
     *              @OA\Property(
     *                 property="birth_date",
     *                 type="string",
     *                 example="1979/10/05",
     *                 description="Patient Birthday."
     *              ),
     *              @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 example="rod@gmail.com",
     *                 description="Contact email."
     *              ),
     *              @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 example="2255242242",
     *                 description="Contact phone."
     *              ),
     *              @OA\Property(
     *                 property="gender",
     *                 type="string",
     *                 example="Male",
     *                 description="Patient Genre (Male o Female)."
     *              )
     *         )
     *     )
     * ),
     * @OA\Response(response="200", description="Returns the updated Patient.")
     * )
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        try {
            $patient = $this->patientService->update($request, $patient);
            return $this->successResponse($patient);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while updating the Patient.', 419, $e);
        }
    }



    /**
     * @OA\Delete(
     *    path="/api/patients/{id}",
     *    tags={"Patients"},
     *    summary="Delete a specific treatment",
     *    @OA\Parameter(description="ID of Patient", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="204", description="Patient deleted successfully.")
     * )
     */
    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();
            return $this->successResponse([], 204);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while deleting the treatment.', 500, $e);
        }
    }
}
