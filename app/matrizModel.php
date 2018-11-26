<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class matrizModel extends Model
{
    protected $table = "SCI_MATRIZ_GCECBED";
    protected  $primaryKey = 'NUM_REN';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'NUM_REN',
        'ETAPA_GRADO',
        'C_1',
        'C_2',
        'C_3',
        'C_4',
        'C_5',
        'C_6',
        'SE_PUBLICA',
        'FECHA_REG'
    ];
}
