<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class estrategiasRequest extends FormRequest
{
    public function messages()
    {
        return [
            'riesgo.required' => 'El Riesgo es obligatorio.',
            'factor.required' => 'El Factor es obligatorio.',
            'estrategia.required' => 'La Estrategia es obligatorio.',
            'descripcion.min' => 'La Descripción de la Acción es de mínimo 4 caracteres.',
            'descripcion.max' => 'La Descripción de la Acción es de máximo 100 caracteres.',
            'descripcion.required' => 'La Descripción de la Acción es obligatorio.',
            'descripcion.regex' => 'La Descripción de la Acción contiene caracteres inválidos.'
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
            'riesgo' => 'required',
            'factor' => 'required',
            'estrategia' => 'required',
            'descripcion' => 'min:6|max:100|required|regex:/(^([a-zA-z%()=.\s\d]+)?$)/i'
        ];
    }
}
