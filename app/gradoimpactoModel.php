<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gradoimpactoModel extends Model
{
    protected $table = "SCI_GRADOIMPACTO_RIESGO";
    protected  $primaryKey = 'GRADO_IMPACTO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'GRADO_IMPACTO',
        'IMPACTO'
    ];
}
