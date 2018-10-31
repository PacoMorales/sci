<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuarioModel extends Model
{
    protected $table = 'SCI_CTRL_ACCESO';
    protected  $primaryKey = 'LOGIN';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'N_PERIODO', 
	    'CVE_PROGRAMA', 
	    'FOLIO',
	    'ESTRUCGOB_ID',
	    'CVE_DEPENDENCIA',
	    'LOGIN',
	    'PASSWORD',
	    'TIPO_USUARIO',
      	'STATUS_1', //TIPO DE USUARIO [3 => ADMIN, 2 => GENERAL, 3 => PARTICULAR]
      	'STATUS_2',
	    'FECHA_REGISTRO'
    ];
}
