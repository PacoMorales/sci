<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\cuestionarioRequest;

use App\usuarioModel;
use App\estructurasModel;
use App\critseccModel;
use App\tipoprocesoModel;
use App\dependenciasModel;
use App\procesosModel;
use App\eciModel;
use App\criteriosModel;
use App\ngciModel;
use App\evidenciasModel;
use App\ced_evaluacionModel;
use App\grado_cumpModel;
use App\servidorespubModel;

class cuestionarioController extends Controller
{
    public function actionCuestionario(){
    	$nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $rango = session()->get('rango');
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
        $dependencia = session()->get('nombre_dependencia');
        $id_dependencia = session()->get('dependencia');
        $proc=1;//dd($id_estructura);
        $estructuras = estructurasModel::Estructuras();
        $preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        //$grados = grado_cumpModel::select('CVE_GRADO_CUMP','DESC_GRADO_CUMP')->orderBy('CVE_GRADO_CUMP','ASC')->get();
        $grados = grado_cumpModel::join('SCI_M_EVAELEMCONTROL','SCI_GRADO_CUMP.CVE_GRADO_CUMP','=','SCI_M_EVAELEMCONTROL.CVE_GRADO_CUMP')
                                ->select('SCI_GRADO_CUMP.CVE_GRADO_CUMP','SCI_GRADO_CUMP.DESC_GRADO_CUMP','SCI_M_EVAELEMCONTROL.PORC_MEEC')
                                ->orderBy('SCI_GRADO_CUMP.CVE_GRADO_CUMP','ASC')
                                ->get();
        //dd($grados->all());
        $procesos = procesosModel::select('CVE_PROCESO','CVE_DEPENDENCIA','DESC_PROCESO','CVE_TIPO_PROC')->where('ESTRUCGOB_ID','like',$id_estructura.'%')->where('CVE_DEPENDENCIA','like',$id_dependencia.'%')->where('STATUS_1','like','N%')->get();
        $unidades = dependenciasModel::Unidades($id_estructura);
        $servidores = servidorespubModel::select('ID_SP','NOMBRE_COMPLETO','UNID_ADMON')->orderBy('UNID_ADMON','ASC')->orderBy('NOMBRE_COMPLETO','ASC')->get();
        //dd($servidores->all());
        //dd($unidades->all());
        if($procesos->count() == 0){
        	$proc = 0;
        }/*else{
        	dd($procesos);
        }*/
        return view('sicinar.cuestionario.cuestionario',compact('usuario','nombre','estructura','rango','estructuras','preguntas','grados','apartados','procesos','proc','unidades','id_estructura','dependencia','servidores'));
    }

