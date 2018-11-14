<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ced_evaluacionModel extends Model
{
    protected $table = "SCI_CED_EVALUACION";
    protected  $primaryKey = 'NUM_EVAL';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'N_PERIODO', 
	    'ESTRUCGOB_ID',
	    'CVE_DEPENDENCIA',
	    'NUM_EVAL',
	    'MES',
	    'NUM_ECI',
	    'CVE_NGCI',
	    'NUM_MEEC',
	    'RESPONSABLE',
	    'STATUS_1',
	    'USU',
	    'PW',
	    'IP',
	    'FECHA_REG',
	    'USU_M',
	    'PW_M',
	    'IP_M',
	    'FECHA_M',
	    'CVE_PROCESO',
	    'OBJ_EVAL',
        'ENLACE'
    ];
}
