<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class plan_trabajoRequest extends FormRequest
{
    public function messages()
    {
        return [
            'titular.min'         => 'El Nombre del Titular debe ser de mínimo 10 caracteres.',
            'titular.max'         => 'El Nombre del Titular debe ser de máximo 80 caracteres.',
            'titular.regex'       => 'El Nombre del Titular no debe contener caracteres inválidos.',
            'titular.required'    => 'El Nombre del Titular es obligatoria.',
            'unidad.required'     => 'La Unidad Administrativa es obligatoria.',
            'estructura.required' => 'La Secretaría es obligatorio.'
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
            'estructura'     => 'required',
            'unidad'         => 'required',
            'titular'        => 'min:10|max:80|required|regex:/(^([a-zA-z\s]+)?$)/i'
        ];
    }
}
