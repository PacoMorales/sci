<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estructurasModel extends Model
{
    protected $table = "LU_ESTRUCGOB";
    protected  $primaryKey = 'ESTRUCGOB_ID';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
	    'ESTRUCGOB_ID', 
	    'ESTRUCGOB_DESC',
        'CLASIFICGOB_ID',
        'DEPENGOB_ID'
    ];

    public static function ObtEstruc($id){
    	return (estructurasModel::where('ESTRUCGOB_ID','like','%'.$id.'%')->get());
    }

    public static function Estructuras(){
        return (estructurasModel::select('ESTRUCGOB_ID','ESTRUCGOB_DESC')
                                    ->whereRaw("ESTRUCGOB_ID like '%22400%' OR ESTRUCGOB_ID like '%21500%' OR ESTRUCGOB_ID like '%21200%' OR ESTRUCGOB_ID like '%20400%' OR ESTRUCGOB_ID like '%21700%' OR ESTRUCGOB_ID like '%20700%'  OR ESTRUCGOB_ID like '%22500%'")
                                    ->get());
    }
}
