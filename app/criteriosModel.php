<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class criteriosModel extends Model
{
    protected $table = "SCI_CRITERIOS";
    protected  $primaryKey = 'CVE_CRITERIO';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'CVE_CRITERIO', 
	    'DESC_CRITERIO',
	    'CVE_ESTAPA'
    ];
}
