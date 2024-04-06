<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StorePatientRequest extends FormRequest
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
            'document' => 'required|string|size:20|unique:patients,document',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|string|size:30',
            'email' => 'required|string|email|max:255|unique:patients,email',
            'phone' => 'required|string|size:20',
            'gender' => 'required|string|in:Male,Female',
        ];
    }
}
