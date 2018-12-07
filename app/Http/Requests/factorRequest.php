<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class factorRequest extends FormRequest
{
    public function messages()
    {
        return [
            'descripcion.min'         => 'La Descripción debe ser de mínimo 5 caracteres.',
            'descripcion.max'         => 'La Descripción debe ser de máximo 150 caracteres.',
            'descripcion.regex'       => 'La Descripción no debe contener caracteres inválidos.',
            'descripcion.required'    => 'La Descripción es obligatoria.',
            'clasificacion.required'  => 'La Clasificación es obligatoria.',
            'tipo.required'           => 'El Tipo es obligatorio.'
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
            'descripcion' =>  'min:5|max:150|required|regex:/(^([a-zA-z%()=.\s\d]+)?$)/i',
            'clasificacion' =>  'required',
            'tipo' => 'required'
        ];
    }
}
