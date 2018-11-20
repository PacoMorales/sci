<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ponderacionModel extends Model
{
    protected $table = "SCI_PONDERACION";
    protected  $primaryKey = 'CVE_PROCESO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'N_PERIODO', 
	    'ESTRUCGOB_ID',
	    'CVE_DEPENDENCIA',
	    'NUM_EVAL',
	    'STATUS_1',
	    'CVE_PROCESO',
	    'POND_NGCI1',
	    'POND_NGCI2',
	    'POND_NGCI3',
	    'POND_NGCI4',
	    'POND_NGCI5',
	    'USU',
	    'PW',
	    'IP',
	    'FECHA_REG',
	    'USU_M',
	    'PW_M',
	    'IP_M',
	    'FECHA_M',
        'TOTAL'
    ];
}
