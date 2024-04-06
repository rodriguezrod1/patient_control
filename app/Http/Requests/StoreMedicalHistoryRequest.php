<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'sub_procedure_id' => 'required|exists:sub_procedures,id',
            'photographic_evidence' => 'nullable|json',
            'questions_answers' => 'nullable|json',
            'appointment_date' => 'required|date',
            'status' => 'required|in:Pendiente,Aceptada,Rechazada',
            'note' => 'nullable|string',
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
            'json' => 'El campo :attribute debe ser un JSON válido.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'in' => 'El campo :attribute debe ser uno de los siguientes tipos: :values.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
        ];
    }
}
