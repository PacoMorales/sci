<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\estrategiasModel;
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
use PDF;
use App\clase_riesgoModel;
use App\nivel_riesgoModel;
use App\clasificacion_riesgoModel;

class adm_riesgosController extends Controller
{
    public function actionVerRiesgo(){
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
        $planes = progtrabModel::select('CVE_DEPENDENCIA','NUM_EVAL','TITULAR','STATUS_1','STATUS_2')
            ->where('N_PERIODO',2018)
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('STATUS_1','LIKE','S%')
            ->orderBy('NUM_EVAL','ASC')
            ->paginate(10);
        if($planes->count() <= 0){
            toastr()->error('No existe ningún Plan de Trabajo dado de alta.','Lo siento!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un Plan de Trabajo.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoPlan');
        }
        $unidades = dependenciasModel::Unidades('21500');
        return view('sicinar.administracionderiesgos.verTodos',compact('nombre','usuario','estructura','rango','id_estructura','planes','unidades'));
    }

    public function actionNuevoRiesgo(){
        //dd('Nuevo riesgo...');
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
        $clases = clase_riesgoModel::orderBy('CVE_CLASE_RIESGO','ASC')->get();
        $niveles = nivel_riesgoModel::orderBy('CVE_NIVEL_DECRIESGO','ASC')->get();
        $clasificaciones = clasificacion_riesgoModel::orderBy('CVE_CLASIF_RIESGO','ASC')->get();
        return view('sicinar.administracionderiesgos.nuevo',compact('nombre','usuario','estructura','rango','id_estructura','planes','unidades'));
    }

    public function actionAltaRiesgo(Request $request){
        dd($request->all());
    }
}
