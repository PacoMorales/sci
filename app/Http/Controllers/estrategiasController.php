<?php

namespace App\Http\Controllers;

use App\estrategiasModel;
use Illuminate\Http\Request;

use App\estructurasModel;
use App\critseccModel;
use App\tipoprocesoModel;
use App\dependenciasModel;
use App\procesosModel;
use App\ponderacionModel;
use App\eciModel;
use App\ngciModel;
use App\ced_evaluacionModel;
use App\m_evaelemcontrolModel;
use App\servidorespubModel;
use App\grado_cumpModel;
use App\matrizModel;
use App\progtrabModel;
use App\accionesmejoraModel;

class estrategiasController extends Controller
{
    public function actionNuevoPlan(){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
        $rango = session()->get('rango');

        $unidades = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->orderBy('DEPEN_DESC','asc')
            ->get();
        //dd($unidades);
        $preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        return view('sicinar.plandetrabajo.nuevoPlan',compact('unidades','nombre','usuario','estructura','id_estructura','rango','preguntas','apartados'));
    }

    public function actionAltaNuevoPlan(Request $request){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
        $rango = session()->get('rango');
        $ip = session()->get('ip');
        $plan = progtrabModel::select('STATUS_1')
            ->where('N_PERIODO',date('Y'))
            ->where('ESTRUCGOB_ID','like',$request->estructura.'%')
            ->where('CVE_DEPENDENCIA','like',$request->unidad.'%')
            ->get();
        //dd($plan->count());
        if($plan->count() > 0){
            toastr()->error('El Plan de Trabajo para esta Unidad Administrativa ya ha sido creado.','Plan de Trabajo Duplicado!',['positionClass' => 'toast-bottom-right']);
            return back();
        }
        $unidades = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->orderBy('DEPEN_DESC','asc')
            ->get();
        $preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        $id_plan = progtrabModel::max('NUM_EVAL');
        $id_plan = $id_plan+1;
        $nuevoPlan = new progtrabModel();
        $nuevoPlan->N_PERIODO = date('Y');
        $nuevoPlan->ESTRUCGOB_ID = $request->estructura;
        $nuevoPlan->CVE_DEPENDENCIA = $request->unidad;
        $nuevoPlan->TITULAR = strtoupper($request->titular);
        $nuevoPlan->NUM_EVAL = $id_plan;
        $nuevoPlan->MES = date('m');
        $nuevoPlan->STATUS_1 = 'A';
        $nuevoPlan->FECHA_REG = date('Y/m/d');
        $nuevoPlan->USU = $usuario;
        $nuevoPlan->IP = $ip;
        $nuevoPlan->FECHA_M = date('Y/m/d');
        $nuevoPlan->USU_M = $usuario;
        $nuevoPlan->IP_M = $ip;
        if($nuevoPlan->save() == true){
            toastr()->success('El Plan de Trabajo ha sido dado de alta correctamente.','Plan de Trabajo dado de alta!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoPlan');
            //return view('sicinar.plandetrabajo.nuevoPlan',compact('unidades','nombre','usuario','estructura','id_estructura','rango','preguntas','apartados'));
        }else{
            toastr()->error('Ha ocurrido algo inesperado al dar de alta el Plan de Trabajo. Vuelve a interlo.','Ups!',['positionClass' => 'toast-bottom-right']);
            return back();
        }
    }

    public function actionVerPlan(){

    }
}
