<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiagnoseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $diagnosisId = $this->route('diagnosis')->id;
        return [
            'name' => 'required|string|max:255|unique:diagnoses,name,' . $diagnosisId,
            'description' => 'nullable|string|max:255',
        ];
    }
}
