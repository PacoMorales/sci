<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoprocesoModel extends Model
{
    protected $table = "SCI_TIPO_PROCESO";
    protected  $primaryKey = 'CVE_TIPO_PROC';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'CVE_TIPO_PROC', 
	    'DESC_TIPO_PROC'
    ];
}
