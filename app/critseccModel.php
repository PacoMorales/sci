<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class critseccModel extends Model
{
    protected $table = "SCI_CRIT_SELECPROC";
    protected  $primaryKey = 'CVE_CRIT_SPROC';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'CVE_CRIT_SPROC', 
	    'DESC_CRIT_SPROC'
    ];
}
