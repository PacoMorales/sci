<?php

namespace App\Http\Controllers;

use App\Http\Requests\usuarioRequest;
use App\Http\Requests\altaUsuarioRequest;
use Illuminate\Http\Request;
use App\usuarioModel;
use App\estructurasModel;
use App\dependenciasModel;

class usuariosController extends Controller
{
    public function actionLogin(usuarioRequest $request){
    	//dd($request->all());
        $existe = usuarioModel::select('LOGIN','PASSWORD','TIPO_USUARIO','ESTRUCGOB_ID','CVE_DEPENDENCIA','STATUS_1')
            ->where('LOGIN','like','%'.$request->usuario.'%')
            ->where('PASSWORD','like','%'.$request->password.'%')
            ->where('STATUS_2',1)
            ->get();
    	//dd($existe);
        if($existe->count()>=1){
            //dd('Entra if.');
    	    if(strcmp($existe[0]->login,$request->usuario) == 0){
    	        if(strcmp($existe[0]->password,$request->password) == 0){
                    //dd('Entro.');
                }else{
                    return back()->withInput()->withErrors(['PASSWORD' => 'Contraseña incorrecta.']);
                }
            }else{
                return back()->withInput()->withErrors(['LOGIN' => 'Usuario -'.$request->usuario.'- incorrecto.']);
            }
        }
        if($existe->count()>=1){
    		$estruc = estructurasModel::ObtEstruc($existe[0]->estrucgob_id);
    		if($existe[0]->status_1 == '4'){  //DIOS
    			$usuario = "Administrador";
    			$estructura = "Particular";
                $id_estructura = $existe[0]->estrucgob_id;
                $dependencia = $existe[0]->cve_dependencia;
                $nombre_dependencia = "Particular";
    		}else{
                if($existe[0]->status_1 == '3'){ //ADMINISTRADOR
                    $usuario = "General";
                    $estructura = "Particular";
                    $id_estructura = $existe[0]->estrucgob_id;
                    $dependencia = $existe[0]->cve_dependencia;
                    $nombre_dependencia = "Particular";
                }else{
                    if($existe[0]->status_1 == '2'){ //SECRETARIAS
                        $usuario = "Particular";
                        $estructura = $estruc[0]->estrucgob_desc;
                        $id_estructura = $existe[0]->estrucgob_id;
                        $dependencia = $existe[0]->cve_dependencia;
                        $nombre_dependencia = "Particular";
                    }else{
                        if($existe[0]->status_1 == '1'){ //UNIDADES ADMINISTRATIVAS
                            $usuario = "Operativo";
                            $estructura = $estruc[0]->estrucgob_desc;
                            $id_estructura = $existe[0]->estrucgob_id;
                            $dependencia = $existe[0]->cve_dependencia;
                            $dep = dependenciasModel::select('DEPEN_DESC')->where('ESTRUCGOB_ID','like',$existe[0]->estrucgob_id.'%')->where('DEPEN_ID','like',$existe[0]->cve_dependencia.'%')->get();
                            if($dep->count()<1){
                                $dependencia = $existe[0]->cve_dependencia;
                            }else{
                                $nombre_dependencia = $dep[0]->depen_desc;
                            }
                        }else{
                            return back()->withInput()->withErrors(['LOGIN' => 'Usuario o password incorrecto.']);
                        }
                    }
                }
    		}
    		$nombre = $request->usuario;
            $rango = $existe[0]->status_1;
    		if (getenv('HTTP_CLIENT_IP')) {
              $ip = getenv('HTTP_CLIENT_IP');
            } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
              $ip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_X_FORWARDED')) {
              $ip = getenv('HTTP_X_FORWARDED');
            } elseif (getenv('HTTP_FORWARDED_FOR')) {
              $ip = getenv('HTTP_FORWARDED_FOR');
            } elseif (getenv('HTTP_FORWARDED')) {
              $ip = getenv('HTTP_FORWARDED');
            } else {
              $ip = $_SERVER['REMOTE_ADDR'];
            }
    		session(['userlog' => $request->usuario,'passlog' => $request->password,'usuario' => $usuario,'estructura' => $estructura, 'ip' => $ip, 'rango' => $rango, 'id_estructura' => $id_estructura, 'dependencia' => $dependencia,'nombre_dependencia'=>$nombre_dependencia]);
            //dd('Usuario: '.$usuario.' - Rango: '.$rango.' - Estructura: '.$estructura.'- Dependencia: '.$dependencia.' - Nombre dependencia: '.$nombre_dependencia);
    		toastr()->info($nombre,'Bienvenido ');
    		return view('sicinar.menu.menuInicio',compact('usuario','nombre','estructura','rango'));
    	}else{
    		return back()->withInput()->withErrors(['LOGIN' => 'El usuario no esta dado de alta.']);
    	}
    }

    public function actionCerrarSesion(){
        session()->forget('userlog');
        session()->forget('passlog');
        session()->forget('usuario','estructura','ip','rango','id_estructura','plan_id');
        //session()->forget('userlog','passlog','usuario','estructura','ip','rango','id_estructura','plan_id');
        //REGRESA AL LOGIN PRINCIPAL
        //return view('sicinar.login.terminada');
        return view('sicinar.login.loginInicio');
    }

    public function actionExpirada(){
    	return view('sicinar.login.expirada');
    }

    public function actionBackOffice(){
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        //$id_estruc = session()->get('id_estructura');
        //$id_estructura = rtrim($id_estruc," ");
        $rango = session()->get('rango');
        //$ip = session()->get('ip');
        $dependencias = dependenciasModel::select('DEPEN_ID','DEPEN_DESC')
            ->where('ESTRUCGOB_ID','like','%21500%')
            ->where('CLASIFICGOB_ID','=',1)
            ->get();
        return view('sicinar.BackOffice.administracionUsuarios',compact('nombre','usuario','estructura','rango','dependencias'));
    }

    public function actionAltaUsuario(altaUsuarioRequest $request){
        //dd($request->all());
        $nombre = session()->get('userlog');
        $pass = session()->get('passlog');
        if($nombre == NULL AND $pass == NULL){
            return view('sicinar.login.expirada');
        }
        $usuario = session()->get('usuario');
        $estructura = session()->get('estructura');
        //$id_estruc = session()->get('id_estructura');
        //$id_estructura = rtrim($id_estruc," ");
        $rango = session()->get('rango');
        $ip = session()->get('ip');

        if($request->perfil == '1' AND $request->unidad == '0'){
            return back()->withErrors(['unidad' => 'No puedes elegir la Unidad Administrativa: ADMINISTRADOR si tiene rol OPERATIVO.']);
        }
        dd($request->all());
        $folio = usuarioModel::max('FOLIO');
        $nuevoUsuario = new usuarioModel();
        $nuevoUsuario->N_PERIODO = date('Y');
        $nuevoUsuario->FOLIO = $folio+1;
        $nuevoUsuario->ESTRUCGOB_ID = '21500';
        $nuevoUsuario->CVE_DEPENDENCIA = $request->unidad;
        $nuevoUsuario->LOGIN = $request->usuario;
        $nuevoUsuario->PASSWORD = $request->password;
        $nuevoUsuario->AP_PATERNO = strtoupper($request->paterno);
        $nuevoUsuario->AP_MATERNO = strtoupper($request->materno);
        $nuevoUsuario->NOMBRE = strtoupper($request->nombre);
        $nuevoUsuario->NOMBRE_COMPLETO = strtoupper($request->nombre.' '.$request->paterno.' '.$request->materno);
        if($request->perfil == '1')
            $nuevoUsuario->TIPO_USUARIO = 'PG';
        else
            if($request->perfil == '2')
                $nuevoUsuario->TIPO_USUARIO = 'GN';
            else
                $nuevoUsuario->TIPO_USUARIO = 'AD';
        $nuevoUsuario->STATUS_1 = $request->perfil;
        $nuevoUsuario->STATUS_2 = 1;
        $nuevoUsuario->IP = $ip;
        $nuevoUsuario->FECHA_REGISTRO = date('Y/m/d');
        if($nuevoUsuario->save() == true){
            toastr()->success('El Usuario ha sido creado correctamente.','Ok!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('altaUsuario');
        }else{
            toastr()->error('El Usuario no ha sido creado.','Ha ocurrido algo inesperado!',['positionClass' => 'toast-bottom-right']);
            return redirect()->route('altaUsuario');
        }

    }

    public function actionVerUsuario(){

    }
}
