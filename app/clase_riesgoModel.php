<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clase_riesgoModel extends Model
{
    protected $table = "SCI_CLASE_RIESGO";
    protected  $primaryKey = 'CVE_CLASE_RIESGO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'CVE_CLASE_RIESGO',
        'DESC_CLASE_RIESGO'
    ];
}
