<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clasificacion_riesgoModel extends Model
{
    protected $table = "SCI_CLASIFACION_RIESGOS";
    protected  $primaryKey = 'CVE_CLASIF_RIESGO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'CVE_CLASIF_RIESGO',
        'DESC_CLASIF_RIESGO'
    ];
}