    public function actionAltaCuestionario(cuestionarioRequest $request){
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
        $dependencia = session()->get('nombre_dependencia');
        $id_depen = session()->get('dependencia');
        $id_dependencia = rtrim($id_depen," ");
        $max = ced_evaluacionModel::max('num_eval');
        $max = $max+1;
        $per_aux = date('Y');
        $mes_aux = date('m');
        $hoy = date('Y/m/d');
        for($i=1;$i<=33;$i++){
	        $nuevo = new ced_evaluacionModel();
	        	$nuevo->N_PERIODO = $per_aux; 
	        	$nuevo->ESTRUCGOB_ID = $id_estructura;
	        	$nuevo->CVE_DEPENDENCIA = $id_dependencia;
	        	$nuevo->CVE_PROCESO = $request->proceso;
	        	$nuevo->NUM_EVAL = $max;
	        	$nuevo->MES = $mes_aux;
	        	$nuevo->NUM_ECI = $i;  //NUMERO DE PREGUNTA
	        	 //NUMERO DE APARTADO
	        	if($i>=1 AND $i<=8 ){$nuevo->CVE_NGCI = 1;}else
	        	if($i>=9 AND $i<=12 ){$nuevo->CVE_NGCI = 2;}else
	        	if($i>=13 AND $i<=24 ){$nuevo->CVE_NGCI = 3;}else
	        	if($i>=25 AND $i<=30 ){$nuevo->CVE_NGCI = 4;}else
	        	if($i>=31 AND $i<=33 ){$nuevo->CVE_NGCI = 5;}else{$nuevo->NUM_NGCI = 0;}
	        	  //VALOR DEL PROCENTAJE
	        	if($i == 1){$nuevo->NUM_MEEC=$request->evaluacion1;}else if($i == 2){$nuevo->NUM_MEEC=$request->evaluacion2;}else if($i == 3){$nuevo->NUM_MEEC=$request->evaluacion3;} else
	        	if($i == 4){$nuevo->NUM_MEEC=$request->evaluacion4;}else if($i == 5){$nuevo->NUM_MEEC=$request->evaluacion5;}else if($i == 6){$nuevo->NUM_MEEC=$request->evaluacion6;} else
	        	if($i == 7){$nuevo->NUM_MEEC=$request->evaluacion7;}else if($i == 8){$nuevo->NUM_MEEC=$request->evaluacion8;}else if($i == 9){$nuevo->NUM_MEEC=$request->evaluacion9;} else
	        	if($i == 10){$nuevo->NUM_MEEC=$request->evaluacion10;}else if($i == 11){$nuevo->NUM_MEEC=$request->evaluacion11;}else if($i == 12){$nuevo->NUM_MEEC=$request->evaluacion12;} else
	        	if($i == 13){$nuevo->NUM_MEEC=$request->evaluacion13;}else if($i == 14){$nuevo->NUM_MEEC=$request->evaluacion14;}else if($i == 15){$nuevo->NUM_MEEC=$request->evaluacion15;} else
	        	if($i == 16){$nuevo->NUM_MEEC=$request->evaluacion16;}else if($i == 17){$nuevo->NUM_MEEC=$request->evaluacion17;}else if($i == 18){$nuevo->NUM_MEEC=$request->evaluacion18;} else
	        	if($i == 19){$nuevo->NUM_MEEC=$request->evaluacion19;}else if($i == 20){$nuevo->NUM_MEEC=$request->evaluacion20;}else if($i == 21){$nuevo->NUM_MEEC=$request->evaluacion21;} else
	        	if($i == 22){$nuevo->NUM_MEEC=$request->evaluacion22;}else if($i == 23){$nuevo->NUM_MEEC=$request->evaluacion23;}else if($i == 24){$nuevo->NUM_MEEC=$request->evaluacion24;} else
	        	if($i == 25){$nuevo->NUM_MEEC=$request->evaluacion25;}else if($i == 26){$nuevo->NUM_MEEC=$request->evaluacion26;}else if($i == 27){$nuevo->NUM_MEEC=$request->evaluacion27;} else
	        	if($i == 28){$nuevo->NUM_MEEC=$request->evaluacion28;}else if($i == 29){$nuevo->NUM_MEEC=$request->evaluacion29;}else if($i == 30){$nuevo->NUM_MEEC=$request->evaluacion30;} else
	        	if($i == 31){$nuevo->NUM_MEEC=$request->evaluacion31;}else if($i == 32){$nuevo->NUM_MEEC=$request->evaluacion32;}else if($i == 33){$nuevo->NUM_MEEC=$request->evaluacion33;}
	        	$nuevo->RESPONSABLE = strtoupper($request->titular);
	        	$nuevo->OBJ_EVAL = strtoupper($request->objetivo);
	        	  //VALOR DEL SERVIDOR PUBLICO
                if($i == 1){$nuevo->ID_SP=$request->responsable1;}else if($i == 2){$nuevo->ID_SP=$request->responsable2;}else if($i == 3){$nuevo->ID_SP=$request->responsable3;} else
                if($i == 4){$nuevo->ID_SP=$request->responsable4;}else if($i == 5){$nuevo->ID_SP=$request->responsable5;}else if($i == 6){$nuevo->ID_SP=$request->responsable6;} else
                if($i == 7){$nuevo->ID_SP=$request->responsable7;}else if($i == 8){$nuevo->ID_SP=$request->responsable8;}else if($i == 9){$nuevo->ID_SP=$request->responsable9;} else
                if($i == 10){$nuevo->ID_SP=$request->responsable10;}else if($i == 11){$nuevo->ID_SP=$request->responsable11;}else if($i == 12){$nuevo->ID_SP=$request->responsable12;} else
                if($i == 13){$nuevo->ID_SP=$request->responsable13;}else if($i == 14){$nuevo->ID_SP=$request->responsable14;}else if($i == 15){$nuevo->ID_SP=$request->responsable15;} else
                if($i == 16){$nuevo->ID_SP=$request->responsable16;}else if($i == 17){$nuevo->ID_SP=$request->responsable17;}else if($i == 18){$nuevo->ID_SP=$request->responsable18;} else
                if($i == 19){$nuevo->ID_SP=$request->responsable19;}else if($i == 20){$nuevo->ID_SP=$request->responsable20;}else if($i == 21){$nuevo->ID_SP=$request->responsable21;} else
                if($i == 22){$nuevo->ID_SP=$request->responsable22;}else if($i == 23){$nuevo->ID_SP=$request->responsable23;}else if($i == 24){$nuevo->ID_SP=$request->responsable24;} else
                if($i == 25){$nuevo->ID_SP=$request->responsable25;}else if($i == 26){$nuevo->ID_SP=$request->responsable26;}else if($i == 27){$nuevo->ID_SP=$request->responsable27;} else
                if($i == 28){$nuevo->ID_SP=$request->responsable28;}else if($i == 29){$nuevo->ID_SP=$request->responsable29;}else if($i == 30){$nuevo->ID_SP=$request->responsable30;} else
                if($i == 31){$nuevo->ID_SP=$request->responsable31;}else if($i == 32){$nuevo->ID_SP=$request->responsable32;}else if($i == 33){$nuevo->ID_SP=$request->responsable33;}
	        	$nuevo->USU = $nombre;
	        	$nuevo->PW = $pass;
	        	$nuevo->IP = $ip;
	        	$nuevo->FECHA_REG = $hoy;
	        	$nuevo->USU_M = $nombre;
	        	$nuevo->PW_M = $pass;
	        	$nuevo->IP_M = $ip;
	        	$nuevo->FECHA_M = $hoy;
	        if($nuevo->save() == false){
	        	$estructuras = estructurasModel::Estructuras();
        		$preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        		$apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        		//$grados = grado_cumpModel::select('CVE_GRADO_CUMP','DESC_GRADO_CUMP')->orderBy('CVE_GRADO_CUMP','ASC')->get();
                $grados = grado_cumpModel::join('SCI_M_EVAELEMCONTROL','SCI_GRADO_CUMP.CVE_GRADO_CUMP','=','SCI_M_EVAELEMCONTROL.CVE_GRADO_CUMP')
                                ->select('SCI_GRADO_CUMP.CVE_GRADO_CUMP','SCI_GRADO_CUMP.DESC_GRADO_CUMP','SCI_M_EVAELEMCONTROL.PORC_MEEC')
                                ->orderBy('SCI_GRADO_CUMP.CVE_GRADO_CUMP','ASC')
                                ->get();
                $servidores = servidorespubModel::select('ID_SP','NOMBRE_COMPLETO','UNID_ADMON')->orderBy('UNID_ADMON','ASC')->orderBy('NOMBRE_COMPLETO','ASC')->get();
                toastr()->error('Ha ocurrido algo inesperado al almacenar la pregunta '.$i.'.','Ocurrio algo inesperado!',['positionClass' => 'toast-bottom-right']);
        		return view('sicinar.cuestionario.cuestionario',compact('usuario','nombre','estructura','rango','estructuras','preguntas','grados','apartados','id_estructura','dependencia','servidores'));
	        }
	    }
	    //id del proceso
	    session()->put('idproc',$request->proceso);
        //ACTUALIZAR PROCESO
        $process = procesosModel::where('CVE_PROCESO',$request->proceso)->update(['RESPONSABLE'=>strtoupper($request->titular),'STATUS_1'=>'V']);
        return view('sicinar.cuestionario.confirmacion',compact('usuario','nombre','estructura','max','rango'));
    }

