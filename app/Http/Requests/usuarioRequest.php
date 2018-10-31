<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class usuarioRequest extends FormRequest
{
    public function messages()
    {
        return [
            'usuario.min'         => 'El usuario debe ser de mínimo 5 caracteres.',
            'usuario.max'         => 'El usuario debe ser de máximo 50 caracteres.',
            //'usuario.e_mail'      => 'El usuario debe estar en un formato de email (ejemplo@ejemplo.com).',
            'usuario.required'    => 'El usuario es necesario para entrar al sistema.',
            'password.min'        => 'La contraseña debe ser de mínimo 6 caracteres.',
            'password.max'        => 'La contraseña debe ser de máximo 30 caracteres.',
            'password.required'   => 'La contraseña es necesaria para registrarse.',
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
            'usuario' =>  'min:5|max:50|required',
            'password' =>  'min:6|max:30|required'
        ];
    }
}
