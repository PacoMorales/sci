<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\usuarioModel;
use App\estructurasModel;
use App\critseccModel;
use App\tipoprocesoModel;
use App\dependenciasModel;
use App\procesosModel;
use App\Http\Requests\procesoRequest;

class procesosController extends Controller
{
    public function actionVerAltaProcesos(){
    	$nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $rango = session()->get('rango');
        $criterios = critseccModel::select('CVE_CRIT_SPROC','DESC_CRIT_SPROC')->orderBy('CVE_CRIT_SPROC','ASC')->get();
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        //$estructuras = estructurasModel::Estructuras();
        $estructuras = estructurasModel::select('ESTRUCGOB_ID','ESTRUCGOB_DESC')->where('ESTRUCGOB_ID','like','21500%')->get();
        return view('sicinar.procesos.alta',compact('usuario','nombre','estructura','criterios','tipos','estructuras','rango'));
    }

    public function actionAltaProcesos(procesoRequest $request){
        //dd($request->all());
    	$nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $dependencia = session()->get('dependencia');
        $ip = session()->get('ip');
        $rango = session()->get('rango');
        $resp = "NO ESPECIFICADA";
        if($request->unidad == NULL){
            $resp = "NO ESPECIFICADA";
        }else{
            $responsable = dependenciasModel::select('DEPEN_DESC')->where('CLASIFICGOB_ID','=',1)->where('ESTRUCGOB_ID','like','%'.$request->secretaria.'%')->where('DEPEN_ID','like','%'.$request->unidad.'%')->where('CLASIFICGOB_ID',1)->get();    
            $resp = substr($responsable[0]->depen_desc,0,79);
        }
        //$responsable = dependenciasModel::select('DEPEN_DESC')->where('CLASIFICGOB_ID','=',1)->where('ESTRUCGOB_ID','like','%'.$request->secretaria.'%')->where('DEPEN_ID','like','%'.$request->unidad.'%')->where('CLASIFICGOB_ID',1)->get();
        //dd($responsable->all());
        //$resp = substr($responsable[0]->depen_desc,0,79);
    	$id_proc = procesosModel::max('CVE_PROCESO');
    	$id_proc = $id_proc + 1;
    	$nuevo = new procesosModel();
    	$nuevo->N_PERIODO = date('Y');
    	$nuevo->ESTRUCGOB_ID = $request->secretaria;
        if($rango > 1){
    	   $nuevo->CVE_DEPENDENCIA = $request->unidad;
        }else{
           $nuevo->CVE_DEPENDENCIA = $dependencia; 
        }
    	$nuevo->CVE_PROCESO = $id_proc;
    	$nuevo->DESC_PROCESO = strtoupper($request->descripcion);
    	$nuevo->CVE_TIPO_PROC = $request->tipo;
    	$nuevo->RESPONSABLE = strtoupper($resp);
    	if($request->A != NULL){$nuevo->CVE_CRIT_SPROC_A = 1;}else{$nuevo->CVE_CRIT_SPROC_A = 0;}
    	if($request->B != NULL){$nuevo->CVE_CRIT_SPROC_B = 1;}else{$nuevo->CVE_CRIT_SPROC_B = 0;}
    	if($request->C != NULL){$nuevo->CVE_CRIT_SPROC_C = 1;}else{$nuevo->CVE_CRIT_SPROC_C = 0;}
    	if($request->D != NULL){$nuevo->CVE_CRIT_SPROC_D = 1;}else{$nuevo->CVE_CRIT_SPROC_D = 0;}
    	if($request->E != NULL){$nuevo->CVE_CRIT_SPROC_E = 1;}else{$nuevo->CVE_CRIT_SPROC_E = 0;}
    	if($request->F != NULL){$nuevo->CVE_CRIT_SPROC_F = 1;}else{$nuevo->CVE_CRIT_SPROC_F = 0;}
    	if($request->G != NULL){$nuevo->CVE_CRIT_SPROC_G = 1;}else{$nuevo->CVE_CRIT_SPROC_G = 0;}
    	if($request->H != NULL){$nuevo->CVE_CRIT_SPROC_H = 1;}else{$nuevo->CVE_CRIT_SPROC_H = 0;}
        $nuevo->STATUS_1 = 'N';
    	$nuevo->USU = $nombre;
    	$nuevo->PW = $pass;
    	$nuevo->IP = $ip;
    	$nuevo->FECHA_REG = date('Y/m/d');
    	$nuevo->USU_M = $nombre;
    	$nuevo->PW_M = $pass;
    	$nuevo->IP_M = $ip;
    	$nuevo->FECHA_M = date('Y/m/d');
    	if($nuevo->save() == true){
    		$criterios = critseccModel::select('CVE_CRIT_SPROC','DESC_CRIT_SPROC')->orderBy('CVE_CRIT_SPROC','ASC')->get();
        	$tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        	$estructuras = estructurasModel::Estructuras();
        	toastr()->success('El proceso se ha guardado correctamente.','Bien!',['positionClass' => 'toast-bottom-right']);
        	return view('sicinar.procesos.alta',compact('usuario','nombre','estructura','rango','criterios','tipos','estructuras'));
    	}else{
            toastr()->error('El proceso no se ha guardado correctamente.','Mal!',['positionClass' => 'toast-bottom-right']);
    		return view('sicinar.login.expirada');
    	}
    }

    public function actionVerProcesos(){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
        //dd($id_estructura);
        $rango = session()->get('rango');
        $total = procesosModel::count();
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1')->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.verProcesos',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function FunctionName(){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
        //dd($id_estructura);
        $rango = session()->get('rango');
        return view('sicinar.procesos.graficaProcesos',compact('nombre','usuario','estructura','rango'));
    }

    public function actionUnidades(Request $request, $id){
    	return (response()->json(dependenciasModel::Unidades($id)));
    	$nuevo = new procesosModel();
    }
}
