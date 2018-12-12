<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class controlRequest extends FormRequest
{
    public function messages()
    {
        return [
            'control.min'         => 'La Descripción del Control debe ser de mínimo 5 caracteres.',
            'control.max'         => 'La Descripción del Control debe ser de máximo 150 caracteres.',
            'control.regex'       => 'La Descripción del Control no debe contener caracteres inválidos.',
            'control.required'    => 'La Descripción del Control es obligatoria.',
            'factor.required'     => 'Campo obligatorio.',
            'riesgo.required'     => 'Campo obligatorio.',
            'tipo.required'       => 'Campo obligatorio.',
            'documentado.required'=> 'Campo obligatorio.',
            'formalizado.required'=> 'Campo obligatorio.',
            'aplica.required'     => 'Campo obligatorio.',
            'efectivo.required'   => 'Campo obligatorio.'
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
            'riesgo'      => 'required',
            'factor'      => 'required',
            'control'     => 'min:5|max:150|required|regex:/(^([a-zA-z\s\d]+)?$)/i',
            'tipo'        => 'required',
            'documentado' => 'required',
            'formalizado' => 'required',
            'aplica'      => 'required',
            'efectivo'    => 'required'
        ];
    }
}
