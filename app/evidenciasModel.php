<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class evidenciasModel extends Model
{
    protected $table = "SCI_EVIDENCIAS";
    protected  $primaryKey = 'CVE_EVIDENCIA';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'CVE_EVIDENCIA', 
	    'DESC_EVIDENCIA'
    ];
}
