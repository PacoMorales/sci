<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clasif_factorriesgoModel extends Model
{
    protected $table = "SCI_CLASIF_FACTORRIESGO";
    protected  $primaryKey = 'CVE_CLASIF_FACTORRIESGO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'CVE_CLASIF_FACTORRIESGO',
        'DESC_CLASIF_FACTORRIESGO'
    ];
}
