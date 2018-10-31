<?php

namespace App\Http\Controllers;

use App\Http\Requests\usuarioRequest;
use Illuminate\Http\Request;
use App\usuarioModel;
use App\estructurasModel;

class usuariosController extends Controller
{
    public function actionLogin(usuarioRequest $request){
    	//dd($request->all());
        $existe = usuarioModel::select('TIPO_USUARIO','ESTRUCGOB_ID','STATUS_1')->where('LOGIN','like','%'.$request->usuario.'%')->where('PASSWORD','like','%'.$request->password.'%')->get();
    	if($existe->count()>=1){
    		$estruc = estructurasModel::ObtEstruc($existe[0]->estrucgob_id);
    		if($existe[0]->status_1 == '3'){
    			$usuario = "Administrador";
    			$estructura = "Particular";
                $id_estructura = $existe[0]->estrucgob_id;
    		}else{
                if($existe[0]->status_1 == '2'){
                    $usuario = "General";
                    $estructura = $estruc[0]->estrucgob_desc;
                    $id_estructura = $existe[0]->estrucgob_id;
                }else{
                    if($existe[0]->status_1 == '1'){
                        $usuario = "Particular";
                        $estructura = $estruc[0]->estrucgob_desc;
                        $id_estructura = $existe[0]->estrucgob_id;
                    }else{
                        return back()->withInput()->withErrors(['LOGIN' => 'Usuario o password incorrecto.']);
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
    		session(['userlog' => $request->usuario,'passlog' => $request->password,'usuario' => $usuario,'estructura' => $estructura, 'ip' => $ip, 'rango' => $rango, 'id_estructura' => $id_estructura]);
    		toastr()->info($nombre,'Bienvenido ');
    		return view('sicinar.menu.menuInicio',compact('usuario','nombre','estructura','rango'));
    	}else{
    		return back()->withInput()->withErrors(['LOGIN' => 'Usuario no esta dado de alta.']);
    	}
    }

    public function actionCerrarSesion(){
        session()->forget('userlog','passlog','usuario','estructura','ip','rango','id_estructura');
        return view('sicinar.login.terminada');
    }

    public function actionExpirada(){
    	return view('sicinar.login.expirada');
    }
}
