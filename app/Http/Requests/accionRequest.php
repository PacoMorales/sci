<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class accionRequest extends FormRequest
{
    public function messages()
    {
        return [
            'cumplimiento1.required' => 'El Procentaje (%) de Cumplimiento es obligatorio.',
            'cumplimiento2.required' => 'El Procentaje (%) de Cumplimiento es obligatorio.',
            'procesos.required'      => 'El Número Identificador del Proceso es obligatorio.',
            'no.required'            => 'El Número de Acción de Mejora es obligatorio.',
            'accion.required'        => 'La descripción de la Acción de Mejora es obligatorio.',
            'fecha_ini.required'     => 'La Fecha Inicial es obligatorio.',
            'fecha_fin.required'     => 'La Fecha Final es obligatorio.',
            'responsable.required'   => 'El Responsable de esta Acción de Mejora es obligatorio.',
            'medios.required'        => 'El Medio o Medios de Verificación es obligatorio.'
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
            'cumplimiento1' => 'required',
            'cumplimiento2' => 'required',
            'procesos'      => 'required',
            'no'            => 'required',
            'accion'        => 'required',
            'fecha_ini'     => 'required',
            'fecha_fin'     => 'required',
            'responsable'   => 'required',
            'medios'        => 'required'
        ];
    }
}
