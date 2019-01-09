<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class valoracionRequest extends FormRequest
{
    public function messages()
    {
        return [
            'riesgo.required'    => 'El riesgo es necesario para registrarlo al sistema.',
            'grado.required'       => 'El grado es necesario para registrarlo al sistema.',
            'probabilidad.required'        => 'La probabilidad es necesaria para registrarlo al sistema.'
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'riesgo' =>  'required',
            'grado' => 'required',
            'probabilidad' => 'required'
        ];
    }
}
