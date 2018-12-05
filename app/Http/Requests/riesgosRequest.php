<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class riesgosRequest extends FormRequest
{
    public function messages()
    {
        return [
            'estructura.required' => 'La Dependencia es obligatoria.',
            'unidad.required' => 'La Unidad Administrativa es obligatoria.',
            'seleccion.required' => 'La Alineación es obligatoria.',
            'descripcion.required' => 'La Descripción es obligatoria.',
            'descripcion.min' => 'La Descripción es de mínimo 6 caracteres.',
            'descripcion.max' => 'La Descripción es de máximo 500 caracteres.',
            'riesgo.required' => 'El Riesgo es obligatorio.',
            'riesgo.min' => 'El Riesgo es de mínimo 6 caracteres.',
            'riesgo.max' => 'El Riesgo es de máximo 150 caracteres.',
            'decision.required' => 'El Nivel de Decisión es obligatorio.',
            'clasificacion.required' => 'La Clasificación es obligatoria.',
            'otro.max' => 'Máximo 100 caracteres.',
            'efectos.required' => 'Los Efectos son obligatorios.',
            'efectos.min' => 'Los Efectos son de mínimo 6 caracteres.',
            'efectos.max' => 'Los Efectos son de máximo 500 caracteres.',
            'impacto.required' => 'El Grado de Impacto es obligatorio.',
            'ocurrencia.required' => 'La Probabilidad de Ocurrencia es obligatoria.',
            'titular.required' => 'El Titular de la Unidad Administrativa es obligatorio.',
            'titular_aux.max' => 'El Titular de la Unidad Administrativa es de máximo 80 caracteres.',
            'id_sp_aux.numeric' => 'La Clave de Servidor Público del Titular debe ser numerica.',
            'coordinador.required' => 'El Coordinador es obligatorio.',
            'coor_aux.max' => 'El Coordinador es de máximo 80 caracteres.',
            'id_sp_coor.numeric' => 'La Clave de Servidor Público del Coordinador debe ser numerica.',
            'enlace.required' => 'El Enlace es obligatorio.',
            'enlace_aux.max' => 'El Enlace es de máximo 80 caracteres.',
            'id_sp_enlace.numeric' => 'La Clave de Servidor Público del Enlace debe ser numerica.'
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
            'estructura' => 'required',
            'unidad' => 'required',
            'seleccion' => 'required',
            'descripcion' => 'required|min:6|max:500',
            'titular'=> 'required',
            'titular_aux'=> 'max:80',
            'id_sp_aux'=> 'numeric',
            'coordinador'=> 'required',
            'coor_aux'=> 'max:80',
            'id_sp_coor'=> 'numeric',
            'enlace'=> 'required',
            'enlace_aux'=> 'max:80',
            'id_sp_enlace'=> 'numeric',
            'riesgo' => 'required|min:6|max:150',
            'decision' => 'required',
            'clasificacion' => 'required',
            'otro' => 'max:100',
            'efectos' => 'required|min:6|max:500',
            'impacto' => 'required',
            'ocurrencia' => 'required'
        ];
    }
}
