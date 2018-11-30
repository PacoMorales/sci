<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accionesmejoraModel extends Model
{
    protected $table = "SCI_ACCIONES_MEJORA";
    protected  $primaryKey = 'CVE_DEPENDENCIA';
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
        'NUM_MEEC_2',
        'PROCESOS',
        'NO_ACC_MEJORA',
        'DESC_ACC_MEJORA',
        'FECHA_INI',
        'FECHA_TER',
        'ID_SP',
        'MEDIOS_VERIFICACION',
        'STATUS_1', //S ACTIVO B INACTIVO
        'STATUS_2', //0 PENDIENTE 1 CONCLUIDO
        'STATUS_3', //0 SIN ACCION 1 CON ACCION
        'FECHA_REG',
        'USU',
        'IP',
        'FECHA_M',
        'USU_M',
        'IP_M'
    ];
}
