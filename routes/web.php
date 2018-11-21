<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('sicinar.login.loginInicio');
});

Route::group(['prefix' => 'control-interno'], function(){
	Route::post('menu','usuariosController@actionLogin')->name('login');
	Route::get('status-sesion/expirada','usuariosController@actionExpirada')->name('expirada');
	Route::get('status-sesion/terminada','usuariosController@actionCerrarSesion')->name('terminada');
	
	Route::get('cuestionario/inicio','cuestionarioController@actionCuestionario')->name('cuestionario');
	Route::get('cuestionario/confirmacion','cuestionarioController@Val')->name('confirmacion');
	Route::get('cuestionario/confirmado','cuestionarioController@actionConfirmado')->name('confirmado');
	Route::get('cuestionario/verificar/{id}','cuestionarioController@actionVerificar')->name('verificar');
	Route::put('cuestionario/verificar/{id}','cuestionarioController@actionVerificando')->name('verificando');
	Route::get('listado/evidencias','cuestionarioController@actionListaEvidencias')->name('evidencias');
	Route::post('cuestionario/nuevo','cuestionarioController@actionAltaCuestionario')->name('altaCuestionario');
	
	Route::get('procesos/nuevo','procesosController@actionVerAltaProcesos')->name('nuevoProceso');
	Route::post('procesos/nuevo/alta','procesosController@actionAltaProcesos')->name('altaProceso');
	Route::get('procesos/unidades/{id}','procesosController@actionUnidades')->name('unidades');
	Route::get('cuestionario/unidades/{id}','procesosController@actionUnidades');
	Route::get('procesos/ver/todos','procesosController@actionVerProcesos')->name('verProcesos');
	Route::get('procesos/ver/todos/evaluaciones','procesosController@actionEvalProcesos')->name('evalProcesos');

	Route::get('downloadExcel','procesosController@export')->name('download');
	Route::get('generarPDF/{id}','procesosController@generarPDF')->name('generarpdf');
    Route::get('ver/pdf/{id}','procesosController@verPDF')->name('Verpdf');
});

