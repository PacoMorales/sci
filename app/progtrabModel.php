<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class progtrabModel extends Model
{
    //CLASE MODELO DE PROGRAMAS DE TRABAJO
    protected $table = "SCI_PROGTRAB_CI";
    protected  $primaryKey = 'CVE_DEPENDENCIA';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'N_PERIODO',
        'ESTRUCGOB_ID',
        'CVE_DEPENDENCIA',
        'TITULAR',
        'NUM_EVAL',
        'MES',
        'STATUS_1',
        'STATUS_2',
        'FECHA_REG',
        'USU',
        'IP',
        'FECHA_M',
        'USU_M',
        'IP_M'
    ];
}
