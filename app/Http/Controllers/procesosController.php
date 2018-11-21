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
    	$nuevo = new procesosModel();
    }

    public function export(){
        return Excel::download(new ExcelExport, 'Procesos_'.date('d-m-Y').'.xlsx');
    }

    public function generarPDF($id){
        $proceso = ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
            ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5','SCI_PONDERACION.TOTAL')
            ->where('SCI_PROCESOS.CVE_PROCESO',$id)
            ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
            ->get();
        $unidades = dependenciasModel::select('DEPEN_DESC')->where('DEPEN_ID','LIKE',$proceso[0]->cve_dependencia.'%')->first();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON','DEPEN_ID')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        $preguntas = ced_evaluacionModel::join('SCI_ECI','SCI_CED_EVALUACION.NUM_ECI','=','SCI_ECI.NUM_ECI')
            ->select('SCI_CED_EVALUACION.ID_SP','SCI_ECI.NUM_ECI','SCI_ECI.PREG_ECI','SCI_CED_EVALUACION.NUM_ECI','SCI_CED_EVALUACION.CVE_NGCI','SCI_CED_EVALUACION.NUM_MEEC','SCI_CED_EVALUACION.FECHA_REG')
            ->where('SCI_CED_EVALUACION.CVE_PROCESO','=',$id)
            ->get();
        $valores = m_evaelemcontrolModel::select('NUM_MEEC','PORC_MEEC')->orderBy('NUM_MEEC','ASC')->get();
        $grados = grado_cumpModel::select('CVE_GRADO_CUMP','DESC_GRADO_CUMP')->get();
        //return view('sicinar.pdf.cedulaEvaluacion',compact('preguntas','apartados','valores','unidades','proceso','servidores','grados'));
        //ini_set("memory_limit", "999M");
        //ini_set("max_execution_time", "999");
        $pdf = PDF::loadView('sicinar.pdf.cedPDF', compact('preguntas','apartados','valores','unidades','proceso','servidores','grados'));
        return $pdf->download('procesos_'.date('d-m-Y').'.pdf');
    }

    public function verPDF($id){
        set_time_limit(0);
        ini_set("memory_limit",-1);
        ini_set('max_execution_time', 0);
        $proceso = ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
                                    ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5','SCI_PONDERACION.TOTAL')
                                    ->where('SCI_PROCESOS.CVE_PROCESO',$id)
                                    ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
                                    ->get();
        $unidades = dependenciasModel::select('DEPEN_DESC')->where('DEPEN_ID','LIKE',$proceso[0]->cve_dependencia.'%')->first();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON','DEPEN_ID')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        $preguntas = ced_evaluacionModel::join('SCI_ECI','SCI_CED_EVALUACION.NUM_ECI','=','SCI_ECI.NUM_ECI')
                                            ->select('SCI_CED_EVALUACION.ID_SP','SCI_ECI.NUM_ECI','SCI_ECI.PREG_ECI','SCI_CED_EVALUACION.NUM_ECI','SCI_CED_EVALUACION.CVE_NGCI','SCI_CED_EVALUACION.NUM_MEEC','SCI_CED_EVALUACION.FECHA_REG')
                                            ->where('SCI_CED_EVALUACION.CVE_PROCESO','=',$id)
                                            ->get();
        $valores = m_evaelemcontrolModel::select('NUM_MEEC','PORC_MEEC')->orderBy('NUM_MEEC','ASC')->get();
        $grados = grado_cumpModel::select('CVE_GRADO_CUMP','DESC_GRADO_CUMP')->get();
        //ini_set("memory_limit", "999M");
        //ini_set("max_execution_time", "999");

        //ini_set('max_execution_time', 300);
        //ini_set("memory_limit","512M");

        //ini_set('max_execution_time', 300);
        $pdf = PDF::loadView('sicinar.pdf.cedPDF', compact('preguntas','apartados','valores','unidades','proceso','servidores','grados'));
        $pdf->setPaper('A4', 'portrait');
        //return $pdf->download('procesos_'.date('d-m-Y').'.pdf');
        return $pdf->stream();
        //font-size: small
        //return view('sicinar.pdf.cedPDF',compact('preguntas','apartados','valores','unidades','proceso','servidores','grados'));
        //return view('sicinar.pdf.cedulaEvaluacion',compact('preguntas','apartados','valores','unidades','proceso','servidores','grados'));
    }

    public function joinin(){
        //$registros;
        $datos = ponderacionModel::join('SCI_PROCESOS','SCI_PONDERACION.CVE_PROCESO','=','SCI_PROCESOS.CVE_PROCESO')
                                ->select('SCI_PROCESOS.ESTRUCGOB_ID','SCI_PROCESOS.CVE_DEPENDENCIA','SCI_PROCESOS.CVE_PROCESO','SCI_PROCESOS.CVE_TIPO_PROC','SCI_PROCESOS.DESC_PROCESO','SCI_PROCESOS.RESPONSABLE','SCI_PONDERACION.POND_NGCI1','SCI_PONDERACION.POND_NGCI2','SCI_PONDERACION.POND_NGCI3','SCI_PONDERACION.POND_NGCI4','SCI_PONDERACION.POND_NGCI5')
                                ->orderBy('SCI_PROCESOS.CVE_PROCESO','ASC')
                                ->get();
        //dd($datos[0]);
        $estructuras = estructurasModel::Estructuras();
        //dd($estructuras);
        $total = $datos->count();
        for($i=0;$i<$total;$i++){
            foreach($estructuras as $estructura){
                if(strpos($estructura->estrucgob_id,$datos[$i]->estrucgob_id) !== false){
                    $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')->where('ESTRUCGOB_ID','like',$datos[$i]->estrucgob_id.'%')->where('CLASIFICGOB_ID',1)->get();
                    foreach($dependencias as $dependencia){
                        if(strpos($dependencia->depen_id, $datos[$i]->estrucgob_id) !== false){
                            $registros[$i] = [
                                'ESTRUCGOB_ID' => $estructura->estrucgob_desc,
                                'CVE_DEPENDENCIA' => $dependencia->depen_desc
                            ];
                            break;
                        }
                    }
                    //dd($estructura->estrucgob_id.' contenedor de  '.$datos[$i]->estrucgob_id);
                }
            }
        }
        dd($registros);
        foreach($datos as $dato){
            foreach($estructuras as $estructura){
                if(strpos($estructura->estrucgob_id,$dato->estrucgob_id) !== false){
                    dd($estructura->estrucgob_id.' contiene a '.$dato->estrucgob_id);
                }
            }
        }
        dd($estructuras);
    }
}
