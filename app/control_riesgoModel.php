<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class control_riesgoModel extends Model
{
    protected $table = "SCI_CONTROLES_DERIESGO";
    protected  $primaryKey = 'CVE_CONTROL_DERIESGO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'N_PERIODO',
        'ESTRUCGOB_ID',
        'CVE_DEPENDENCIA',
        'CVE_RIESGO',
        'NUM_FACTOR_RIESGO',
        'CVE_CONTROL_DERIESGO',
        'DESC_CONTROL_DERIESGO',
        'CVE_TIPO_CONTROL',
        'CVE_DEFSUF_CONTROL',
        'DOCUMENTADO',
        'FORMALIZADO',
        'APLICA',
        'EFECTIVO',
        'STATUS_1', //Estado del control del riesgo  null=S=Activo,   N=Inactivo
        'STATUS_2',
        'FECHA_REG',
        'USU',
        'IP',
        'FECHA_M',
        'USU_M',
        'IP_M'
    ];
}
