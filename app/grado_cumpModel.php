<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grado_cumpModel extends Model
{
     protected $table = "SCI_GRADO_CUMP";
    protected  $primaryKey = 'CVE_GRADO_CUMP';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'CVE_GRADO_CUMP', 
	    'DESC_GRADO_CUMP',
	    'SEMAFORO_GRADO_CUMP'
    ];
}
