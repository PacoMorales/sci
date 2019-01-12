<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estrategias_accionesModel extends Model
{
    protected $table = "SCI_ESTRATEGIAS_YACCIONES";
    protected  $primaryKey = 'CVE_ACCION';
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
        'STATUS_1',
        'STATUS_2',
        'USU',
        'IP',
        'FECHA_REG',
        'USU_M',
        'IP_M',
        'FECHA_M'
    ];
}
