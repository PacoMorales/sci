<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\accionRequest;
use App\Rules\Letras;

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
        if($plan->count() > 0){
            toastr()->error('El Plan de Trabajo para esta Unidad Administrativa ya ha sido creado.','Plan de Trabajo Duplicado!',['positionClass' => 'toast-bottom-right']);
            return back();
        }
        $id_plan = progtrabModel::max('NUM_EVAL');
        $id_plan = $id_plan+1;
        /* ALTA DE ACCIONES DE MEJORA ******************************************************************************/
        for($i=1;$i<=33;$i++){
            $nuevaAccion = new accionesmejoraModel();
            $nuevaAccion->N_PERIODO = date('Y');
            $nuevaAccion->ESTRUCGOB_ID = $request->estructura;
            $nuevaAccion->CVE_DEPENDENCIA = $request->unidad;
            $nuevaAccion->NUM_EVAL = $id_plan;
            $nuevaAccion->MES = date('m');
            $nuevaAccion->NUM_ECI = $i;
            if($i >= 1 AND $i <= 8){
                $nuevaAccion->CVE_NGCI = 1;
            }else{
                if($i >= 9 AND $i <= 12){
                    $nuevaAccion->CVE_NGCI = 2;
                }else{
                    if($i >= 13 AND $i <= 24){
                        $nuevaAccion->CVE_NGCI = 3;
                    }else{
                        if($i >= 25 AND $i <= 30){
                            $nuevaAccion->CVE_NGCI = 4;
                        }else{
                            $nuevaAccion->CVE_NGCI = 5;
                        }
                    }
                }
            }
            $nuevaAccion->NUM_MEEC = 1;
            $nuevaAccion->NUM_MEEC_2 = 1;
            $nuevaAccion->PROCESOS = 'SIN PROCESO';
            $nuevaAccion->NO_ACC_MEJORA = 0;
            $nuevaAccion->DESC_ACC_MEJORA = 'SIN ACCION DE MEJORA';
            $nuevaAccion->FECHA_INI = date('Y/m/d');
            $nuevaAccion->FECHA_TER = date('Y/m/d');
            $nuevaAccion->NO_ACC_MEJORA = 0;
            $nuevaAccion->NO_ACC_MEJORA = 0;
            $nuevaAccion->STATUS_1 = 'S'; //S ACTIVO B INACTIVO
            $nuevaAccion->STATUS_2 = '0'; //0 PENDIENTE 1 CONCLUIDO
            $nuevaAccion->STATUS_3 = '0'; //0 SIN ACCION 1 CON ACCION
            $nuevaAccion->ID_SP = 999999999;
            $nuevaAccion->MEDIOS_VERIFICACION = 'SIN ESPECIFICAR';
            $nuevaAccion->FECHA_REG = date('Y/m/d');
            $nuevaAccion->USU = $usuario;
            $nuevaAccion->IP = $ip;
            $nuevaAccion->FECHA_M = date('Y/m/d');
            $nuevaAccion->USU_M = $usuario;
            $nuevaAccion->IP_M = $ip;
            $nuevaAccion->save();
        }
        /* ALTA DEL PLAN ******************************************************************************/
        $nuevoPlan = new progtrabModel();
        $nuevoPlan->N_PERIODO = date('Y');
        $nuevoPlan->ESTRUCGOB_ID = $request->estructura;
        $nuevoPlan->CVE_DEPENDENCIA = $request->unidad;
        $nuevoPlan->TITULAR = strtoupper($request->titular);
        $nuevoPlan->NUM_EVAL = $id_plan;
        $nuevoPlan->MES = date('m');
        $nuevoPlan->STATUS_1 = 'S'; //S ACTIVO N BAJA
        $nuevoPlan->STATUS_2 = '2'; //2 PENDIENTE 1 CONCLUIDO
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
            //return back();
            return redirect()->route('nuevoPlan');
        }
    }

    public function actionActivarPlan($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $plan = progtrabModel::where('NUM_EVAL',$id)->update(['STATUS_1'=>'S']);
        toastr()->info('El Plan de Trabajo ha sido activado.','Plan de Trabajo activado!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verPlan');
    }

    public function actionDesactivarPlan($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $plan = progtrabModel::where('NUM_EVAL',$id)->update(['STATUS_1'=>'N']);
        toastr()->warning('El Plan de Trabajo ha sido desactivado.','Plan de Trabajo desactivado!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verPlan');
    }

    public function actionPlanPendiente($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $plan = progtrabModel::where('NUM_EVAL',$id)->update(['STATUS_2'=>'2']);
        toastr()->warning('El Plan de Trabajo ha sido marcado como pendiente.','Plan de Trabajo pendiente!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verPlan');
    }

    public function actionPlanConcluido($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $plan = progtrabModel::where('NUM_EVAL',$id)->update(['STATUS_2'=>'1']);
        toastr()->success('El Plan de Trabajo ha sido marcado como concluido.','Plan de Trabajo concluido!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verPlan');
    }

    public function actionVerPlan(){
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
            //->where('STATUS_1','LIKE','S%')
            ->orderBy('NUM_EVAL','ASC')
            ->paginate(10);
        if($planes->count() <= 0){
            toastr()->error('No existe ningún Plan de Trabajo dado de alta.','Lo siento!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un Plan de Trabajo.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoPlan');
        }
        $unidades = dependenciasModel::Unidades('21500');
        return view('sicinar.plandetrabajo.verPlan',compact('nombre','usuario','estructura','rango','id_estructura','planes','unidades'));

    }

    public function actionEditarPlan($id){
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
        $plan = progtrabModel::select('CVE_DEPENDENCIA','NUM_EVAL','TITULAR','STATUS_1','STATUS_2')
            ->where('N_PERIODO',date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('NUM_EVAL',$id)
            ->orderBy('NUM_EVAL','ASC')
            ->first();
        if($plan->count() <= 0){
            toastr()->error('No existe ningún Plan de Trabajo dado de alta.','Lo siento!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un Plan de Trabajo.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoPlan');
        }
        $unidad = dependenciasModel::select('DEPEN_DESC')->where('DEPEN_ID','like',$plan->cve_dependencia.'%')->first();
        $preguntas = eciModel::orderBy('NUM_ECI','asc')->get();
        $apartados = ngciModel::select('CVE_NGCI','DESC_NGCI')->orderBy('CVE_NGCI','ASC')->get();
        $acciones = accionesmejoraModel::select('NUM_EVAL','STATUS_3')
            ->where('N_PERIODO',date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_DEPENDENCIA','LIKE',$plan->cve_dependencia.'%')
            ->where('NUM_EVAL',$id)
            ->orderBy('NUM_ECI','ASC')
            ->get();
        //dd($acciones->all());
        session()->forget('plan_id');
        session(['plan_id' => $plan->num_eval]);
        return view('sicinar.plandetrabajo.editarPlan',compact('nombre','usuario','estructura','rango','id_estructura','plan','unidad','preguntas','apartados','grados','acciones'));

    }

    public function actionEditarAccion($id){
        $num_eval = session()->get('plan_id');
        //EL id ES EL NUMERO DE PREGUNTA (1-33)
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
        $plan = progtrabModel::select('CVE_DEPENDENCIA','NUM_EVAL','TITULAR','STATUS_1','STATUS_2')
            ->where('N_PERIODO',date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('NUM_EVAL',$num_eval)
            ->first();
        $pregunta = eciModel::join('SCI_NGCI','SCI_ECI.CVE_NGCI','=','SCI_NGCI.CVE_NGCI')
            ->select('SCI_NGCI.CVE_NGCI','SCI_NGCI.DESC_NGCI','SCI_ECI.NUM_ECI','SCI_ECI.PREG_ECI')
            ->where('SCI_ECI.NUM_ECI',$id)
            ->get();
        $procesos = procesosModel::select('CVE_PROCESO','DESC_PROCESO','STATUS_1','STATUS_2')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_DEPENDENCIA','LIKE',$plan->cve_dependencia.'%')
            ->where('STATUS_1','LIKE','E%')
            ->where('STATUS_2','LIKE','A%')
            ->orderBy('CVE_PROCESO','ASC')
            ->get();
        $accion = accionesmejoraModel::where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_DEPENDENCIA','LIKE',$plan->cve_dependencia.'%')
            ->where('NUM_EVAL',$num_eval)
            ->where('NUM_ECI',$id)
            ->first();
        $grados = grado_cumpModel::join('SCI_M_EVAELEMCONTROL','SCI_GRADO_CUMP.CVE_GRADO_CUMP','=','SCI_M_EVAELEMCONTROL.CVE_GRADO_CUMP')
            ->select('SCI_GRADO_CUMP.CVE_GRADO_CUMP','SCI_GRADO_CUMP.DESC_GRADO_CUMP','SCI_M_EVAELEMCONTROL.PORC_MEEC')
            ->orderBy('SCI_GRADO_CUMP.CVE_GRADO_CUMP','ASC')
            ->get();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON')
            ->orderBy('UNID_ADMON','ASC')
            ->orderBy('NOMBRES','ASC')
            ->get();
        //dd($grados);
        //dd($procesos->all());
        return view('sicinar.plandetrabajo.nuevaAccion',compact('nombre','usuario','estructura','rango','id_estructura','plan','pregunta','procesos','accion','grados','servidores'));

    }

    public function actionAltaAccion(accionRequest $request, $id){
        //dd($request->all());
        $num_eval = session()->get('plan_id');
        //EL id ES EL NUMERO DE PREGUNTA (1-33)
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

        /*$request->validate([
            'accion' =>new Letras()
        ]);*/

        $fecha_esp  = str_replace("/", "", $request->fecha_ini);
        $dia        = substr($fecha_esp, 0, 2);
        $mes        = substr($fecha_esp, 2, 2);
        $anio       = substr($fecha_esp, 4, 4);
        $fecha_ok   = $anio."/".$mes."/".$dia;
        $fecha_esp2  = str_replace("/", "", $request->fecha_fin);
        $dia2        = substr($fecha_esp2, 0, 2);
        $mes2        = substr($fecha_esp2, 2, 2);
        $anio2       = substr($fecha_esp2, 4, 4);
        $fecha_ok2   = $anio2."/".$mes2."/".$dia2;
        $plan = progtrabModel::select('CVE_DEPENDENCIA')
            ->where('N_PERIODO',date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('NUM_EVAL',$num_eval)
            ->first();
        $pregunta = eciModel::join('SCI_NGCI','SCI_ECI.CVE_NGCI','=','SCI_NGCI.CVE_NGCI')
            ->select('SCI_NGCI.CVE_NGCI')
            ->where('SCI_ECI.NUM_ECI',$id)
            ->first();
        //dd($pregunta);
        $actAccion = accionesmejoraModel::where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_DEPENDENCIA','LIKE',$plan->cve_dependencia.'%')
            ->where('NUM_EVAL',$num_eval)
            ->where('NUM_ECI',$id)
            ->update([
                'CVE_NGCI' => $pregunta->cve_ngci,
                'NUM_MEEC' => $request->cumplimiento1,
                'NUM_MEEC_2' => $request->cumplimiento2,
                'PROCESOS' => $request->procesos,
                'NO_ACC_MEJORA' => $request->no,
                'DESC_ACC_MEJORA' => $request->accion,
                'FECHA_INI' => $fecha_ok,
                'FECHA_TER' => $fecha_ok2,
                'ID_SP' => $request->responsable,
                'MEDIOS_VERIFICACION' => $request->medios,
                'STATUS_1' => 'A',
                'STATUS_2' => '0',
                'STATUS_3' => '1',
                'FECHA_M' => date('Y/m/d'),
                'USU_M' => $usuario,
                'IP_M' => $ip
            ]);
        toastr()->success('Acción de Mejora dada de alta.','Correcto!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('editarPlan',$num_eval);
            //->get();
        //dd($actAccion->all());
    }

    public function actionVerPDF($id){
        //dd($id);
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
        $plan = $plan = progtrabModel::select('CVE_DEPENDENCIA','TITULAR')
            ->where('N_PERIODO',date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('NUM_EVAL',$id)
            ->orderBy('NUM_EVAL','ASC')
            ->first();
        $dependencia_aux = dependenciasModel::select('DEPEN_DESC')
            ->where('DEPEN_ID','LIKE',$plan->cve_dependencia.'%')
            ->first();
        //dd($dependencia_aux);
        $acciones1 = accionesmejoraModel::join('SCI_ECI','SCI_ECI.NUM_ECI','=','SCI_ACCIONES_MEJORA.NUM_ECI')
            ->join('SCI_NGCI','SCI_NGCI.CVE_NGCI','=','SCI_ACCIONES_MEJORA.CVE_NGCI')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            //->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.VALOR_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC_2')
            ->join('SCI_SERVIDORESPUB','SCI_SERVIDORESPUB.ID_SP','=','SCI_ACCIONES_MEJORA.ID_SP')
            ->select('SCI_NGCI.CVE_NGCI','SCI_NGCI.DESC_NGCI','SCI_ACCIONES_MEJORA.NUM_ECI','SCI_ECI.PREG_ECI','SCI_M_EVAELEMCONTROL.PORC_MEEC','SCI_ACCIONES_MEJORA.NUM_MEEC_2','SCI_ACCIONES_MEJORA.PROCESOS','SCI_ACCIONES_MEJORA.NO_ACC_MEJORA','SCI_ACCIONES_MEJORA.DESC_ACC_MEJORA','SCI_ACCIONES_MEJORA.FECHA_INI','SCI_ACCIONES_MEJORA.FECHA_TER','SCI_SERVIDORESPUB.UNID_ADMON','SCI_SERVIDORESPUB.NOMBRES','SCI_SERVIDORESPUB.PATERNO','SCI_SERVIDORESPUB.MATERNO','SCI_ACCIONES_MEJORA.MEDIOS_VERIFICACION')
            ->where('SCI_ACCIONES_MEJORA.N_PERIODO',date('Y'))
            ->where('SCI_ACCIONES_MEJORA.ESTRUCGOB_ID','LIKE','21500%')
            ->where('SCI_ACCIONES_MEJORA.CVE_NGCI','=',1)
            ->where('SCI_ACCIONES_MEJORA.NUM_EVAL',$id)
            ->orderBy('SCI_ECI.NUM_ECI','ASC')
            ->get();
        $acciones2 = accionesmejoraModel::join('SCI_ECI','SCI_ECI.NUM_ECI','=','SCI_ACCIONES_MEJORA.NUM_ECI')
            ->join('SCI_NGCI','SCI_NGCI.CVE_NGCI','=','SCI_ACCIONES_MEJORA.CVE_NGCI')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            //->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.VALOR_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC_2')
            ->join('SCI_SERVIDORESPUB','SCI_SERVIDORESPUB.ID_SP','=','SCI_ACCIONES_MEJORA.ID_SP')
            ->select('SCI_NGCI.CVE_NGCI','SCI_NGCI.DESC_NGCI','SCI_ACCIONES_MEJORA.NUM_ECI','SCI_ECI.PREG_ECI','SCI_M_EVAELEMCONTROL.PORC_MEEC','SCI_ACCIONES_MEJORA.NUM_MEEC_2','SCI_ACCIONES_MEJORA.PROCESOS','SCI_ACCIONES_MEJORA.NO_ACC_MEJORA','SCI_ACCIONES_MEJORA.DESC_ACC_MEJORA','SCI_ACCIONES_MEJORA.FECHA_INI','SCI_ACCIONES_MEJORA.FECHA_TER','SCI_SERVIDORESPUB.UNID_ADMON','SCI_SERVIDORESPUB.NOMBRES','SCI_SERVIDORESPUB.PATERNO','SCI_SERVIDORESPUB.MATERNO','SCI_ACCIONES_MEJORA.MEDIOS_VERIFICACION')
            ->where('SCI_ACCIONES_MEJORA.N_PERIODO',date('Y'))
            ->where('SCI_ACCIONES_MEJORA.ESTRUCGOB_ID','LIKE','21500%')
            ->where('SCI_ACCIONES_MEJORA.CVE_NGCI','=',2)
            ->where('SCI_ACCIONES_MEJORA.NUM_EVAL',$id)
            ->orderBy('SCI_ECI.NUM_ECI','ASC')
            ->get();
        $acciones3 = accionesmejoraModel::join('SCI_ECI','SCI_ECI.NUM_ECI','=','SCI_ACCIONES_MEJORA.NUM_ECI')
            ->join('SCI_NGCI','SCI_NGCI.CVE_NGCI','=','SCI_ACCIONES_MEJORA.CVE_NGCI')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            //->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.VALOR_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC_2')
            ->join('SCI_SERVIDORESPUB','SCI_SERVIDORESPUB.ID_SP','=','SCI_ACCIONES_MEJORA.ID_SP')
            ->select('SCI_NGCI.CVE_NGCI','SCI_NGCI.DESC_NGCI','SCI_ACCIONES_MEJORA.NUM_ECI','SCI_ECI.PREG_ECI','SCI_M_EVAELEMCONTROL.PORC_MEEC','SCI_ACCIONES_MEJORA.NUM_MEEC_2','SCI_ACCIONES_MEJORA.PROCESOS','SCI_ACCIONES_MEJORA.NO_ACC_MEJORA','SCI_ACCIONES_MEJORA.DESC_ACC_MEJORA','SCI_ACCIONES_MEJORA.FECHA_INI','SCI_ACCIONES_MEJORA.FECHA_TER','SCI_SERVIDORESPUB.UNID_ADMON','SCI_SERVIDORESPUB.NOMBRES','SCI_SERVIDORESPUB.PATERNO','SCI_SERVIDORESPUB.MATERNO','SCI_ACCIONES_MEJORA.MEDIOS_VERIFICACION')
            ->where('SCI_ACCIONES_MEJORA.N_PERIODO',date('Y'))
            ->where('SCI_ACCIONES_MEJORA.ESTRUCGOB_ID','LIKE','21500%')
            ->where('SCI_ACCIONES_MEJORA.CVE_NGCI','=',3)
            ->where('SCI_ACCIONES_MEJORA.NUM_EVAL',$id)
            ->orderBy('SCI_ECI.NUM_ECI','ASC')
            ->get();
        $acciones4 = accionesmejoraModel::join('SCI_ECI','SCI_ECI.NUM_ECI','=','SCI_ACCIONES_MEJORA.NUM_ECI')
            ->join('SCI_NGCI','SCI_NGCI.CVE_NGCI','=','SCI_ACCIONES_MEJORA.CVE_NGCI')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            //->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.VALOR_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC_2')
            ->join('SCI_SERVIDORESPUB','SCI_SERVIDORESPUB.ID_SP','=','SCI_ACCIONES_MEJORA.ID_SP')
            ->select('SCI_NGCI.CVE_NGCI','SCI_NGCI.DESC_NGCI','SCI_ACCIONES_MEJORA.NUM_ECI','SCI_ECI.PREG_ECI','SCI_M_EVAELEMCONTROL.PORC_MEEC','SCI_ACCIONES_MEJORA.NUM_MEEC_2','SCI_ACCIONES_MEJORA.PROCESOS','SCI_ACCIONES_MEJORA.NO_ACC_MEJORA','SCI_ACCIONES_MEJORA.DESC_ACC_MEJORA','SCI_ACCIONES_MEJORA.FECHA_INI','SCI_ACCIONES_MEJORA.FECHA_TER','SCI_SERVIDORESPUB.UNID_ADMON','SCI_SERVIDORESPUB.NOMBRES','SCI_SERVIDORESPUB.PATERNO','SCI_SERVIDORESPUB.MATERNO','SCI_ACCIONES_MEJORA.MEDIOS_VERIFICACION')
            ->where('SCI_ACCIONES_MEJORA.N_PERIODO',date('Y'))
            ->where('SCI_ACCIONES_MEJORA.ESTRUCGOB_ID','LIKE','21500%')
            ->where('SCI_ACCIONES_MEJORA.CVE_NGCI','=',4)
            ->where('SCI_ACCIONES_MEJORA.NUM_EVAL',$id)
            ->orderBy('SCI_ECI.NUM_ECI','ASC')
            ->get();
        $acciones5 = accionesmejoraModel::join('SCI_ECI','SCI_ECI.NUM_ECI','=','SCI_ACCIONES_MEJORA.NUM_ECI')
            ->join('SCI_NGCI','SCI_NGCI.CVE_NGCI','=','SCI_ACCIONES_MEJORA.CVE_NGCI')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            ->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.NUM_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC')
            //->join('SCI_M_EVAELEMCONTROL','SCI_M_EVAELEMCONTROL.VALOR_MEEC','=','SCI_ACCIONES_MEJORA.NUM_MEEC_2')
            ->join('SCI_SERVIDORESPUB','SCI_SERVIDORESPUB.ID_SP','=','SCI_ACCIONES_MEJORA.ID_SP')
            ->select('SCI_NGCI.CVE_NGCI','SCI_NGCI.DESC_NGCI','SCI_ACCIONES_MEJORA.NUM_ECI','SCI_ECI.PREG_ECI','SCI_M_EVAELEMCONTROL.PORC_MEEC','SCI_ACCIONES_MEJORA.NUM_MEEC_2','SCI_ACCIONES_MEJORA.PROCESOS','SCI_ACCIONES_MEJORA.NO_ACC_MEJORA','SCI_ACCIONES_MEJORA.DESC_ACC_MEJORA','SCI_ACCIONES_MEJORA.FECHA_INI','SCI_ACCIONES_MEJORA.FECHA_TER','SCI_SERVIDORESPUB.UNID_ADMON','SCI_SERVIDORESPUB.NOMBRES','SCI_SERVIDORESPUB.PATERNO','SCI_SERVIDORESPUB.MATERNO','SCI_ACCIONES_MEJORA.MEDIOS_VERIFICACION')
            ->where('SCI_ACCIONES_MEJORA.N_PERIODO',date('Y'))
            ->where('SCI_ACCIONES_MEJORA.ESTRUCGOB_ID','LIKE','21500%')
            ->where('SCI_ACCIONES_MEJORA.CVE_NGCI','=',5)
            ->where('SCI_ACCIONES_MEJORA.NUM_EVAL',$id)
            ->orderBy('SCI_ECI.NUM_ECI','ASC')
            ->get();
        $evaluaciones = m_evaelemcontrolModel::select('NUM_MEEC','PORC_MEEC')
            ->orderBy('NUM_MEEC','ASC')
            ->get();
        //dd($evaluaciones);
        $pdf = PDF::loadView('sicinar.pdf.planTrabajo',compact('usuario','nombre','estructura','rango','acciones1','acciones2','acciones3','acciones4','acciones5','plan','dependencia_aux','evaluaciones'));
        $pdf->setPaper('A4', 'landscape');
        //return $pdf->download('procesos_'.date('d-m-Y').'.pdf');
        return $pdf->stream('PlanDeTrabajo-'.$id);
        //return view('sicinar.pdf.planTrabajo',compact('usuario','nombre','estructura','rango','acciones1','acciones2','acciones3','acciones4','acciones5','plan','dependencia_aux'));
    }
}
