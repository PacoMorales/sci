<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_controlModel extends Model
{
    protected $table = "SCI_TIPO_CONTROL";
    protected  $primaryKey = 'CVE_TIPO_CONTROL';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'CVE_TIPO_CONTROL',
        'DESC_TIPO_CONTROL',
        'SE_PUBLICA',
        'FECHA_REG'
    ];
}