    /*public function Val(){
    	$nombre = session()->get('userlog');
    	$pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $rango = session()->get('rango');
        return view('sicinar.cuestionario.confirmacion',compact('usuario','nombre','estructura','rango'));
    }*/

    public function actionConfirmado(){
    	$id_proceso = session()->get('idproc');
    	$nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $rango = session()->get('rango');
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
        $dependencia = session()->get('nombre_dependencia');
        $id_dependencia = session()->get('dependencia');
        $proc=1;
    	$estructuras = estructurasModel::Estructuras();
        $preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        //$grados = grado_cumpModel::select('CVE_GRADO_CUMP','DESC_GRADO_CUMP')->orderBy('CVE_GRADO_CUMP','ASC')->get();
        $grados = grado_cumpModel::join('SCI_M_EVAELEMCONTROL','SCI_GRADO_CUMP.CVE_GRADO_CUMP','=','SCI_M_EVAELEMCONTROL.CVE_GRADO_CUMP')
                                ->select('SCI_GRADO_CUMP.CVE_GRADO_CUMP','SCI_GRADO_CUMP.DESC_GRADO_CUMP','SCI_M_EVAELEMCONTROL.PORC_MEEC')
                                ->orderBy('SCI_GRADO_CUMP.CVE_GRADO_CUMP','ASC')
                                ->get();
        $unidades = dependenciasModel::Unidades($id_estructura);
    	$procesos = procesosModel::select('CVE_PROCESO','CVE_DEPENDENCIA','DESC_PROCESO','CVE_TIPO_PROC')->where('ESTRUCGOB_ID','like',$id_estructura.'%')->where('STATUS_1','like','N%')->get();
        if($procesos->count() == 0){
        	$proc = 0;
        }
        $servidores = servidorespubModel::select('ID_SP','NOMBRE_COMPLETO','UNID_ADMON')->orderBy('UNID_ADMON','ASC')->orderBy('NOMBRE_COMPLETO','ASC')->get();
        //dd($id_proceso);
        $process = procesosModel::where('CVE_PROCESO',$id_proceso)->update(['STATUS_1'=>'E']);
        //dd($process->all());
        session()->forget('idproc');
        toastr()->success('La evaluación se ha almacenado.','Bien!',['positionClass' => 'toast-bottom-right']);
        return view('sicinar.cuestionario.cuestionario',compact('usuario','nombre','estructura','rango','estructuras','preguntas','grados','apartados','unidades','procesos','proc','id_estructura','dependencia','servidores'));
    }

