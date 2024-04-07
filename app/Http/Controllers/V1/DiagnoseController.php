<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiagnoseRequest;
use App\Http\Requests\UpdateDiagnoseRequest;
use App\Models\Diagnose;
use App\Traits\ApiResponser;
use App\Services\DiagnoseService;


class DiagnoseController extends Controller
{

    use ApiResponser;

    protected $diagnoseService;

    public function __construct(DiagnoseService $diagnoseService)
    {
        $this->diagnoseService = $diagnoseService;
    }



    /**
     * @OA\Get(
     *    path="/api/diagnoses",
     *    summary="List all diagnose",
     *    tags={"Diagnoses"},
     *    @OA\Response(response="200", description="Returns list of all diagnoses.")
     * )
     */
    public function index()
    {
        try {
            $diagnose = $this->diagnoseService->listAll();
            return $this->successResponse($diagnose);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving diagnoses.', 500, $e);
        }
    }



    /**
     * @OA\Post(
     *  path="/api/diagnoses",
     *  summary="Create a new diagnose",
     *  tags={"Diagnoses"},
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="Tratamiento X",
     *                 description="Name of the diagnose."
     *              ),
     *               @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 example="null",
     *                 description="Description of the diagnose (Optional)."
     *              )
     *          )
     *      )
     *  ),
     *  @OA\Response(response="201", description="Returns the created diagnose.")
     * )
     */
    public function store(StoreDiagnoseRequest $request)
    {
        try {
            $diagnose = $this->diagnoseService->create($request);
            return $this->successResponse($diagnose, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while storing the diagnose.', 419, $e);
        }
    }



    /**
     * @OA\Get(
     *    path="/api/diagnoses/{id}",
     *    tags={"Diagnoses"},
     *    summary="Get a specific diagnose",
     *    @OA\Parameter(description="ID of diagnoses", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="200", description="Returns the requested diagnose.")
     * )
     */
    public function show(Diagnose $diagnose)
    {
        try {
            return $this->successResponse($diagnose);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the diagnose.', 500, $e);
        }
    }




    /**
     * @OA\Put(
     * path="/api/diagnoses/{id}",
     * summary="Update a  diagnose",
     * tags={"Diagnoses"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the  diagnose.",
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
     *                 example="Tratamiento editado",
     *                 description="Name of the diagnose."
     *              ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 example="null",
     *                 description="Description of the diagnose (Optional)."
     *              )
     *         )
     *     )
     * ),
     * @OA\Response(response="200", description="Returns the updated  diagnose.")
     * )
     */
    public function update(UpdateDiagnoseRequest $request, Diagnose $diagnose)
    {
        try {
            $diagnoseUpdated = $this->diagnoseService->update($request->validated(), $diagnose);
            return $this->successResponse($diagnoseUpdated);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while updating the diagnose.', 419, $e);
        }
    }




    /**
     * @OA\Delete(
     *    path="/api/diagnoses/{id}",
     *    tags={"Diagnoses"},
     *    summary="Delete a specific diagnoses",
     *    @OA\Parameter(description="ID of diagnoses", in="path", name="id", required=true, @OA\Schema(type="integer")),
     *    @OA\Response(response="204", description="diagnose type deleted successfully.")
     * )
     */
    public function destroy(Diagnose $diagnose)
    {
        try {
            $diagnose->delete();
            return $this->successResponse([], 204);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while deleting the diagnose.', 500, $e);
        }
    }
}
