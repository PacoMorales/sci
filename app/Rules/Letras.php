<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Letras implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!empty($value)){
            $abc = "abcdefghijklmnñopqrstuwyxz ABCDEFGHIJKLMNÑOPQRSTUWYXZ";
            $long = strlen($abc);
            $longitud = strlen($value);
            //dd('la longitud de abc es de:'.$long.'. Y la longitud de la cadena es de:'.$longitud.'.');
            for($i=0;$i<$longitud;$i++){
                if(strpos($abc,$value[$i]) !== false){
                    continue;
                }else{
                    dd($value.' en posición '.$i.'='.$value[$i]);
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este campo contiene caracteres inválidos.';
    }
}
