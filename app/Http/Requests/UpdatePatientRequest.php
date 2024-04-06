<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
        return [
            'document' => 'sometimes|required|string|size:20|unique:patients,document,'.$this->patient->document,
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'birth_date' => 'sometimes|required|string|size:30',
            'email' => 'sometimes|required|string|email|max:255|unique:patients,email,'.$this->patient->email,
            'phone' => 'sometimes|required|string|size:20',
            'gender' => 'sometimes|required|string|in:Male,Female',
        ];
    }
}
