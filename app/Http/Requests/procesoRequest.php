<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class procesoRequest extends FormRequest
{
    public function messages()
    {
        return [
            //'nombre_proceso.min'         => 'El nombre del proceso debe ser de mínimo 1 caracter.',
            //'nombre_proceso.max'         => 'El nombre del proceso debe ser de máximo 100 caracteres.',
            //'nombre_proceso.required'    => 'El nombre del proceso es necesario para registrarlo al sistema.',
            'descripcion.min'            => 'La descripción debe ser de mínimo 1 caracteres.',
            'descripcion.max'            => 'La descripción debe ser de máximo 200 caracteres.',
            'descripcion.required'       => 'El nombre / descripción del proceso es necesario para identificar al proceso.',
            'secretaria.required'        => 'La secretaria es necesaria para identificar al proceso.',
            //'unidad.required'            => 'La unidad es necesaria para identificar al proceso.',
            'tipo.required'              => 'El tipo de proceso es necesario para identificar al proceso.',
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
            //'nombre_proceso' =>  'min:1|max:100|required',
            'descripcion' =>  'min:1|max:200|required',
            'secretaria' => 'required',
            //'unidad' => 'required',
            'tipo' => 'required'
        ];
    }
}
