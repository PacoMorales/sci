<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class riesgosModel extends Model
{
    protected $table = "SCI_RIESGOS";
    protected  $primaryKey = 'CVE_RIESGO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'N_PERIODO',
        'ESTRUCGOB_ID',
        'CVE_DEPENDENCIA',
        'TITULAR',
        'ID_SP_1',
        'COORDINADOR',
        'ID_SP_2',
        'ENLACE',
        'ID_SP_3',
        'CVE_RIESGO',
        'DESC_RIESGO',
        'ALINEACION_RIESGO',
        'CVE_CLASE_RIESGO',
        'CVE_NIVEL_DECRIESGO',
        'CVE_CLASIF_RIESGO',
        'OTRO_CLASIF_RIESGO',
        'EFECTOS_RIESGO',
        'GRADO_IMPACTO',
        'ESCALA_VALOR',
        'GRADO_IMPACTO_2',
        'ESCALA_VALOR_2',
        'STATUS_1', //Estado 1 Estado del riesgo:  N = Inactivo, Null=S=Activo
        'STATUS_2', //Estado 2 Riesgo controlado suficientemente, N=No, S=Si
        'FECHA_REG',
        'USU',
        'IP',
        'FECHA_M',
        'USU_M',
        'IP_M'
    ];
}
