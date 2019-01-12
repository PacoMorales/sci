<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admon_riesgosModel extends Model
{
    protected $table = "SCI_ADMON_RIESGOS";
    protected  $primaryKey = 'CVE_ADMON_RIESGO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'CVE_ADMON_RIESGO',
        'DESC_ADMON_RIESGO',
        'STATUS_1',
        'SE_PUBLICA',
        'FECHA_REG'
    ];
}
