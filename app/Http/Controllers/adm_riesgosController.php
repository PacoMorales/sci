<?php

namespace App\Http\Controllers;

use App\Http\Requests\editarEstrategiaRequest;
use App\Http\Requests\riesgosRequest;
use App\Http\Requests\factorRequest;
use App\Http\Requests\controlRequest;
use App\Http\Requests\valoracionRequest;
use App\Http\Requests\estrategiasRequest;
use App\dependenciasModel;
use App\servidorespubModel;
use App\progtrabModel;
use http\Env\Request;
use PDF;
use App\clase_riesgoModel;
use App\nivel_riesgoModel;
use App\clasificacion_riesgoModel;
use App\prob_ocurModel;
use App\gradoimpactoModel;
use App\riesgosModel;
use App\clasif_factorriesgoModel;
use App\tipo_factorModel;
use App\factores_riesgoModel;
use App\tipo_controlModel;
use App\defsuficienciaModel;
use App\control_riesgoModel;
use App\admon_riesgosModel;
use App\estrategias_accionesModel;

class adm_riesgosController extends Controller
{
    //VER APARTADO I
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
        $riesgos = riesgosModel::select('CVE_DEPENDENCIA','CVE_RIESGO','DESC_RIESGO','STATUS_1','STATUS_2')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->orderBy('CVE_RIESGO','ASC')
            ->paginate(10);
        if($riesgos->count() <= 0){
            toastr()->error('No existe ningún Riesgo dado de alta.','Lo siento!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un Riesgo.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoRiesgo');
        }
        $unidades = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->orderBy('DEPEN_DESC','asc')
            ->get();
        return view('sicinar.administracionderiesgos.verTodos',compact('nombre','usuario','estructura','rango','id_estructura','riesgos','unidades'));
    }

    public function activarRiesgo($id){
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
        $actualizarRiesgo = riesgosModel::where('CVE_RIESGO',$id)->update(['STATUS_1' => 'S']);
        $riesgos = riesgosModel::select('CVE_DEPENDENCIA','CVE_RIESGO','DESC_RIESGO','STATUS_1','STATUS_2')
            ->where('N_PERIODO',2018)
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->orderBy('CVE_RIESGO','ASC')
            ->paginate(10);
        if($riesgos->count() <= 0){
            toastr()->error('No existe ningún Riesgo dado de alta.','Lo siento!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un Riesgo.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoRiesgo');
        }
        $unidades = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->orderBy('DEPEN_DESC','asc')
            ->get();
        return view('sicinar.administracionderiesgos.verTodos',compact('nombre','usuario','estructura','rango','id_estructura','riesgos','unidades'));
    }

    public function desactivarRiesgo($id){
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
        $actualizarRiesgo = riesgosModel::where('CVE_RIESGO',$id)->update(['STATUS_1' => 'N']);
        $riesgos = riesgosModel::select('CVE_DEPENDENCIA','CVE_RIESGO','DESC_RIESGO','STATUS_1','STATUS_2')
            ->where('N_PERIODO',2018)
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->orderBy('CVE_RIESGO','ASC')
            ->paginate(10);
        if($riesgos->count() <= 0){
            toastr()->error('No existe ningún Riesgo dado de alta.','Lo siento!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un Riesgo.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoRiesgo');
        }
        $unidades = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->orderBy('DEPEN_DESC','asc')
            ->get();
        return view('sicinar.administracionderiesgos.verTodos',compact('nombre','usuario','estructura','rango','id_estructura','riesgos','unidades'));
    }

    public function controlarRiesgo($id){
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
        $actualizarRiesgo = riesgosModel::where('CVE_RIESGO',$id)->update(['STATUS_2' => 'S']);
        $riesgos = riesgosModel::select('CVE_DEPENDENCIA','CVE_RIESGO','DESC_RIESGO','STATUS_1','STATUS_2')
            ->where('N_PERIODO',2018)
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->orderBy('CVE_RIESGO','ASC')
            ->paginate(10);
        if($riesgos->count() <= 0){
            toastr()->error('No existe ningún Riesgo dado de alta.','Lo siento!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un Riesgo.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoRiesgo');
        }
        $unidades = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->orderBy('DEPEN_DESC','asc')
            ->get();
        return view('sicinar.administracionderiesgos.verTodos',compact('nombre','usuario','estructura','rango','id_estructura','riesgos','unidades'));
    }

    public function descontrolarRiesgo($id){
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
        $actualizarRiesgo = riesgosModel::where('CVE_RIESGO',$id)->update(['STATUS_2' => 'N']);
        $riesgos = riesgosModel::select('CVE_DEPENDENCIA','CVE_RIESGO','DESC_RIESGO','STATUS_1','STATUS_2')
            ->where('N_PERIODO',2018)
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->orderBy('CVE_RIESGO','ASC')
            ->paginate(10);
        if($riesgos->count() <= 0){
            toastr()->error('No existe ningún Riesgo dado de alta.','Lo siento!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un Riesgo.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoRiesgo');
        }
        $unidades = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->orderBy('DEPEN_DESC','asc')
            ->get();
        return view('sicinar.administracionderiesgos.verTodos',compact('nombre','usuario','estructura','rango','id_estructura','riesgos','unidades'));
    }

    //NUEVO APARTADO I. EVALUACION DE RIESGOS
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
        $grados = gradoimpactoModel::orderBy('GRADO_IMPACTO','ASC')->get();
        $probabilidades = prob_ocurModel::orderBy('ESCALA_VALOR','ASC')->get();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON')
            ->orderBy('UNID_ADMON','ASC')
            ->orderBy('NOMBRES','ASC')
            ->get();
        return view('sicinar.administracionderiesgos.nuevo',compact('nombre','usuario','estructura','rango','id_estructura','planes','unidades','clases','niveles','clasificaciones','grados','probabilidades','servidores'));
    }

    //ALTA APARTADO I. EVALUACION DE RIESGOS
    public function actionAltaRiesgo(riesgosRequest $request){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');

        $nuevoRiesgo = new riesgosModel();
        //$nuevoRiesgo->
        $nuevoRiesgo->N_PERIODO = (int)date('Y');
        $nuevoRiesgo->ESTRUCGOB_ID = $request->estructura;
        $nuevoRiesgo->CVE_DEPENDENCIA = $request->unidad;
        if(strcmp($request->titular,"999999999") == 0){
            $nuevoRiesgo->TITULAR = strtoupper($request->titular_aux);
            $nuevoRiesgo->ID_SP_1 = $request->id_sp_aux;
        }else{
            $sp = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO')->where('ID_SP','like',$request->titular.'%')->first();
            if($sp->count() == 0){
                $nuevoRiesgo->TITULAR = 'SIN ESPECIFICAR';
                $nuevoRiesgo->ID_SP_1 = '999999999';
            }else{
                $titular_aux = ($sp->nombres.' '.$sp->paterno.' '.$sp->materno);
                $nuevoRiesgo->TITULAR = $titular_aux;
                $nuevoRiesgo->ID_SP_1 = $sp->id_sp;
            }
        }
        if(strcmp($request->coordinador,"999999999") == 0){
            $nuevoRiesgo->COORDINADOR = strtoupper($request->coor_aux);
            $nuevoRiesgo->ID_SP_2 = $request->id_sp_coor;
        }else{
            $sp = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO')->where('ID_SP','like',$request->coordinador.'%')->first();
            if($sp->count() == 0){
                $nuevoRiesgo->COORDINADOR = 'SIN ESPECIFICAR';
                $nuevoRiesgo->ID_SP_2 = '999999999';
            }else{
                $coor_aux = ($sp->nombres.' '.$sp->paterno.' '.$sp->materno);
                $nuevoRiesgo->COORDINADOR = $coor_aux;
                $nuevoRiesgo->ID_SP_2 = $sp->id_sp;
            }
        }
        if(strcmp($request->enlace,"999999999") == 0){
            $nuevoRiesgo->ENLACE = strtoupper($request->enlace_aux);
            $nuevoRiesgo->ID_SP_3 = $request->id_sp_enlace;
        }else{
            $sp = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO')->where('ID_SP','like',$request->enlace.'%')->first();
            if($sp->count() == 0){
                $nuevoRiesgo->ENLACE = 'SIN ESPECIFICAR';
                $nuevoRiesgo->ID_SP_3 = '999999999';
            }else{
                $enlace_aux = ($sp->nombres.' '.$sp->paterno.' '.$sp->materno);
                $nuevoRiesgo->ENLACE = $enlace_aux;
                $nuevoRiesgo->ID_SP_3 = $sp->id_sp;
            }
        }
        $id_riesgo = riesgosModel::max('CVE_RIESGO');
        $nuevoRiesgo->CVE_RIESGO = $id_riesgo+1;
        $nuevoRiesgo->DESC_RIESGO = strtoupper($request->riesgo);
        $nuevoRiesgo->ALINEACION_RIESGO = strtoupper($request->descripcion);
        $nuevoRiesgo->CVE_CLASE_RIESGO = $request->seleccion;
        $nuevoRiesgo->CVE_NIVEL_DECRIESGO = $request->decision;
        $nuevoRiesgo->CVE_CLASIF_RIESGO = $request->clasificacion;
        $nuevoRiesgo->OTRO_CLASIF_RIESGO = $request->otro;
        $nuevoRiesgo->EFECTOS_RIESGO = $request->efectos;
        $nuevoRiesgo->GRADO_IMPACTO = $request->impacto;
        $nuevoRiesgo->ESCALA_VALOR = $request->ocurrencia;
        $nuevoRiesgo->STATUS_1 = 'S';
        $nuevoRiesgo->STATUS_2 = 'N';
        $nuevoRiesgo->FECHA_REG = date('Y/m/d');
        $nuevoRiesgo->USU = $usuario;
        $nuevoRiesgo->IP = $ip;
        $nuevoRiesgo->FECHA_M = date('Y/m/d');
        $nuevoRiesgo->USU_M = $usuario;
        $nuevoRiesgo->IP_M = $ip;
        //dd($nuevoRiesgo);
        if($nuevoRiesgo->save() == true){
            toastr()->success('El Riesgo ha sido dado de alta correctamente.','Nuevo Riesgo dado de alta!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('verRiesgos');
        }else{
            toastr()->error('Ha ocurrido algo inesperado al dar de alta el Riesgo. Vuelve a interlo.','Ups!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoRiesgo');
        }
    }

    //EDITAR APARTADO I. EVALUACION DE RIESGOS
    public function editarRiesgo($id){
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
        $riesgo = riesgosModel::where('N_PERIODO',2018)
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO',$id)
            ->orderBy('CVE_RIESGO','ASC')
            ->first();
        $unidades = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->orderBy('DEPEN_DESC','asc')
            ->get();
        //dd($riesgo);
        $clases = clase_riesgoModel::orderBy('CVE_CLASE_RIESGO','ASC')->get();
        $niveles = nivel_riesgoModel::orderBy('CVE_NIVEL_DECRIESGO','ASC')->get();
        $clasificaciones = clasificacion_riesgoModel::orderBy('CVE_CLASIF_RIESGO','ASC')->get();
        $grados = gradoimpactoModel::orderBy('GRADO_IMPACTO','ASC')->get();
        $probabilidades = prob_ocurModel::orderBy('ESCALA_VALOR','ASC')->get();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON')
            ->orderBy('UNID_ADMON','ASC')
            ->orderBy('NOMBRES','ASC')
            ->get();
        //dd($servidores[0]);
        return view('sicinar.administracionderiesgos.I',compact('nombre','usuario','estructura','rango','id_estructura','riesgo','unidades','clases','niveles','clasificaciones','grados','probabilidades','servidores'));
    }

    //ACTUALIZAR APARTADO I. EVALUACION DE RIESGOS
    public function actualizarRiesgoI(riesgosRequest $request, $id){
        //dd($request->all());
        //dd($id);
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');

        /*$titular='';$id_sp_1='';
        $coordinador='';$id_sp_2='';
        $enlace='';$id_sp_3='';*/

        if(strcmp($request->titular,"999999999") == 0){
            $titular = strtoupper($request->titular_aux);
            $id_sp_1 = $request->id_sp_aux;
        }else{
            $sp = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO')->where('ID_SP','like',$request->titular.'%')->first();
            if($sp->count() == 0){
                $titular = 'SIN ESPECIFICAR';
                $id_sp_1 = '999999999';
            }else{
                $titular_aux = ($sp->nombres.' '.$sp->paterno.' '.$sp->materno);
                $titular = $titular_aux;
                $id_sp_1 = $sp->id_sp;
            }
        }

        if(strcmp($request->coordinador,"999999999") == 0){
            $coordinador = strtoupper($request->coor_aux);
            $id_sp_2 = $request->id_sp_coor;
        }else{
            $sp = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO')->where('ID_SP','like',$request->coordinador.'%')->first();
            if($sp->count() == 0){
                $coordinador = 'SIN ESPECIFICAR';
                $id_sp_2 = '999999999';
            }else{
                $coor_aux = ($sp->nombres.' '.$sp->paterno.' '.$sp->materno);
                $coordinador = $coor_aux;
                $id_sp_2 = $sp->id_sp;
            }
        }

        if(strcmp($request->enlace,"999999999") == 0){
            $enlace = strtoupper($request->enlace_aux);
            $id_sp_3 = $request->id_sp_enlace;
        }else{
            $sp = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO')->where('ID_SP','like',$request->enlace.'%')->first();
            if($sp->count() == 0){
                $enlace = 'SIN ESPECIFICAR';
                $id_sp_3 = '999999999';
            }else{
                $enlace_aux = ($sp->nombres.' '.$sp->paterno.' '.$sp->materno);
                $enlace = $enlace_aux;
                $id_sp_3 = $sp->id_sp;
            }
        }

        $actualizarRiesgo = riesgosModel::where('CVE_RIESGO',$id)
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->update([
                'ESTRUCGOB_ID' => $request->estructura,
                'CVE_DEPENDENCIA' => $request->unidad,
                'TITULAR' => $titular,
                'ID_SP_1' => $id_sp_1,
                'COORDINADOR' => $coordinador,
                'ID_SP_2' => $id_sp_2,
                'ENLACE' => $enlace,
                'ID_SP_3' => $id_sp_3,
                'DESC_RIESGO' => strtoupper($request->riesgo),
                'ALINEACION_RIESGO' => strtoupper($request->descripcion),
                'CVE_CLASE_RIESGO' => $request->seleccion,
                'CVE_NIVEL_DECRIESGO' => $request->decision,
                'CVE_CLASIF_RIESGO' => $request->clasificacion,
                'OTRO_CLASIF_RIESGO' => $request->otro,
                'EFECTOS_RIESGO' => $request->efectos,
                'GRADO_IMPACTO' => $request->impacto,
                'ESCALA_VALOR' => $request->ocurrencia,
                'FECHA_M' => date('Y/m/d'),
                'USU_M' => $usuario,
                'IP_M' => $ip
            ]);
        toastr()->success('El Riesgo ha sido actualizado correctamente.','Riesgo actualizado!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verRiesgos');
    }

    //NUEVO FACTOR DEL APARTADO I
    public function actionNuevoFactor($id){
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
        $riesgo = riesgosModel::select('CVE_RIESGO','DESC_RIESGO')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO',$id)
            ->orderBy('CVE_RIESGO','ASC')
            ->first();
        $clasificaciones = clasif_factorriesgoModel::select('CVE_CLASIF_FACTORRIESGO','DESC_CLASIF_FACTORRIESGO')
            ->orderBy('CVE_CLASIF_FACTORRIESGO','ASC')
            ->get();
        $tipos = tipo_factorModel::select('CVE_TIPO_FACTOR','DESC_TIPO_FACTOR')
            ->orderBy('CVE_TIPO_FACTOR','ASC')
            ->get();
        session()->forget('riesgo_id');
        session(['riesgo_id' => $id]);
        return view('sicinar.administracionderiesgos.factores.nuevoFactor',compact('nombre','usuario','estructura','rango','id_estructura','riesgo','clasificaciones','tipos'));
    }

    //ALTA FACTOR DEL APARTADO I
    public function actionAltaFactor(factorRequest $request){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');
        $riesgo = session()->get('riesgo_id');
        //
        $riesgo_aux = riesgosModel::select('N_PERIODO','ESTRUCGOB_ID','CVE_DEPENDENCIA')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO',$riesgo)
            ->orderBy('CVE_RIESGO','ASC')
            ->first();
        $idFactor = factores_riesgoModel::max('NUM_FACTOR_RIESGO');
        $nuevoFactor = new factores_riesgoModel();
        $nuevoFactor->N_PERIODO = $riesgo_aux->n_periodo;
        $nuevoFactor->ESTRUCGOB_ID = $riesgo_aux->estrucgob_id;
        $nuevoFactor->CVE_DEPENDENCIA = $riesgo_aux->cve_dependencia;
        $nuevoFactor->CVE_RIESGO = $riesgo;
        $nuevoFactor->NUM_FACTOR_RIESGO  = $idFactor+1;
        $nuevoFactor->DESC_FACTOR_RIESGO = strtoupper($request->descripcion);
        $nuevoFactor->CVE_CLASIF_FACTORRIESGO = $request->clasificacion;
        $nuevoFactor->CVE_TIPO_FACTOR = $request->tipo;
        $nuevoFactor->STATUS_1 = 'S';
        $nuevoFactor->STATUS_2 = 'N';
        $nuevoFactor->SE_PUBLICA = 'S';
        $nuevoFactor->FECHA_REG = date('Y/m/d');
        if($nuevoFactor->save() == true){
            toastr()->success('El Factor ha sido dado de alta correctamente.','Nuevo Factor dado de alta!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoFactor',$riesgo);
        }else{
            toastr()->error('Ha ocurrido algo inesperado al dar de alta el Factor. Vuelve a interlo.','Ups!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoFactor',$riesgo);
        }
    }

    //VER FACTORES DEL APARTADO I
    public function actionVerFactor($id){
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

        $riesgo = riesgosModel::select('CVE_RIESGO','DESC_RIESGO')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO',$id)
            ->first();

        $factores = factores_riesgoModel::join('SCI_CLASIF_FACTORRIESGO','SCI_FACTORES_RIESGO.CVE_CLASIF_FACTORRIESGO','=','SCI_CLASIF_FACTORRIESGO.CVE_CLASIF_FACTORRIESGO')
            ->join('SCI_TIPO_FACTOR','SCI_FACTORES_RIESGO.CVE_TIPO_FACTOR','=','SCI_TIPO_FACTOR.CVE_TIPO_FACTOR')
            ->select('SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','SCI_FACTORES_RIESGO.DESC_FACTOR_RIESGO','SCI_CLASIF_FACTORRIESGO.DESC_CLASIF_FACTORRIESGO','SCI_TIPO_FACTOR.DESC_TIPO_FACTOR','SCI_FACTORES_RIESGO.STATUS_1','SCI_FACTORES_RIESGO.STATUS_2')
            ->where('SCI_FACTORES_RIESGO.N_PERIODO',(int)date('Y'))
            ->where('SCI_FACTORES_RIESGO.ESTRUCGOB_ID','LIKE','21500%')
            ->where('SCI_FACTORES_RIESGO.CVE_RIESGO',$id)
            ->orderBy('SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','ASC')
            //->orderBy('SCI_FACTORES_RIESGO.CVE_RIESGO','ASC')
            ->paginate(5);
        //dd($riesgo);
        return view('sicinar.administracionderiesgos.factores.verFactor',compact('nombre','usuario','estructura','id_estructura','rango','riesgo','factores'));

    }

    //EDITAR FACTOR DEL APARTADO I
    public function actionEditarFactor($id){
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

        $factor = factores_riesgoModel::where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO',$id)
            ->first();
        $clasificaciones = clasif_factorriesgoModel::select('CVE_CLASIF_FACTORRIESGO','DESC_CLASIF_FACTORRIESGO')
            ->orderBy('CVE_CLASIF_FACTORRIESGO','ASC')
            ->get();
        $tipos = tipo_factorModel::select('CVE_TIPO_FACTOR','DESC_TIPO_FACTOR')
            ->orderBy('CVE_TIPO_FACTOR','ASC')
            ->get();
        //dd($factor);
        return view('sicinar.administracionderiesgos.factores.editarFactor',compact('nombre','usuario','estructura','rango','id_estructura','factor','clasificaciones','tipos'));
    }

    //ACTUALIZAR FACTOR DEL APARTADO I
    public function actionActualizarFactor(factorRequest $request, $id){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }

        $actualizarFactor = factores_riesgoModel::where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO',$id)
            ->update([
                'DESC_FACTOR_RIESGO' => strtoupper($request->descripcion),
                'CVE_CLASIF_FACTORRIESGO' => $request->clasificacion,
                'CVE_TIPO_FACTOR' => $request->tipo
            ]);
        toastr()->success('El Factor '.$id.' ha sido modificado correctamente.','Factor '.$id.' modificado!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verRiesgos');
    }

    //NUEVO APARTADO II. EVALUACIÓN DE CONTROLES
    public function actionNuevoControl(){
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
        $riesgos = riesgosModel::select('CVE_RIESGO','DESC_RIESGO')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->orderBy('CVE_RIESGO','ASC')->get();
        $tipos = tipo_controlModel::select('CVE_TIPO_CONTROL','DESC_TIPO_CONTROL')
            ->orderBy('CVE_TIPO_CONTROL','ASC')
            ->get();
        $suficiencias = defsuficienciaModel::select('CVE_DEFSUF_CONTROL','DESC_DEFSUF_CONTROL')
            ->orderBy('CVE_DEFSUF_CONTROL','ASC')->get();
        return view('sicinar.administracionderiesgos.nuevoControl',compact('nombre','usuario','estructura','id_estructura','rango','riesgos','tipos','suficiencias'));
    }

    //ALTA APARTADO II. EVALUACIÓN DE CONTROLES
    public function actionAltaControl(controlRequest $request){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');
        $riesgo = riesgosModel::select('ESTRUCGOB_ID','CVE_DEPENDENCIA')->where('CVE_RIESGO',$request->riesgo)->first();
        $id_aux = control_riesgoModel::max('CVE_CONTROL_DERIESGO');
        $nuevoControl = new control_riesgoModel();
        $nuevoControl->N_PERIODO = (int)date('Y');
        $nuevoControl->ESTRUCGOB_ID = $riesgo->estrucgob_id;
        $nuevoControl->CVE_DEPENDENCIA = $riesgo->cve_dependencia;
        $nuevoControl->CVE_RIESGO = $request->riesgo;
        $nuevoControl->NUM_FACTOR_RIESGO = $request->factor;
        $nuevoControl->CVE_CONTROL_DERIESGO = $id_aux+1;
        $nuevoControl->DESC_CONTROL_DERIESGO = strtoupper($request->control);
        $nuevoControl->CVE_TIPO_CONTROL = $request->tipo;
        if($request->documentado=='S' AND $request->formalizado=='S' AND $request->aplica=='S' AND $request->efectivo=='S'){
            $nuevoControl->CVE_DEFSUF_CONTROL = 2; //SUFICIENTE
        }else{
            $nuevoControl->CVE_DEFSUF_CONTROL = 1; //DEFICIENTE
        }
        $nuevoControl->DOCUMENTADO = $request->documentado;
        $nuevoControl->FORMALIZADO = $request->formalizado;
        $nuevoControl->APLICA = $request->aplica;
        $nuevoControl->EFECTIVO = $request->efectivo;
        $nuevoControl->STATUS_1 = 'S';
        $nuevoControl->FECHA_REG = date('Y/m/d');
        $nuevoControl->USU = $usuario;
        $nuevoControl->IP = $ip;
        $nuevoControl->FECHA_M = date('Y/m/d');
        $nuevoControl->USU_M = $usuario;
        $nuevoControl->IP_M = $ip;
        //dd($nuevoControl);
        if($nuevoControl->save() == true){
            toastr()->success('El Control ha sido dado de alta correctamente.','Nuevo Control!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoControl');
        }else{
            toastr()->error('Ha ocurrido algo inesperado. Por favor vuelve a agregar el control.','Ups!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoControl');
        }
    }

    //VER APARTADO II. EVALUACIÓN DE CONTROLES
    public function actionVerControl(){
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
        $controles = control_riesgoModel::join('SCI_RIESGOS','SCI_CONTROLES_DERIESGO.CVE_RIESGO','=','SCI_RIESGOS.CVE_RIESGO') //RIESGO
            ->join('SCI_FACTORES_RIESGO','SCI_CONTROLES_DERIESGO.NUM_FACTOR_RIESGO','=','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO') //FACTOR
            ->join('SCI_DEFSUFICIENCIA_CONTROL','SCI_CONTROLES_DERIESGO.CVE_DEFSUF_CONTROL','=','SCI_DEFSUFICIENCIA_CONTROL.CVE_DEFSUF_CONTROL') //DEFICIENCIA O SUFICIENCIA
            ->join('SCI_TIPO_CONTROL','SCI_CONTROLES_DERIESGO.CVE_TIPO_CONTROL','=','SCI_TIPO_CONTROL.CVE_TIPO_CONTROL') //TIPO
            ->select('SCI_RIESGOS.CVE_RIESGO','SCI_RIESGOS.DESC_RIESGO','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','SCI_FACTORES_RIESGO.DESC_FACTOR_RIESGO','SCI_CONTROLES_DERIESGO.CVE_CONTROL_DERIESGO','SCI_CONTROLES_DERIESGO.DESC_CONTROL_DERIESGO','SCI_DEFSUFICIENCIA_CONTROL.DESC_DEFSUF_CONTROL','SCI_TIPO_CONTROL.DESC_TIPO_CONTROL','SCI_CONTROLES_DERIESGO.STATUS_1','SCI_CONTROLES_DERIESGO.DOCUMENTADO','SCI_CONTROLES_DERIESGO.FORMALIZADO','SCI_CONTROLES_DERIESGO.APLICA','SCI_CONTROLES_DERIESGO.EFECTIVO')
            ->where('SCI_CONTROLES_DERIESGO.N_PERIODO',(int)date('Y'))
            //->where('SCI_CONTROLES_DERIESGO.N_PERIODO',2018)
            ->where('SCI_CONTROLES_DERIESGO.ESTRUCGOB_ID','like','21500%')
            ->orderBy('SCI_CONTROLES_DERIESGO.CVE_RIESGO','ASC')
            ->orderBy('SCI_CONTROLES_DERIESGO.NUM_FACTOR_RIESGO','ASC')
            ->orderBy('SCI_CONTROLES_DERIESGO.CVE_CONTROL_DERIESGO','ASC')
            ->get();
        //dd($controles[0]->num_factor_riesgo);
        if($controles->count() <= 0){
            toastr()->error('No haz dado de alta ningún control.','Ups!',['positionClass' => 'toast-bottom-right']);
            toastr()->info('Da de alta un nuevo control.','Hazlo ya!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevoControl');
        }
        $controlados = control_riesgoModel::selectRaw('CVE_RIESGO,DOCUMENTADO, COUNT(DOCUMENTADO) as TOTALDOCS, FORMALIZADO, COUNT(FORMALIZADO) as TOTALFORMAL,APLICA, COUNT(APLICA) as TOTALAPLICA, EFECTIVO, COUNT(EFECTIVO) AS TOTALEFEC')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','like','21500%')
            ->whereRaw("((DOCUMENTADO like 'N%') OR (FORMALIZADO like 'N%') OR (APLICA like 'N%') OR (EFECTIVO like 'N%'))")
            //->orwhere('DOCUMENTADO','like','N%')
            //->orwhere('FORMALIZADO','like','N%')
            //->orwhere('APLICA','like','N%')
            //->orwhere('EFECTIVO','like','N%')
            ->groupBy('CVE_RIESGO','DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->orderBy('CVE_RIESGO','ASC')
            ->get();
        //dd($controlados);
        $controlads = $controlados->count();
        //dd($controlads);
        $cant_controles = control_riesgoModel::selectRaw('CVE_RIESGO, COUNT(CVE_RIESGO) AS RENGLONES')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','like','21500%')
            ->groupBy('CVE_RIESGO')
            ->orderBy('CVE_RIESGO','ASC')
            ->get();
        //dd($cant_controles);
        $cant_factor = control_riesgoModel::selectRaw('NUM_FACTOR_RIESGO, COUNT(NUM_FACTOR_RIESGO) AS RENGLONES')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','like','21500%')
            ->groupBy('NUM_FACTOR_RIESGO')
            ->orderBy('NUM_FACTOR_RIESGO','ASC')
            ->get();
            //dd($cant_factor->all());
        $total = $controles->count();
        return view('sicinar.administracionderiesgos.verControl',compact('nombre','usuario','estructura','id_estructura','rango','controles','total','controlados','cant_controles','cant_factor','controlads'));
        //dd($controles);
    }

    //EDITAR APARTADO II. EVALUACIÓN DE CONTROLES
    public function actionEditarControl($id){
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
        $control = control_riesgoModel::join('SCI_RIESGOS','SCI_CONTROLES_DERIESGO.CVE_RIESGO','=','SCI_RIESGOS.CVE_RIESGO')
            ->join('SCI_FACTORES_RIESGO','SCI_CONTROLES_DERIESGO.NUM_FACTOR_RIESGO','=','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO')
            ->select('SCI_RIESGOS.DESC_RIESGO','SCI_FACTORES_RIESGO.DESC_FACTOR_RIESGO','SCI_CONTROLES_DERIESGO.CVE_CONTROL_DERIESGO','SCI_CONTROLES_DERIESGO.DESC_CONTROL_DERIESGO','SCI_CONTROLES_DERIESGO.CVE_TIPO_CONTROL','SCI_CONTROLES_DERIESGO.DOCUMENTADO','SCI_CONTROLES_DERIESGO.FORMALIZADO','SCI_CONTROLES_DERIESGO.APLICA','SCI_CONTROLES_DERIESGO.EFECTIVO')
            ->where('SCI_CONTROLES_DERIESGO.CVE_CONTROL_DERIESGO',$id)
            ->first();
        //dd($control);
        /*$control = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->first();*/
        $tipos = tipo_controlModel::select('CVE_TIPO_CONTROL','DESC_TIPO_CONTROL')
            ->orderBy('CVE_TIPO_CONTROL','ASC')
            ->get();
        $suficiencias = defsuficienciaModel::select('CVE_DEFSUF_CONTROL','DESC_DEFSUF_CONTROL')
            ->orderBy('CVE_DEFSUF_CONTROL','ASC')->get();
        return view('sicinar.administracionderiesgos.editarControl',compact('nombre','usuario','estructura','id_estructura','rango','control','tipos','suficiencias'));
    }

    //ACTUALIZAR CONTROL II. EVALUACIÓN DE CONTROLES
    public function actionActualizarControl(controlRequest $request, $id){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');
        if($request->documentado=='S' AND $request->formalizado=='S' AND $request->aplica=='S' AND $request->efectivo=='S'){
            $aux = 2; //SUFICIENTE
        }else{
            $aux = 1; //DEFICIENTE
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)
            ->update([
                'DESC_CONTROL_DERIESGO' => strtoupper($request->control),
                'CVE_TIPO_CONTROL' => $request->tipo,
                'CVE_DEFSUF_CONTROL' => $aux,
                'DOCUMENTADO' => $request->documentado,
                'FORMALIZADO' => $request->formalizado,
                'APLICA' => $request->aplica,
                'EFECTIVO' => $request->efectivo,
                'FECHA_M' => date('Y/m/d'),
                'USU_M' => $usuario,
                'IP_M' => $ip
            ]);
        toastr()->success('El Control ha sido actualizado correctamente.','Actualización!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verControl');
    }

    //ACTIVAR CONTROL II. EVALUACIÓN DE CONTROLES
    public function activarControl($id){
        //dd('Ha desactivar '.$id);
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['STATUS_1' => 'S']);
        //dd($actualizarControl);
        return redirect()->route('verControl');
    }

    //DESACTIVAR CONTROL II. EVALUACIÓN DE CONTROLES
    public function desactivarControl($id){
        //dd('Ha activar'.$id);
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['STATUS_1' => 'N']);
        return redirect()->route('verControl');
    }

    //ACTIVAR DOCUMENTADO II. EVALUACIÓN DE CONTROLES
    public function activarDocumentado($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['DOCUMENTADO' => 'S']);
        $control = control_riesgoModel::select('DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->where('CVE_CONTROL_DERIESGO',$id)
            ->first();
        if($control->documentado=='S' AND $control->formalizado == 'S' AND $control->aplica=='S' AND $control->efectivo == 'S'){
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 2]);
        }else{
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 1]);
        }
        return redirect()->route('verControl');
    }

    //DESACTIVAR DOCUMENTADO II. EVALUACIÓN DE CONTROLES
    public function desactivarDocumentado($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['DOCUMENTADO' => 'N']);
        $control = control_riesgoModel::select('DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->where('CVE_CONTROL_DERIESGO',$id)
            ->first();
        if($control->documentado=='S' AND $control->formalizado == 'S' AND $control->aplica=='S' AND $control->efectivo == 'S'){
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 2]);
        }else{
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 1]);
        }
        return redirect()->route('verControl');
    }

    //ACTIVAR FORMALIZADO II. EVALUACIÓN DE CONTROLES
    public function activarFormalizado($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['FORMALIZADO' => 'S']);
        $control = control_riesgoModel::select('DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->where('CVE_CONTROL_DERIESGO',$id)
            ->first();
        if($control->documentado=='S' AND $control->formalizado == 'S' AND $control->aplica=='S' AND $control->efectivo == 'S'){
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 2]);
        }else{
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 1]);
        }
        return redirect()->route('verControl');
    }

    //DESACTIVAR FORMALIZADO II. EVALUACIÓN DE CONTROLES
    public function desactivarFormalizado($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['FORMALIZADO' => 'N']);
        $control = control_riesgoModel::select('DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->where('CVE_CONTROL_DERIESGO',$id)
            ->first();
        if($control->documentado=='S' AND $control->formalizado == 'S' AND $control->aplica=='S' AND $control->efectivo == 'S'){
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 2]);
        }else{
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 1]);
        }
        return redirect()->route('verControl');
    }

    //ACTIVAR APLICA II. EVALUACIÓN DE CONTROLES
    public function activarAplica($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['APLICA' => 'S']);
        $control = control_riesgoModel::select('DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->where('CVE_CONTROL_DERIESGO',$id)
            ->first();
        if($control->documentado=='S' AND $control->formalizado == 'S' AND $control->aplica=='S' AND $control->efectivo == 'S'){
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 2]);
        }else{
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 1]);
        }
        return redirect()->route('verControl');
    }

    //DESACTIVAR APLICA II. EVALUACIÓN DE CONTROLES
    public function desactivarAplica($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['APLICA' => 'N']);
        $control = control_riesgoModel::select('DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->where('CVE_CONTROL_DERIESGO',$id)
            ->first();
        if($control->documentado=='S' AND $control->formalizado == 'S' AND $control->aplica=='S' AND $control->efectivo == 'S'){
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 2]);
        }else{
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 1]);
        }
        return redirect()->route('verControl');
    }

    //ACTIVAR EFECTIVO II. EVALUACIÓN DE CONTROLES
    public function activarEfectivo($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['EFECTIVO' => 'S']);
        $control = control_riesgoModel::select('DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->where('CVE_CONTROL_DERIESGO',$id)
            ->first();
        if($control->documentado=='S' AND $control->formalizado == 'S' AND $control->aplica=='S' AND $control->efectivo == 'S'){
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 2]);
        }else{
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 1]);
        }
        return redirect()->route('verControl');
    }

    //DESACTIVAR EFECTIVO II. EVALUACIÓN DE CONTROLES
    public function desactivarEfectivo($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $actualizarControl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['EFECTIVO' => 'N']);
        $control = control_riesgoModel::select('DOCUMENTADO','FORMALIZADO','APLICA','EFECTIVO')
            ->where('CVE_CONTROL_DERIESGO',$id)
            ->first();
        if($control->documentado=='S' AND $control->formalizado == 'S' AND $control->aplica=='S' AND $control->efectivo == 'S'){
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 2]);
        }else{
            $actualizarCntrl = control_riesgoModel::where('CVE_CONTROL_DERIESGO',$id)->update(['CVE_DEFSUF_CONTROL' => 1]);
        }
        return redirect()->route('verControl');
    }

    public function actionObtFactores($id){
        return (response()->json(factores_riesgoModel::select('NUM_FACTOR_RIESGO','DESC_FACTOR_RIESGO')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO',$id)
            ->orderBy('NUM_FACTOR_RIESGO','ASC')->get()));
        /*return (response()->json(factores_riesgoModel::join('SCI_CONTROLES_DERIESGO','SCI_CONTROLES_DERIESGO.NUM_FACTOR_RIESGO','<>','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','right outer')
            ->select('SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','SCI_FACTORES_RIESGO.DESC_FACTOR_RIESGO')
            ->where('SCI_FACTORES_RIESGO.N_PERIODO',(int)date('Y'))
            ->where('SCI_FACTORES_RIESGO.ESTRUCGOB_ID','LIKE','21500%')
            ->where('SCI_FACTORES_RIESGO.CVE_RIESGO',$id)
            ->orderBy('SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','ASC')->get()));*/
    }

    //NUEVO III. VALORACIÓN DE RIESGOS VS CONTROLES
    public function actionNuevaValoracion(){
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
        $riesgos = riesgosModel::select('CVE_RIESGO','DESC_RIESGO')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('GRADO_IMPACTO_2','=',0)
            ->where('ESCALA_VALOR_2','=',0)
            ->orderBy('CVE_RIESGO','ASC')->get();
        $grados = gradoimpactoModel::orderBy('GRADO_IMPACTO','ASC')->get();
        $probabilidades = prob_ocurModel::orderBy('ESCALA_VALOR','ASC')->get();
        return view('sicinar.administracionderiesgos.valoracion.nuevo',compact('usuario','nombre','estructura','id_estructura','rango','riesgos','grados','probabilidades'));
    }

    //ALTA III. VALORACIÓN DE RIESGOS VS CONTROLES
    public function actionAltaValoracion(valoracionRequest $request){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');
        $actualizarRiesgo = riesgosModel::where('CVE_RIESGO',$request->riesgo)
            ->update([
                'GRADO_IMPACTO_2' => $request->grado,
                'ESCALA_VALOR_2' => $request->probabilidad,
                'FECHA_M' => date('Y/m/d'),
                'USU_M' => $usuario,
                'IP_M' => $ip
            ]);
        toastr()->success('La Valoración ha sido dado de alta correctamente.','Nueva Valoración!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('nuevaValoracion');
    }

    //VER III. VALORACIÓN DE RIESGOS VS CONTROLES
    public function actionVerValoracion(){
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
        $riesgos = riesgosModel::select('CVE_RIESGO','DESC_RIESGO','GRADO_IMPACTO_2','ESCALA_VALOR_2')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('GRADO_IMPACTO_2','>',0)
            ->where('ESCALA_VALOR_2','>',0)
            ->orderBy('CVE_RIESGO','ASC')->paginate(5);
        return view('sicinar.administracionderiesgos.valoracion.ver',compact('usuario','nombre','estructura','id_estructura','rango','riesgos'));
    }

    //EDITAR III. VALORACIÓN DE RIESGOS VS CONTROLES
    public function actionEditarValoracion($id){
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
        $riesgo = riesgosModel::select('CVE_RIESGO','DESC_RIESGO','GRADO_IMPACTO_2','ESCALA_VALOR_2')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO','=',$id)
            ->first();
        $grados = gradoimpactoModel::orderBy('GRADO_IMPACTO','ASC')->get();
        $probabilidades = prob_ocurModel::orderBy('ESCALA_VALOR','ASC')->get();
        return view('sicinar.administracionderiesgos.valoracion.editar',compact('usuario','nombre','estructura','id_estructura','rango','riesgo','grados','probabilidades'));
    }

    //MODIFICAR III. VALORACIÓN DE RIESGOS VS CONTROLES
    public function actionActualizarValoracion(valoracionRequest $request, $id){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');
        $actualizarRiesgo = riesgosModel::where('CVE_RIESGO',$id)
            ->update([
                'GRADO_IMPACTO_2' => $request->grado,
                'ESCALA_VALOR_2' => $request->probabilidad,
                'FECHA_M' => date('Y/m/d'),
                'USU_M' => $usuario,
                'IP_M' => $ip
            ]);
        toastr()->success('La Valoración ha sido dado de actualizada correctamente.','Valoración Actualizada!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verValoracion');
    }

    //ENLISTAR TODOS LOS RIESGOS CON MAPAS IV. MAPA DE RIESGOS
    public function actionListaMapas(){
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
        $riesgos = riesgosModel::select('CVE_RIESGO','DESC_RIESGO','GRADO_IMPACTO_2','ESCALA_VALOR_2')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('GRADO_IMPACTO_2','>',0)
            ->where('ESCALA_VALOR_2','>',0)
            ->orderBy('CVE_RIESGO','ASC')->paginate(5);
        return view('sicinar.administracionderiesgos.mapa.enlistarMapas',compact('usuario','nombre','estructura','id_estructura','rango','riesgos'));
    }

    public function actionVerMapa($id){
        //dd('OC mapa de riesgo');
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
        $riesgo = riesgosModel::select('CVE_RIESGO','DESC_RIESGO','GRADO_IMPACTO_2','ESCALA_VALOR_2')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->where('CVE_RIESGO','=',$id)
            ->where('GRADO_IMPACTO_2','>',0)
            ->where('ESCALA_VALOR_2','>',0)
            ->orderBy('CVE_RIESGO','ASC')->first();
        //dd($riesgo);
        return view('sicinar.administracionderiesgos.mapa.verMapa',compact('usuario','nombre','estructura','id_estructura','rango','riesgo'));
    }

    //OBTENER FACTORES V. ESTRATEGIAS PARA EVITAR EL RIESGO (QUE NO TIENEN ACCIONES DE MEJORA)
    public function actionFactores($id){
        return (response()->json(
            factores_riesgoModel::join('SCI_ESTRATEGIAS_YACCIONES','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','<>','SCI_ESTRATEGIAS_YACCIONES.NUM_FACTOR_RIESGO','right outer')
                ->select('SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','SCI_FACTORES_RIESGO.DESC_FACTOR_RIESGO')
                ->where('SCI_FACTORES_RIESGO.N_PERIODO',(int)date('Y'))
                ->where('SCI_FACTORES_RIESGO.ESTRUCGOB_ID','LIKE','21500%')
                ->where('SCI_FACTORES_RIESGO.CVE_RIESGO','=',$id)
                ->orderBy('SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','ASC')
                ->get()
        ));
    }

    //NUEVO V. ESTRATEGIAS PARA EVITAR EL RIESGO
    public function actionNuevaEstrategia(){
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
        $riesgos = riesgosModel::select('CVE_RIESGO','DESC_RIESGO')
            ->where('N_PERIODO',(int)date('Y'))
            ->where('ESTRUCGOB_ID','LIKE','21500%')
            ->orderBy('CVE_RIESGO','ASC')->get();
        $estrategias = admon_riesgosModel::select('CVE_ADMON_RIESGO','DESC_ADMON_RIESGO')
            ->orderBy('CVE_ADMON_RIESGO','ASC')->get();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON')
            ->orderBy('UNID_ADMON','ASC')
            ->orderBy('PATERNO','ASC')
            ->get();
        return view('sicinar.administracionderiesgos.estrategias.nuevaEstrategia',compact('nombre','usuario','estructura','rango','id_estructura','riesgos','estrategias','servidores'));
    }

    //ALTA V. ESTRATEGIAS PARA EVITAR EL RIESGO
    public function actionAltaEstrategia(estrategiasRequest $request){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');
        $riesgo= riesgosModel::where('CVE_RIESGO','=',$request->riesgo)->first();
        $id_estrategia = estrategias_accionesModel::max('CVE_ACCION');
        $nuevaEstrategia = new estrategias_accionesModel();
        $nuevaEstrategia->N_PERIODO = date('Y');
        $nuevaEstrategia->ESTRUCGOB_ID = $riesgo->estrucgob_id;
        $nuevaEstrategia->CVE_DEPENDENCIA = $riesgo->cve_dependencia;
        $nuevaEstrategia->CVE_RIESGO = $request->riesgo;
        $nuevaEstrategia->NUM_FACTOR_RIESGO = $request->factor;
        $nuevaEstrategia->CVE_ADMON_RIESGO = $request->estrategia;
        $nuevaEstrategia->CVE_ACCION = $id_estrategia+1;
        $nuevaEstrategia->DESC_ACCION = strtoupper($request->descripcion);
        $nuevaEstrategia->ID_SP = $request->sp;
        $nuevaEstrategia->STATUS_1 = 'S';
        $nuevaEstrategia->STATUS_2 = '0';
        $nuevaEstrategia->FECHA_REG = date('Y/m/d');
        $nuevaEstrategia->USU = $usuario;
        $nuevaEstrategia->IP = $ip;
        $nuevaEstrategia->FECHA_M = date('Y/m/d');
        $nuevaEstrategia->USU_M = $usuario;
        $nuevaEstrategia->IP_M = $ip;
        if($nuevaEstrategia->save() == true){
            toastr()->success('La Estrategia ha sido dado de alta correctamente.','Nueva Estrategia!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('verEstrategias');
        }else{
            toastr()->error('Ha ocurrido un error al dar de alta la Estrategia.','Ups!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevaEstrategia');
        }

    }

    //VER V. ESTRATEGIAS PARA EVITAR EL RIESGO
    public function actionVerEstrategias(){
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
        $estrategias = estrategias_accionesModel::join('SCI_RIESGOS','SCI_ESTRATEGIAS_YACCIONES.CVE_RIESGO','=','SCI_RIESGOS.CVE_RIESGO')
            ->join('SCI_FACTORES_RIESGO','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','=','SCI_ESTRATEGIAS_YACCIONES.NUM_FACTOR_RIESGO')
            ->join('SCI_ADMON_RIESGOS','SCI_ADMON_RIESGOS.CVE_ADMON_RIESGO','=','SCI_ESTRATEGIAS_YACCIONES.CVE_ADMON_RIESGO')
            ->select('SCI_RIESGOS.CVE_RIESGO','SCI_RIESGOS.DESC_RIESGO','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','SCI_FACTORES_RIESGO.DESC_FACTOR_RIESGO','SCI_ADMON_RIESGOS.DESC_ADMON_RIESGO','SCI_ESTRATEGIAS_YACCIONES.CVE_ACCION','SCI_ESTRATEGIAS_YACCIONES.DESC_ACCION','SCI_ESTRATEGIAS_YACCIONES.STATUS_1','SCI_ESTRATEGIAS_YACCIONES.STATUS_2')
            ->where('SCI_ESTRATEGIAS_YACCIONES.N_PERIODO',(int)date('Y'))
            ->orderBy('SCI_ESTRATEGIAS_YACCIONES.CVE_RIESGO','ASC')
            ->orderBy('SCI_ESTRATEGIAS_YACCIONES.NUM_FACTOR_RIESGO','ASC')
            ->paginate(5);
        if($estrategias->count()<=0){
            toastr()->error('No haz dado de alta ninguna estrategia.','Ups!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('nuevaEstrategia');
        }
        return view('sicinar.administracionderiesgos.estrategias.verEstrategia',compact('nombre','usuario','estructura','rango','id_estructura','estrategias'));
    }

    //ACTIVAR V. ESTRATEGIAS PARA EVITAR EL RIESGO
    public function actionActivarEstrategia($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $estrategia = estrategias_accionesModel::where('CVE_ACCION',$id)->update(['STATUS_1' => 'S']);
        return redirect()->route('verEstrategias');
    }

    //DESACTIVAR V. ESTRATEGIAS PARA EVITAR EL RIESGO
    public function actionDesactivarEstrategia($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $estrategia = estrategias_accionesModel::where('CVE_ACCION',$id)->update(['STATUS_1' => 'N']);
        return redirect()->route('verEstrategias');
    }

    //CONCLUIR V. ESTRATEGIAS PARA EVITAR EL RIESGO
    public function actionConcluirEstrategia($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $estrategia = estrategias_accionesModel::where('CVE_ACCION',$id)->update(['STATUS_2' => '1']);
        return redirect()->route('verEstrategias');
    }

    //PENDIENTE V. ESTRATEGIAS PARA EVITAR EL RIESGO
    public function actionPendienteEstrategia($id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $estrategia = estrategias_accionesModel::where('CVE_ACCION',$id)->update(['STATUS_2' => '0']);
        return redirect()->route('verEstrategias');
    }

    //EDITAR V. ESTRATEGIAS PARA EVITAR EL RIESGO
    public function actionEditarEstrategia($id){
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
        $estrateg = estrategias_accionesModel::join('SCI_RIESGOS','SCI_ESTRATEGIAS_YACCIONES.CVE_RIESGO','=','SCI_RIESGOS.CVE_RIESGO')
            ->join('SCI_FACTORES_RIESGO','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','=','SCI_ESTRATEGIAS_YACCIONES.NUM_FACTOR_RIESGO')
            ->join('SCI_ADMON_RIESGOS','SCI_ADMON_RIESGOS.CVE_ADMON_RIESGO','=','SCI_ESTRATEGIAS_YACCIONES.CVE_ACCION')
            ->select('SCI_RIESGOS.CVE_RIESGO','SCI_RIESGOS.DESC_RIESGO','SCI_FACTORES_RIESGO.NUM_FACTOR_RIESGO','SCI_FACTORES_RIESGO.DESC_FACTOR_RIESGO','SCI_ADMON_RIESGOS.DESC_ADMON_RIESGO','SCI_ESTRATEGIAS_YACCIONES.CVE_ADMON_RIESGO','SCI_ESTRATEGIAS_YACCIONES.CVE_ACCION','SCI_ESTRATEGIAS_YACCIONES.DESC_ACCION','SCI_ESTRATEGIAS_YACCIONES.ID_SP')
            ->where('SCI_ESTRATEGIAS_YACCIONES.N_PERIODO',(int)date('Y'))
            ->where('SCI_ESTRATEGIAS_YACCIONES.CVE_ACCION','=',$id)
            ->orderBy('SCI_ESTRATEGIAS_YACCIONES.CVE_RIESGO','ASC')
            ->orderBy('SCI_ESTRATEGIAS_YACCIONES.NUM_FACTOR_RIESGO','ASC')
            ->first();
        $estrategias = admon_riesgosModel::select('CVE_ADMON_RIESGO','DESC_ADMON_RIESGO')
            ->orderBy('CVE_ADMON_RIESGO','ASC')->get();
        $servidores = servidorespubModel::select('ID_SP','NOMBRES','PATERNO','MATERNO','UNID_ADMON')
            ->orderBy('UNID_ADMON','ASC')
            ->orderBy('PATERNO','ASC')
            ->get();
        return view('sicinar.administracionderiesgos.estrategias.editarEstrategia',compact('nombre','usuario','estructura','id_estructura','rango','estrateg','estrategias','servidores'));
    }

    public function actionActualizarEstrategia(editarEstrategiaRequest $request, $id){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $ip = session()->get('ip');
        $actualizarEstrategia = estrategias_accionesModel::where('CVE_ACCION',$id)
            ->update([
                'CVE_ADMON_RIESGO' => $request->estrategia,
                'DESC_ACCION' => strtoupper($request->descripcion),
                'ID_SP' => $request->sp,
                'FECHA_M' => date('Y/m/d'),
                'USU_M' => $usuario,
                'IP_M' => $ip
            ]);
        toastr()->success('La Estrategia ha sido dado de actualizada correctamente.','Estrategia Actualizada!',['positionClass' => 'toast-bottom-right']);
        return redirect()->route('verEstrategias');    }
}
