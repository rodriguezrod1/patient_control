<?php

namespace App\Http\Requests;
use App\Http\Requests\BaseFormRequest;


class StorePatientRequest extends BaseFormRequest
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
            'document' => 'required|string|max:20|unique:patients,document',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:patients,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|in:Male,Female',
        ];
    }
}
