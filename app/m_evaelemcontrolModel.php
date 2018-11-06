<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_evaelemcontrolModel extends Model
{
    protected $table = "SCI_M_EVAELEMCONTROL";
    protected  $primaryKey = 'NUM_MEEC';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'NUM_MEEC', 
	    'VALOR_MEEC',
	    'PORC_MEEC',
	    'CVE_GRADO_CUMP'
    ];
}
