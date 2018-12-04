<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prob_ocurModel extends Model
{
    protected $table = "SCI_PROBABILIDAD_OCURRENCIA";
    protected  $primaryKey = 'ESCALA_VALOR';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'ESCALA_VALOR',
        'DESC_OCURRENCIA',
        'PROBABILIDAD_OCURRENCIA',
        'RANGO_OCURRENCIA'
    ];
}