    public function actionVerificar($id){
    	$nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $rango = session()->get('rango');
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
        $dependencia = session()->get('nombre_dependencia');
        $id_dependencia = session()->get('dependencia');
        $proc=1;
    	$estructuras = estructurasModel::Estructuras();
        $preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        //$grados = grado_cumpModel::select('CVE_GRADO_CUMP','DESC_GRADO_CUMP')->orderBy('CVE_GRADO_CUMP','ASC')->get();
        $grados = grado_cumpModel::join('SCI_M_EVAELEMCONTROL','SCI_GRADO_CUMP.CVE_GRADO_CUMP','=','SCI_M_EVAELEMCONTROL.CVE_GRADO_CUMP')
                                ->select('SCI_GRADO_CUMP.CVE_GRADO_CUMP','SCI_GRADO_CUMP.DESC_GRADO_CUMP','SCI_M_EVAELEMCONTROL.PORC_MEEC')
                                ->orderBy('SCI_GRADO_CUMP.CVE_GRADO_CUMP','ASC')
                                ->get();
    	$cuestionario = ced_evaluacionModel::where('NUM_EVAL',$id)->get();
    	$unidades = dependenciasModel::Unidades($id_estructura);
    	$procesos = procesosModel::select('CVE_PROCESO','CVE_DEPENDENCIA','DESC_PROCESO','CVE_TIPO_PROC')->where('ESTRUCGOB_ID','like',$id_estructura.'%')->where('STATUS_1','like','%V%')->get();
        if($procesos->count() == 0){
        	$proc = 0;
        }
    	$num_eval_aux = $id;
        $servidores = servidorespubModel::select('ID_SP','NOMBRE_COMPLETO','UNID_ADMON')->orderBy('UNID_ADMON','ASC')->orderBy('NOMBRE_COMPLETO','ASC')->get();
    	return view('sicinar.cuestionario.validacion',compact('usuario','nombre','estructura','rango','estructuras','preguntas','grados','apartados','cuestionario','num_eval_aux','unidades','procesos','proc','id_estructura','dependencia','servidores'));
    }

