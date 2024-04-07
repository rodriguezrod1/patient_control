<?php

namespace App\Http\Requests;
use App\Http\Requests\BaseFormRequest;

class UpdatePatientRequest extends BaseFormRequest
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
            'document' => 'sometimes|required|string|max:20|unique:patients,document,'.$this->route('patient')->id,
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'birth_date' => 'sometimes|required|string|max:30',
            'email' => 'sometimes|required|string|email|max:255|unique:patients,email,'.$this->route('patient')->id,
            'phone' => 'sometimes|required|string|max:20',
            'gender' => 'sometimes|required|string|in:Male,Female',
        ];
    }
}
