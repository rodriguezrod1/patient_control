<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcedureRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'zone_id' => 'required|exists:procedures,id',
            'name_for_patient' => 'required|string|max:250',
            'medical_name' => 'required|string|max:250',
            'price' => 'required|numeric',
            'days_stay' => 'required|integer|min:1',
            'weeks_recovery' => 'required|integer|min:0',
            'anesthesia' => 'required|in:Local,General',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'exists' => 'El :attribute seleccionado no existe.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'max' => 'El campo :attribute no debe exceder los :max caracteres.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'min' => 'El campo :attribute debe ser al menos :min.',
            'in' => 'El campo :attribute debe ser uno de los siguientes tipos: :values.',
        ];
    }
}