    public function actionVerificando(cuestionarioRequest $request, $id){
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
        $ip = session()->get('ip');
        $rango = session()->get('rango');
        $dependencia = session()->get('nombre_dependencia');
        $id_dependencia = session()->get('dependencia');
        $cuestionario = ced_evaluacionModel::where('NUM_EVAL',$id)->orderBy('NUM_ECI','ASC')->get();
        $total = $cuestionario->count();
        $max = $id;
        $per_aux = date('Y');
        $mes_aux = date('m');
        $hoy = date('Y/m/d');
        $evaluaciones = [$request->evaluacion1,$request->evaluacion2,$request->evaluacion3,$request->evaluacion4,
        					$request->evaluacion5,$request->evaluacion6,$request->evaluacion7,$request->evaluacion8,
        					$request->evaluacion9,$request->evaluacion10,$request->evaluacion11,$request->evaluacion12,
        					$request->evaluacion13,$request->evaluacion14,$request->evaluacion15,$request->evaluacion16,
        					$request->evaluacion17,$request->evaluacion18,$request->evaluacion19,$request->evaluacion20,
        					$request->evaluacion21,$request->evaluacion22,$request->evaluacion23,$request->evaluacion24,
        					$request->evaluacion25,$request->evaluacion26,$request->evaluacion27,$request->evaluacion28,
        					$request->evaluacion29,$request->evaluacion30,$request->evaluacion31,$request->evaluacion32,$request->evaluacion33];
        $responsables = [$request->responsable1,$request->responsable2,$request->responsable3,$request->responsable4,
                            $request->responsable5,$request->responsable6,$request->responsable7,$request->responsable8,
                            $request->responsable9,$request->responsable10,$request->responsable11,$request->responsable12,
                            $request->responsable13,$request->responsable14,$request->responsable15,$request->responsable16,
                            $request->responsable17,$request->responsable18,$request->responsable19,$request->responsable20,
                            $request->responsable21,$request->responsable22,$request->responsable23,$request->responsable24,
                            $request->responsable25,$request->responsable26,$request->responsable27,$request->responsable28,
                            $request->responsable29,$request->responsable30,$request->responsable31,$request->responsable32,$request->responsable33];
        for($i=1;$i<=$total;$i++){
	        $cuestionario = ced_evaluacionModel::where('NUM_EVAL',$id)
	        									->where('NUM_ECI',$i)
	        									->update([
	        										'MES'=>$mes_aux,
	        										'NUM_MEEC'=>$evaluaciones[($i-1)],
                                                    'ID_SP'=>$responsables[($i-1)],
	        										'RESPONSABLE'=>strtoupper($request->titular),
	        										'USU_M'=>$nombre,
	        										'PW_M'=>$pass,
	        										'IP_M'=>$ip,
	        										'FECHA_M'=>$hoy,
	        										]);
        }
        //return view('sicinar.cuestionario.confirmacion',compact('usuario','nombre','estructura','max','rango'));
        $proc=1;
        $id_estruc = session()->get('id_estructura');
        $id_estructura = rtrim($id_estruc," ");
    	$estructuras = estructurasModel::Estructuras();
        $preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        //$grados = grado_cumpModel::select('CVE_GRADO_CUMP','DESC_GRADO_CUMP')->orderBy('CVE_GRADO_CUMP','ASC')->get();
        $grados = grado_cumpModel::join('SCI_M_EVAELEMCONTROL','SCI_GRADO_CUMP.CVE_GRADO_CUMP','=','SCI_M_EVAELEMCONTROL.CVE_GRADO_CUMP')
                                ->select('SCI_GRADO_CUMP.CVE_GRADO_CUMP','SCI_GRADO_CUMP.DESC_GRADO_CUMP','SCI_M_EVAELEMCONTROL.PORC_MEEC')
                                ->orderBy('SCI_GRADO_CUMP.CVE_GRADO_CUMP','ASC')
                                ->get();
    	$cuestionario = ced_evaluacionModel::where('NUM_EVAL',$id)->get();
    	$unidades = dependenciasModel::Unidades($id_estructura);
    	$procesos = procesosModel::select('CVE_PROCESO','CVE_DEPENDENCIA','DESC_PROCESO','CVE_TIPO_PROC')->where('ESTRUCGOB_ID','like',$id_estructura.'%')->where('STATUS_1','like','%N%')->get();
        if($procesos->count() == 0){
        	$proc = 0;
        }
        $process = procesosModel::where('CVE_PROCESO',$request->proceso)->update(['CVE_DEPENDENCIA'=>$request->unidad,'RESPONSABLE'=>strtoupper($request->titular),'STATUS_1'=>'E']);
        $servidores = servidorespubModel::select('ID_SP','NOMBRE_COMPLETO','UNID_ADMON')->orderBy('UNID_ADMON','ASC')->orderBy('NOMBRE_COMPLETO','ASC')->get();
        toastr()->success('La evaluación se ha almacenado.','Bien!',['positionClass' => 'toast-bottom-right']);
        return view('sicinar.cuestionario.cuestionario',compact('usuario','nombre','estructura','rango','estructuras','preguntas','grados','apartados','unidades','procesos','proc','id_estructura','dependencia','servidores'));
    }

    public function actionListaEvidencias(){
    	$nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        $rango = session()->get('rango');
        $evidencias = evidenciasModel::orderBy('CVE_EVIDENCIA','ASC')->get();
        return view('sicinar.evidencias.listaEvidencias',compact('usuario','nombre','estructura','evidencias','rango'));
    }
}
