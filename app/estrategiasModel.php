<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estrategiasModel extends Model
{
    protected $table = "SCI_ESTRATEGIAS_YACCIONES";
    protected  $primaryKey = 'CVE_DEPENDENCIA';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'N_PERIODO',
        'ESTRUCGOB_ID',
        'CVE_DEPENDENCIA',
        'CVE_RIESGO',
        'NUM_FACTOR_RIESGO',
        'CVE_ACCION',
        'DESC_ACCION',
        'ID_SP',
        'FECHA_INI',
        'FECHA_FIN',
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
