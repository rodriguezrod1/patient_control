<?php

namespace App\Services;

use App\Models\PatientDiagnose;
use Illuminate\Http\Request;

class PatientDiagnoseService
{

    /**
     * List all Patiens Diagnoses.
     *
     * @return mixed
     */
    public function listAll()
    {
        return PatientDiagnose::all();
    }


    /**
     * Create a new Patient Diagnose.
     * @return PatientDiagnose
     */
    public function create(Request $request): PatientDiagnose
    {
        return PatientDiagnose::create($request->all());
    }


    /**
     * Update a Patient Diagnose's details.
     *
     * @param PatientDiagnose $patientDiagnose
     * @return PatientDiagnose
     */
    public function update(Request $request, PatientDiagnose $patientDiagnose): PatientDiagnose
    {
        $patientDiagnose->update($request->all());
        return $patientDiagnose;
    }
}
