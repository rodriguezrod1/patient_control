<?php

namespace App\Services;

use App\Models\PatientDiagnose;
use Carbon\Carbon;
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
        return PatientDiagnose::with(['patient', 'diagnose'])->get();
    }



    /**
     * List all Diagnoses most Common In Last Six Months.
     *
     * @return mixed
     */
    public function getMostCommonInLastSixMonths()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $commonDiagnoses = PatientDiagnose::query()
            ->join('diagnoses', 'patient_diagnoses.diagnose_id', '=', 'diagnoses.id')
            ->where('patient_diagnoses.created_at', '>=', $sixMonthsAgo)
            ->select('diagnoses.name', PatientDiagnose::raw('COUNT(*) as count'))
            ->groupBy('diagnoses.name')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        return $commonDiagnoses;
    }


    /**
     * Create a new Patient Diagnose.
     * @return PatientDiagnose
     */
    public function create(Request $request): PatientDiagnose
    {
        return PatientDiagnose::create($request->validated());
    }


    /**
     * Update a Patient Diagnose's details.
     *
     * @param PatientDiagnose $patientDiagnose
     * @return PatientDiagnose
     */
    public function update(Request $request, PatientDiagnose $patientDiagnose): PatientDiagnose
    {
        $patientDiagnose->update($request->validated());
        return $patientDiagnose;
    }
}
