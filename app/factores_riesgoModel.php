<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factores_riesgoModel extends Model
{
    protected $table = "SCI_FACTORES_RIESGO";
    protected  $primaryKey = 'CVE_RIESGO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'N_PERIODO',
        'ESTRUCGOB_ID',
        'CVE_DEPENDENCIA',
        'CVE_RIESGO',
        'NUM_FACTOR_RIESGO',
        'DESC_FACTOR_RIESGO',
        'CVE_CLASIF_FACTORRIESGO',
        'CVE_TIPO_FACTOR',
        'STATUS_1',
        'STATUS_2',
        'SE_PUBLICA',
        'FECHA_REG'
    ];
}
