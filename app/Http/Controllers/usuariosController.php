<?php

namespace App\Http\Controllers;

use App\Http\Requests\usuarioRequest;
use Illuminate\Http\Request;
use App\usuarioModel;
use App\estructurasModel;
use App\dependenciasModel;

class usuariosController extends Controller
{
    public function actionLogin(usuarioRequest $request){
    	//dd($request->all());
        $existe = usuarioModel::select('TIPO_USUARIO','ESTRUCGOB_ID','CVE_DEPENDENCIA','STATUS_1')->where('LOGIN','like','%'.$request->usuario.'%')->where('PASSWORD','like','%'.$request->password.'%')->get();
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
    		return back()->withInput()->withErrors(['LOGIN' => 'Usuario no esta dado de alta.']);
    	}
    }

    public function actionCerrarSesion(){
        session()->forget('userlog','passlog','usuario','estructura','ip','rango','id_estructura');
        return view('sicinar.login.loginInicio');
    }

    public function actionExpirada(){
    	return view('sicinar.login.expirada');
    }
}
