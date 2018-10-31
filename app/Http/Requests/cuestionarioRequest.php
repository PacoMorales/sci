<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class cuestionarioRequest extends FormRequest
{
    public function messages()
    {
        return [
            'titular.min'         => 'El nombre del Titular debe ser de mínimo 1 caracter.',
            'titular.max'         => 'El nombre del Titular debe ser de máximo 80 caracteres.',
            'titular.required'    => 'El nombre del Titular es necesario para registrarlo al sistema.',
            'objetivo.min'            => 'El objetivo debe ser de mínimo 1 caracteres.',
            'objetivo.max'            => 'El objetivo debe ser de máximo 80 caracteres.',
            'objetivo.required'       => 'El objetivo es necesario para consolidar la evaluación.',
            'proceso.required'        => 'El proceso es necesario para identificar llevar a cabo la evaluación.',
            'unidad.required'            => 'La unidad es necesaria para identificar al proceso.',
            'evaluacion1.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion2.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion3.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion4.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion5.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion6.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion7.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion8.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion9.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion10.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion11.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion12.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion13.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion14.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion15.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion16.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion17.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion18.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion19.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion20.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion21.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion22.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion23.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion24.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion25.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion26.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion27.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion28.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion29.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion30.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion31.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion32.required'              => 'La evaluación es necesaria para la evaluación.',
            'evaluacion33.required'              => 'La evaluación es necesaria para la evaluación.'
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
            'titular'    => 'min:1|max:80|required',
            'objetivo'   => 'min:1|max:80|required',
            'proceso' => 'required',
            'unidad'     => 'required',
            'evaluacion1' => 'required',
            'evaluacion2' => 'required',
            'evaluacion3' => 'required',
            'evaluacion4' => 'required',
            'evaluacion5' => 'required',
            'evaluacion6' => 'required',
            'evaluacion7' => 'required',
            'evaluacion8' => 'required',
            'evaluacion9' => 'required',
            'evaluacion10' => 'required',
            'evaluacion11' => 'required',
            'evaluacion12' => 'required',
            'evaluacion13' => 'required',
            'evaluacion14' => 'required',
            'evaluacion15' => 'required',
            'evaluacion16' => 'required',
            'evaluacion17' => 'required',
            'evaluacion18' => 'required',
            'evaluacion19' => 'required',
            'evaluacion20' => 'required',
            'evaluacion21' => 'required',
            'evaluacion22' => 'required',
            'evaluacion23' => 'required',
            'evaluacion24' => 'required',
            'evaluacion25' => 'required',
            'evaluacion26' => 'required',
            'evaluacion27' => 'required',
            'evaluacion28' => 'required',
            'evaluacion29' => 'required',
            'evaluacion30' => 'required',
            'evaluacion31' => 'required',
            'evaluacion32' => 'required',
            'evaluacion33'=> 'required'
        ];
    }
}
