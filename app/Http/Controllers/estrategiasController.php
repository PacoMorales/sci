<?php

namespace App\Http\Controllers;

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

        $unidades = dependenciasModel::Unidades('21500');
        //dd($unidades);
        $preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        return view('sicinar.plandetrabajo.nuevoPlan',compact('unidades','nombre','usuario','estructura','id_estructura','rango','preguntas','apartados'));
    }

    public function actionAltaNuevoPlan(Request $request){
        dd($request->all());
    }
}
