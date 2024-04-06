<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PatientService
{

    /**
     * List all patients.
     * @return mixed
     */
    public function listAll()
    {
        return Patient::all();
    }



    /**
     * List all patients.
     * @param int $id_patient
     * @return mixed
     */
    public function listAllByPatientId(int $id_patient)
    {
        $patientTreatmens = Patient::with('treatments', 'status', 'doctors.user')
            ->where('patient_id', $id_patient)
            ->orderBy('id', 'desc')
            ->get();

        return $patientTreatmens;
    }


    /**
     * Create a new patient.
     * @return Patient
     */
    public function store(Request $request): Patient
    {
        $patientData = $request->all();
        $patientData['birth_date'] = Carbon::parse($request->input('birth_date'))->format('Y-m-d');

        return Patient::create($patientData);
    }



    /**
     * Update a patients's details.
     *
     * @param Patient $patient
     * @return Patient
     */
    public function update(Request $request, Patient $patient): Patient
    {
        $patientData = $request->all();
        $patientData['birth_date'] = Carbon::parse($request->input('birth_date'))->format('Y-m-d');

        $patient->update($patientData);

        return $patient;
    }
}
