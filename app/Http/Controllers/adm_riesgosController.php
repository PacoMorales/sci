<?php

namespace App\Http\Controllers;

use App\Http\Requests\riesgosRequest;
use App\dependenciasModel;
use App\servidorespubModel;
use App\progtrabModel;
use PDF;
use App\clase_riesgoModel;
use App\nivel_riesgoModel;
use App\clasificacion_riesgoModel;
use App\prob_ocurModel;
use App\gradoimpactoModel;
use App\riesgosModel;

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

    //NUEVO APARTADO I
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

    //ALTA APARTADO I
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

    //EDITAR APARTADO I
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

    //ACTUALIZAR APARTADO I
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
}
