<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ngciModel extends Model
{
    protected $table = "SCI_NGCI";
    protected  $primaryKey = 'CVE_NGCI';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'CVE_NGCI', 
	    'DESC_NGCI',
        'VISION_NGCI'
    ];
}
