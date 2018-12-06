<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_factorModel extends Model
{
    protected $table = "SCI_TIPO_FACTOR";
    protected  $primaryKey = 'CVE_TIPO_FACTOR';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'CVE_TIPO_FACTOR',
        'DESC_TIPO_FACTOR',
        'OBS_TIPO_FACTOR',
        'SE_PUBLICA',
        'FECHA_REG'
    ];
}
