<?php

namespace App\Http\Controllers;

use App\ngciModel;
use Illuminate\Http\Request;
use App\usuarioModel;
use App\estructurasModel;
use App\critseccModel;
use App\tipoprocesoModel;
use App\dependenciasModel;
use App\procesosModel;
use App\ponderacionModel;
use App\eciModel;
use App\ced_evaluacionModel;
use App\m_evaelemcontrolModel;
use App\servidorespubModel;
use App\grado_cumpModel;
use App\matrizModel;
use App\Http\Requests\procesoRequest;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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
        $nuevo->STATUS_2 = 'A';
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
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('STATUS_2','LIKE','A%')
            ->orderBy('CVE_PROCESO','ASC')
            ->paginate(5);
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

    public function actionVerProcesosSustantivos(){
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
        //1 ADMINISTRATIVO, 2 SUSTANTIVO, 3 INSTITUCIONAL
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1')
            ->where('CVE_TIPO_PROC',2)
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('STATUS_2','LIKE','A%')
            ->orderBy('CVE_PROCESO','ASC')
            ->paginate(25);
        //dd($procesos->all());
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.verProcesosSustantivos',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionVerProcesosAdministrativos(){
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
        //1 ADMINISTRATIVO, 2 SUSTANTIVO, 3 INSTITUCIONAL
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1')
            ->where('CVE_TIPO_PROC',1)
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('STATUS_2','LIKE','A%')
            ->orderBy('CVE_PROCESO','ASC')
            ->paginate(25);
        //dd($procesos->all());
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.verProcesosAdministrativos',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionVerProcesosInstitucionales(){
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
        //1 ADMINISTRATIVO, 2 SUSTANTIVO, 3 INSTITUCIONAL
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1')
            ->where('CVE_TIPO_PROC',3)
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('STATUS_2','LIKE','A%')
            ->orderBy('CVE_PROCESO','ASC')
            ->paginate(25);
        //dd($procesos->all());
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.verProcesosInstitucionales',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionEvalProcesos(){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
        $dependencia = session()->get('nombre_dependencia');
        $id_dependencia = session()->get('dependencia');
        //dd($id_estructura);
        $rango = session()->get('rango');
        $total = ponderacionModel::count();
        $procesos = ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
                                        ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5','SCI_PONDERACION.TOTAL')
                                        ->where('SCI_PROCESOS.N_PERIODO',(int)date('Y'))
                                        ->where('SCI_PROCESOS.ESTRUCGOB_ID','like','21500%')
                                        ->where('SCI_PROCESOS.STATUS_2','LIKE','A%')
                                        ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
                                        ->paginate(15);
        //dd($procesos);
        if($id_estructura == '0')
            $dependencias = dependenciasModel::Unidades('21500');
        else
            $dependencias = dependenciasModel::Unidades($id_estructura);
        //dd($dependencias);
        $estructuras = estructurasModel::Estructuras();
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $apartados = ngciModel::select('DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        return view('sicinar.procesos.evalProcesos',compact('nombre','usuario','estructura','rango','procesos','total','estructuras','dependencias','tipos','apartados'));
    }

    public function actionUnidades(Request $request, $id){
    	return (response()->json(dependenciasModel::Unidades($id)));
    	//$nuevo = new procesosModel();
    }

    public function export(){
        return Excel::download(new ExcelExport, 'Procesos_'.date('d-m-Y').'.xlsx');
    }

    public function verPDF($id){
        set_time_limit(0);
        ini_set("memory_limit",-1);
        ini_set('max_execution_time', 0);
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $proceso = ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
                                    ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5','SCI_PONDERACION.TOTAL')
                                    ->where('SCI_PROCESOS.CVE_PROCESO',$id)
                                    ->where('SCI_PROCESOS.STATUS_1','like','E%')
                                    ->where('SCI_PROCESOS.STATUS_2','like','A%')
                                    ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
                                    ->get();
        if($proceso->count() <= 0){
            toastr()->error('No ha sido evaluado este proceso.','Que mal!',['positionClass' => 'toast-bottom-right']);
            return back();
        }
        $unidades = dependenciasModel::select('DEPEN_DESC')->where('DEPEN_ID','LIKE',$proceso[0]->cve_dependencia.'%')->first();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON','DEPEN_ID')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        $preguntas = ced_evaluacionModel::join('SCI_ECI','SCI_CED_EVALUACION.NUM_ECI','=','SCI_ECI.NUM_ECI')
                                            ->select('SCI_CED_EVALUACION.ID_SP','SCI_ECI.NUM_ECI','SCI_ECI.PREG_ECI','SCI_CED_EVALUACION.NUM_ECI','SCI_CED_EVALUACION.CVE_NGCI','SCI_CED_EVALUACION.NUM_MEEC','SCI_CED_EVALUACION.FECHA_REG')
                                            ->where('SCI_CED_EVALUACION.CVE_PROCESO','=',$id)
                                            ->get();
        $valores = m_evaelemcontrolModel::select('NUM_MEEC','PORC_MEEC')->orderBy('NUM_MEEC','ASC')->get();
        $grados = grado_cumpModel::select('CVE_GRADO_CUMP','DESC_GRADO_CUMP')->get();
        $pdf = PDF::loadView('sicinar.pdf.cedPDF', compact('preguntas','apartados','valores','unidades','proceso','servidores','grados'));
        $pdf->setPaper('A4', 'landscape');
        //return $pdf->download('procesos_'.date('d-m-Y').'.pdf');
        return $pdf->stream('CedulaDeEvaluacion-Proceso'.$id);
        //return view('sicinar.pdf.cedulaEvaluacion',compact('proceso','unidades','servidores','apartados','preguntas','valores','grados'));
        //SCI_PROCTRAB_CI
        //SCI_ACCIONES_MEJORA
    }

    public function Graficas(){
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

        $procesos = procesosModel::join('SCI_TIPO_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','=','SCI_TIPO_PROCESO.CVE_TIPO_PROC')
            ->selectRaw('SCI_TIPO_PROCESO.DESC_TIPO_PROC AS TIPO, COUNT(SCI_PROCESOS.CVE_TIPO_PROC) AS TOTAL')
            ->groupBy('SCI_TIPO_PROCESO.DESC_TIPO_PROC')
            ->get();
        //dd($procesos);
        return view('sicinar.graficas.graficas',compact('procesos','nombre','usuario','estructura','id_estructura','rango'));
    }

    public function actionGestionProcesos(){
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
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesos',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionGestionProcesosAdm(){
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
        //1 ADMINISTRATIVO, 2 SUSTANTIVO, 3 INSTITUCIONAL
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',1)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosAdm',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionGestionProcesosInst(){
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
        //1 ADMINISTRATIVO, 2 SUSTANTIVO, 3 INSTITUCIONAL
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',3)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosInst',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionGestionProcesosSust(){
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
        //1 ADMINISTRATIVO, 2 SUSTANTIVO, 3 INSTITUCIONAL
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',2)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosSust',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionActivarProcesos($id){
        //dd('ACTIVAR');
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
        $process = procesosModel::where('CVE_PROCESO',$id)->update(['STATUS_2'=>'A']);
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesos',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionDesactivarProcesos($id){
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
        $process = procesosModel::where('CVE_PROCESO',$id)->update(['STATUS_2'=>'B']);
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesos',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionActivarProcesosAdm($id){
        //dd('ACTIVAR');
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
        $process = procesosModel::where('CVE_PROCESO',$id)->update(['STATUS_2'=>'A']);
        //1 ADMINISTRATIVO, 2 SUSTANTIVO, 3 INSTITUCIONAL
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',1)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosAdm',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionDesactivarProcesosAdm($id){
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
        $process = procesosModel::where('CVE_PROCESO',$id)->update(['STATUS_2'=>'B']);
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',1)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosAdm',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionActivarProcesosSust($id){
        //dd('ACTIVAR');
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
        $process = procesosModel::where('CVE_PROCESO',$id)->update(['STATUS_2'=>'A']);
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',2)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosSust',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionDesactivarProcesosSust($id){
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
        $process = procesosModel::where('CVE_PROCESO',$id)->update(['STATUS_2'=>'B']);
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',2)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosSust',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionActivarProcesosInst($id){
        //dd('ACTIVAR');
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
        $process = procesosModel::where('CVE_PROCESO',$id)->update(['STATUS_2'=>'A']);
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',3)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosInst',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionDesactivarProcesosInst($id){
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
        $process = procesosModel::where('CVE_PROCESO',$id)->update(['STATUS_2'=>'B']);
        $procesos = procesosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA','CVE_PROCESO','DESC_PROCESO','CVE_TIPO_PROC','RESPONSABLE','CVE_CRIT_SPROC_A','CVE_CRIT_SPROC_B','CVE_CRIT_SPROC_C','CVE_CRIT_SPROC_D','CVE_CRIT_SPROC_E','CVE_CRIT_SPROC_F','CVE_CRIT_SPROC_G','CVE_CRIT_SPROC_H','STATUS_1','STATUS_2')->where('CVE_TIPO_PROC',3)->orderBy('CVE_PROCESO','ASC')->paginate(25);
        //dd($procesos);
        if($id_estructura == '0'){
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('CLASIFICGOB_ID',1)->whereRaw("(ESTRUCGOB_ID like '22400%') OR (ESTRUCGOB_ID like '21500%') OR (ESTRUCGOB_ID like '21200%') OR (ESTRUCGOB_ID like '20400%') OR (ESTRUCGOB_ID like '21700%') OR (ESTRUCGOB_ID like '20700%') OR (ESTRUCGOB_ID like '22500%')")->get();
        }else{
            $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like','%'.$id_estructura.'%')->get();
        }
        //dd($dependencias->all());
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $estructuras = estructurasModel::Estructuras();
        return view('sicinar.procesos.listaGestProcesosInst',compact('nombre','usuario','estructura','rango','procesos','total','tipos','estructuras','dependencias'));
    }

    public function actionVerInfo($id){
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

        //$preguntas = ced_evaluacionModel::select()->where()->get();

        $procesos = ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
            ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5','SCI_PONDERACION.TOTAL')
            ->where('SCI_PROCESOS.CVE_PROCESO',$id)
            ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
            ->get();
        //dd($procesos);
        if($procesos->count() <= 0){
            toastr()->error('Este proceso no ha sido evaluado.','Sin Evaluación!',['positionClass' => 'toast-bottom-right']);
            return back();
        }
        $unidades = dependenciasModel::select('DEPEN_DESC')->where('DEPEN_ID','LIKE',$procesos[0]->cve_dependencia.'%')->first();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON','DEPEN_ID')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        $preguntas = ced_evaluacionModel::join('SCI_ECI','SCI_CED_EVALUACION.NUM_ECI','=','SCI_ECI.NUM_ECI')
            ->select('SCI_CED_EVALUACION.NUM_ECI','SCI_CED_EVALUACION.CVE_NGCI','SCI_CED_EVALUACION.NUM_MEEC')
            ->where('SCI_CED_EVALUACION.N_PERIODO','=',(int)date('Y'))
            ->where('SCI_CED_EVALUACION.CVE_PROCESO','=',$id)
            ->get();
        //dd($preguntas);
        $colores[0] = "red";
        if($procesos[0]->pond_ngci1 >= 0 AND $procesos[0]->pond_ngci1 <= 16.79){
            $colores[0] = "red";
        }else{
            if($procesos[0]->pond_ngci1 >= 16.80 AND $procesos[0]->pond_ngci1 <= 33.39){
                $colores[0] = "orange";
            }else{
                if($procesos[0]->pond_ngci1 >= 33.40 AND $procesos[0]->pond_ngci1 <= 50.09){
                    $colores[0] = "green";
                }else{
                    if($procesos[0]->pond_ngci1 >= 50.1 AND $procesos[0]->pond_ngci1 <= 66.79){
                        $colores[0] = "blue";
                    }else{
                        if($procesos[0]->pond_ngci1 >= 66.8 AND $procesos[0]->pond_ngci1 <= 83.39){
                            $colores[0] = "deepskyblue";
                        }else{
                            if($procesos[0]->pond_ngci1 >= 83.4 AND $procesos[0]->pond_ngci1 <= 100){
                                $colores[0] = "gray";
                            }
                        }
                    }
                }
            }
        }
        if($procesos[0]->pond_ngci2 >= 0 AND $procesos[0]->pond_ngci2 <= 16.79){
            $colores[1] = "red";
        }else{
            if($procesos[0]->pond_ngci2 >= 16.80 AND $procesos[0]->pond_ngci2 <= 33.39){
                $colores[1] = "orange";
            }else{
                if($procesos[0]->pond_ngci2 >= 33.40 AND $procesos[0]->pond_ngci2 <= 50.09){
                    $colores[1] = "green";
                }else{
                    if($procesos[0]->pond_ngci2 >= 50.1 AND $procesos[0]->pond_ngci2 <= 66.79){
                        $colores[1] = "blue";
                    }else{
                        if($procesos[0]->pond_ngci2 >= 66.8 AND $procesos[0]->pond_ngci2 <= 83.39){
                            $colores[1] = "deepskyblue";
                        }else{
                            if($procesos[0]->pond_ngci2 >= 83.4 AND $procesos[0]->pond_ngci2 <= 100){
                                $colores[1] = "gray";
                            }
                        }
                    }
                }
            }
        }
        if($procesos[0]->pond_ngci3 >= 0 AND $procesos[0]->pond_ngci3 <= 16.79){
            $colores[2] = "red";
        }else{
            if($procesos[0]->pond_ngci3 >= 16.80 AND $procesos[0]->pond_ngci3 <= 33.39){
                $colores[2] = "orange";
            }else{
                if($procesos[0]->pond_ngci3 >= 33.40 AND $procesos[0]->pond_ngci3 <= 50.09){
                    $colores[2] = "green";
                }else{
                    if($procesos[0]->pond_ngci3 >= 50.1 AND $procesos[0]->pond_ngci3 <= 66.79){
                        $colores[2] = "blue";
                    }else{
                        if($procesos[0]->pond_ngci3 >= 66.8 AND $procesos[0]->pond_ngci3 <= 83.39){
                            $colores[2] = "deepskyblue";
                        }else{
                            if($procesos[0]->pond_ngci3 >= 83.4 AND $procesos[0]->pond_ngci3 <= 100){
                                $colores[2] = "gray";
                            }
                        }
                    }
                }
            }
        }
        if($procesos[0]->pond_ngci4 >= 0 AND $procesos[0]->pond_ngci4 <= 16.79){
            $colores[3] = "red";
        }else{
            if($procesos[0]->pond_ngci4 >= 16.80 AND $procesos[0]->pond_ngci4 <= 33.39){
                $colores[3] = "orange";
            }else{
                if($procesos[0]->pond_ngci4 >= 33.40 AND $procesos[0]->pond_ngci4 <= 50.09){
                    $colores[3] = "green";
                }else{
                    if($procesos[0]->pond_ngci4 >= 50.1 AND $procesos[0]->pond_ngci4 <= 66.79){
                        $colores[3] = "blue";
                    }else{
                        if($procesos[0]->pond_ngci4 >= 66.8 AND $procesos[0]->pond_ngci4 <= 83.39){
                            $colores[3] = "deepskyblue";
                        }else{
                            if($procesos[0]->pond_ngci4 >= 83.4 AND $procesos[0]->pond_ngci4 <= 100){
                                $colores[3] = "gray";
                            }
                        }
                    }
                }
            }
        }
        if($procesos[0]->pond_ngci5 >= 0 AND $procesos[0]->pond_ngci5 <= 16.79){
            $colores[4] = "red";
        }else{
            if($procesos[0]->pond_ngci5 >= 16.80 AND $procesos[0]->pond_ngci5 <= 33.39){
                $colores[4] = "orange";
            }else{
                if($procesos[0]->pond_ngci5 >= 33.40 AND $procesos[0]->pond_ngci5 <= 50.09){
                    $colores[4] = "green";
                }else{
                    if($procesos[0]->pond_ngci5 >= 50.1 AND $procesos[0]->pond_ngci5 <= 66.79){
                        $colores[4] = "blue";
                    }else{
                        if($procesos[0]->pond_ngci5 >= 66.8 AND $procesos[0]->pond_ngci5 <= 83.39){
                            $colores[4] = "deepskyblue";
                        }else{
                            if($procesos[0]->pond_ngci5 >= 83.4 AND $procesos[0]->pond_ngci5 <= 100){
                                $colores[4] = "gray";
                            }
                        }
                    }
                }
            }
        }

        $apartado1=0;$apartado2=0;$apartado3=0;$apartado4=0;$apartado5=0;
        $valores = m_evaelemcontrolModel::select('NUM_MEEC','PORC_MEEC')->orderBy('NUM_MEEC','ASC')->get();
        foreach($preguntas as $pregunta){
            if($pregunta->cve_ngci == 1){
                foreach($valores as $valor){
                    if($valor->num_meec == $pregunta->num_meec){
                        $apartado1 = $apartado1+(float)($valor->porc_meec);
                        break;
                    }
                }
            }else
                if($pregunta->cve_ngci==2){
                    foreach($valores as $valor){
                        if($valor->num_meec == $pregunta->num_meec){
                            $apartado2 = $apartado2+$valor->porc_meec;
                            break;
                        }
                    }
                }else
                    if($pregunta->cve_ngci==3){
                        foreach($valores as $valor){
                            if($valor->num_meec == $pregunta->num_meec){
                                $apartado3 = $apartado3+$valor->porc_meec;
                                break;
                            }
                        }
                    }else
                        if($pregunta->cve_ngci==4){
                            foreach($valores as $valor){
                                if($valor->num_meec == $pregunta->num_meec){
                                    $apartado4 = $apartado4+$valor->porc_meec;
                                    break;
                                }
                            }
                        }else
                            if($pregunta->cve_ngci==5){
                                foreach($valores as $valor){
                                    if($valor->num_meec == $pregunta->num_meec){
                                        $apartado5 = $apartado5+$valor->porc_meec;
                                        break;
                                    }
                                }
                            }
        }
        //dd($apartado2);
        $matriz = matrizModel::select('ETAPA_GRADO','C_1','C_2','C_3','C_4','C_5','C_6')->orderBy('NUM_REN','ASC')->get();
        return view('sicinar.procesos.detalles.detalles',compact('nombre','usuario','estructura','id_estructura','rango','procesos','unidades','servidores','apartados','preguntas','valores','apartado1','apartado2','apartado3','apartado4','apartado5','colores','matriz'));
    }

    public function actionGestionUnidad(){
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
        return view('sicinar.procesos.GestUnidad',compact('unidades','nombre','usuario','estructura','id_estructura','rango'));
    }

    public function actionInfoUnidad(Request $request){
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

        $unidades = dependenciasModel::Unidades('21500');
        $admon = dependenciasModel::select('DEPEN_DESC')->where('ESTRUCGOB_ID','like','21500%')->where('DEPEN_ID','like',$request->unidad.'%')->get();
        $tipos = tipoprocesoModel::select('CVE_TIPO_PROC','DESC_TIPO_PROC')->orderBy('CVE_TIPO_PROC','ASC')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        $procesos = ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
            ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5','SCI_PONDERACION.TOTAL')
            ->where('SCI_PROCESOS.N_PERIODO','=',date('Y'))
            ->where('SCI_PROCESOS.ESTRUCGOB_ID','like','21500%')
            ->where('SCI_PROCESOS.CVE_DEPENDENCIA','like',$request->unidad.'%')
            ->where('SCI_PROCESOS.STATUS_1','like','E%')
            ->where('SCI_PROCESOS.STATUS_2','like','A%')
            ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
            ->get();
        //dd($procesos);
        $total = $procesos->count();
        //dd($total);
        if($total <= 0){
            toastr()->error('Esta Unidad Administrativa no tiene procesos evaluados.','Unidad Sin Evaluaciones!',['positionClass' => 'toast-bottom-right']);
            return back();
        }
        $apartado1=0;$apartado2=0;$apartado3=0;$apartado4=0;$apartado5=0;$total_pond=0;
        foreach($procesos as $proceso){
            $apartado1 = $apartado1 + $proceso->pond_ngci1;
            $apartado2 = $apartado2 + $proceso->pond_ngci2;
            $apartado3 = $apartado3 + $proceso->pond_ngci3;
            $apartado4 = $apartado4 + $proceso->pond_ngci4;
            $apartado5 = $apartado5 + $proceso->pond_ngci5;
            $total_pond = $total_pond + $proceso->total;
        }
        $apartado1 = $apartado1/$total;
        $apartado2 = $apartado2/$total;
        $apartado3 = $apartado3/$total;
        $apartado4 = $apartado4/$total;
        $apartado5 = $apartado5/$total;
        $total_pond = $total_pond/$total;
        $colores[0] = "red";
        if($apartado1 >= 0 AND $apartado1 <= 16.79){
            $colores[0] = "red";
        }else{
            if($apartado1 >= 16.80 AND $apartado1 <= 33.39){
                $colores[0] = "orange";
            }else{
                if($apartado1 >= 33.40 AND $apartado1 <= 50.09){
                    $colores[0] = "green";
                }else{
                    if($apartado1 >= 50.1 AND $apartado1 <= 66.79){
                        $colores[0] = "blue";
                    }else{
                        if($apartado1 >= 66.8 AND $apartado1 <= 83.39){
                            $colores[0] = "deepskyblue";
                        }else{
                            if($apartado1 >= 83.4 AND $apartado1 <= 100){
                                $colores[0] = "gray";
                            }
                        }
                    }
                }
            }
        }
        if($apartado2 >= 0 AND $apartado2 <= 16.79){
            $colores[1] = "red";
        }else{
            if($apartado2 >= 16.80 AND $apartado2 <= 33.39){
                $colores[1] = "orange";
            }else{
                if($apartado2 >= 33.40 AND $apartado2 <= 50.09){
                    $colores[1] = "green";
                }else{
                    if($apartado2 >= 50.1 AND $apartado2 <= 66.79){
                        $colores[1] = "blue";
                    }else{
                        if($apartado2 >= 66.8 AND $apartado2 <= 83.39){
                            $colores[1] = "deepskyblue";
                        }else{
                            if($apartado2 >= 83.4 AND $apartado2 <= 100){
                                $colores[1] = "gray";
                            }
                        }
                    }
                }
            }
        }
        if($apartado3 >= 0 AND $apartado3 <= 16.79){
            $colores[2] = "red";
        }else{
            if($apartado3 >= 16.80 AND $apartado3 <= 33.39){
                $colores[2] = "orange";
            }else{
                if($apartado3 >= 33.40 AND $apartado3 <= 50.09){
                    $colores[2] = "green";
                }else{
                    if($apartado3 >= 50.1 AND $apartado3 <= 66.79){
                        $colores[2] = "blue";
                    }else{
                        if($apartado3 >= 66.8 AND $apartado3 <= 83.39){
                            $colores[2] = "deepskyblue";
                        }else{
                            if($apartado3 >= 83.4 AND $apartado3 <= 100){
                                $colores[2] = "gray";
                            }
                        }
                    }
                }
            }
        }
        if($apartado4 >= 0 AND $apartado4 <= 16.79){
            $colores[3] = "red";
        }else{
            if($apartado4 >= 16.80 AND $apartado4 <= 33.39){
                $colores[3] = "orange";
            }else{
                if($apartado4 >= 33.40 AND $apartado4 <= 50.09){
                    $colores[3] = "green";
                }else{
                    if($apartado4 >= 50.1 AND $apartado4 <= 66.79){
                        $colores[3] = "blue";
                    }else{
                        if($apartado4 >= 66.8 AND $apartado4 <= 83.39){
                            $colores[3] = "deepskyblue";
                        }else{
                            if($apartado4 >= 83.4 AND $apartado4 <= 100){
                                $colores[3] = "gray";
                            }
                        }
                    }
                }
            }
        }
        if($apartado5 >= 0 AND $apartado5 <= 16.79){
            $colores[4] = "red";
        }else{
            if($apartado5 >= 16.80 AND $apartado5 <= 33.39){
                $colores[4] = "orange";
            }else{
                if($apartado5 >= 33.40 AND $apartado5 <= 50.09){
                    $colores[4] = "green";
                }else{
                    if($apartado5 >= 50.1 AND $apartado5 <= 66.79){
                        $colores[4] = "blue";
                    }else{
                        if($apartado5 >= 66.8 AND $apartado5 <= 83.39){
                            $colores[4] = "deepskyblue";
                        }else{
                            if($apartado5 >= 83.4 AND $apartado5 <= 100){
                                $colores[4] = "gray";
                            }
                        }
                    }
                }
            }
        }
        $matriz = matrizModel::select('ETAPA_GRADO','C_1','C_2','C_3','C_4','C_5','C_6')->orderBy('NUM_REN','ASC')->get();
        //dd($matriz);
        return view('sicinar.procesos.GestUnidadInfo',compact('unidades','nombre','usuario','estructura','id_estructura','rango','procesos','apartado1','apartado2','apartado3','apartado4','apartado5','total_pond','total','colores','apartados','admon','tipos','matriz'));
    }

}
