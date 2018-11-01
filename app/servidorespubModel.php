<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servidorespubModel extends Model
{
    protected $table = "SCI_SERVIDORESPUB";
    protected  $primaryKey = 'ID_SP';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'ID_SP'
    ];
}
