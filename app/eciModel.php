<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eciModel extends Model
{
    protected $table = "SCI_ECI";
    protected  $primaryKey = 'NUM_ECI';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'NUM_ECI', 
	    'PREG_ECI',
        'CVE_NGCI'
    ];
}
