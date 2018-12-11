<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class defsuficienciaModel extends Model
{
    protected $table = "SCI_DEFSUFICIENCIA_CONTROL";
    protected  $primaryKey = 'CVE_DEFSUF_CONTROL';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'CVE_DEFSUF_CONTROL',
        'DESC_DEFSUF_CONTROL',
        'OBS_DEFSUF_CONTROL',
        'SE_PUBLICA',
        'FECHA_REG'
    ];
}
