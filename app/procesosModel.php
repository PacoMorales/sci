<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class procesosModel extends Model
{
    protected $table = "SCI_PROCESOS";
    protected  $primaryKey = 'CVE_PROCESO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'ESTRUCGOB_ID',
	    'CVE_DEPENDENCIA',
	    'CVE_PROCESO', 
	    'DESC_PROCESO',
	    'CVE_TIPO_PROC',
	    'RESPONSABLE',
	    'CVE_CRIT_SPROC_A',
	    'CVE_CRIT_SPROC_B',
	    'CVE_CRIT_SPROC_C',
	    'CVE_CRIT_SPROC_D',
	    'CVE_CRIT_SPROC_E',
	    'CVE_CRIT_SPROC_F',
	    'CVE_CRIT_SPROC_G',
	    'CVE_CRIT_SPROC_H',
	    'USU',
	    'PW',
	    'IP',
	    'FECHA_REG',
	    'USU_M',
	    'PW_M',
	    'IP_M',
	    'FECHA_REG_M'
    ];
}
