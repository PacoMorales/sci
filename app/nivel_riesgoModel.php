<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nivel_riesgoModel extends Model
{
    protected $table = "SCI_NIVEL_DECISIONRIESGO";
    protected  $primaryKey = 'CVE_NIVEL_DECRIESGO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'CVE_NIVEL_DECRIESGO',
        'DESC_DECRIESGO'
    ];
}
