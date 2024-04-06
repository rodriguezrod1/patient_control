<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        $doc_type = $this->document_type;
        $doc_number = $this->document_number;
        $today = \Carbon\Carbon::now();

       return [
           'name'            => 'required|max:100',
           'email'           => 'required|unique:users,email',
           'phone'           => 'required|max:20',
           'password'        => ['required', 'confirmed', Password::min(8)],
           'city'            => 'required|max:100',
           'birthdate'       => ['required', 'date_format:Y-m-d', 'before:'.$today->subYears(10)->format('Y-m-d')],
           'document_type'   => 'required',
           'rol'             => ['nullable', Rule::in(['patient', 'admin', 'super_admin'])],
           'document_number' => ['required',
               Rule::unique('users', 'document_number')
                   ->where(function ($query) use ($doc_type, $doc_number) {
                           $query->where('document_number', $doc_number)
                                 ->where('document_type', $doc_type);
                    }
               )]
       ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'document_number.unique'   => 'El documento de identidad ya esta registrado',
            'document_number.required' => 'El documento de identidad es necesario',
        ];
    }
}
