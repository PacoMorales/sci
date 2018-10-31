<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dependenciasModel extends Model
{
    protected $table = "LU_DEPENDENCIAS";
    protected  $primaryKey = 'DEPEN_ID';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'DEPEN_ID', 
	    'DEPEN_DESC',
	    'ESTRUCGOB_ID',
        'CLASIFICGOB_ID'
    ];

    public static function Unidades($id){
        return dependenciasModel::select('DEPEN_ID','DEPEN_DESC','ESTRUCGOB_ID','CLASIFICGOB_ID')
        							->where('ESTRUCGOB_ID','like','%'.$id.'%')
        							->where('CLASIFICGOB_ID','=',1)
                                    ->orderBy('DEPEN_ID','asc')
                                    ->get();
    }
}
