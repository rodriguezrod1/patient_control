<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientDiagnoseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'diagnose_id' => 'required|exists:diagnoses,id',
            'observation' => 'nullable|string|max:255',
            'creation' => 'required|date',
        ];
    }
}
