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
        return Patient::with('patient_diagnoses')->paginate(10);
    }



    /**
     * List all patients for filters.
     * @param string $query
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = $request->get('query');

        $patients = Patient::with('patient_diagnoses')
            ->where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('document_number', 'like', "%{$query}%")
            ->get();
        return $patients;
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
