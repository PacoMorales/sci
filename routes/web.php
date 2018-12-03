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

Route::group(['prefix' => 'control-interno'], function() {
    Route::post('menu', 'usuariosController@actionLogin')->name('login');
    Route::get('status-sesion/expirada', 'usuariosController@actionExpirada')->name('expirada');
    Route::get('status-sesion/terminada', 'usuariosController@actionCerrarSesion')->name('terminada');

    Route::get('cedula-evaluacion/inicio', 'cuestionarioController@actionCuestionario')->name('cuestionario');
    Route::get('cedula-evaluacion/confirmacion', 'cuestionarioController@Val')->name('confirmacion');
    Route::get('cedula-evaluacion/confirmado', 'cuestionarioController@actionConfirmado')->name('confirmado');
    Route::get('cedula-evaluacion/verificar/{id}', 'cuestionarioController@actionVerificar')->name('verificar');
    Route::put('cedula-evaluacion/verificar/{id}', 'cuestionarioController@actionVerificando')->name('verificando');
    Route::get('listado/evidencias', 'cuestionarioController@actionListaEvidencias')->name('evidencias');
    Route::get('/evidencias', 'cuestionarioController@actionListaEvidencias')->name('evidencias');
    Route::post('cedula-evaluacion/nuevo', 'cuestionarioController@actionAltaCuestionario')->name('altaCuestionario');
    Route::get('cedula-evaluacion/editar', 'cuestionarioController@actionEditar')->name('evalEditar');
    //EDICION NORMA 1
    Route::get('cedula-evaluacion/{id}/editar/cedula-evaluacion/N1', 'cuestionarioController@actionObtenerEvaluacionN1')->name('EditarN1');
    Route::put('cedula-evaluacion/{id}/guardar/cedula-evaluacion/N1', 'cuestionarioController@actionGuardarEvaluacionN1')->name('ActualizarN1');
    //EDICION NORMA 2
    Route::get('cedula-evaluacion/{id}/editar/cedula-evaluacion/N2', 'cuestionarioController@actionObtenerEvaluacionN2')->name('EditarN2');
    Route::put('cedula-evaluacion/{id}/guardar/cedula-evaluacion/N2', 'cuestionarioController@actionGuardarEvaluacionN2')->name('ActualizarN2');
    //EDICION NORMA 3
    Route::get('cedula-evaluacion/{id}/editar/cedula-evaluacion/N3', 'cuestionarioController@actionObtenerEvaluacionN3')->name('EditarN3');
    Route::put('cedula-evaluacion/{id}/guardar/cedula-evaluacion/N3', 'cuestionarioController@actionGuardarEvaluacionN3')->name('ActualizarN3');
    //EDICION NORMA 3
    Route::get('cedula-evaluacion/{id}/editar/cedula-evaluacion/N4', 'cuestionarioController@actionObtenerEvaluacionN4')->name('EditarN4');
    Route::put('cedula-evaluacion/{id}/guardar/cedula-evaluacion/N4', 'cuestionarioController@actionGuardarEvaluacionN4')->name('ActualizarN4');
    //EDICION NORMA 3
    Route::get('cedula-evaluacion/{id}/editar/cedula-evaluacion/N5', 'cuestionarioController@actionObtenerEvaluacionN5')->name('EditarN5');
    Route::put('cedula-evaluacion/{id}/guardar/cedula-evaluacion/N5', 'cuestionarioController@actionGuardarEvaluacionN5')->name('ActualizarN5');
    //PROCESOS
	Route::get('procesos/nuevo','procesosController@actionVerAltaProcesos')->name('nuevoProceso');
	Route::post('procesos/nuevo/alta','procesosController@actionAltaProcesos')->name('altaProceso');
	Route::get('procesos/unidades/{id}','procesosController@actionUnidades')->name('unidades');
	Route::get('cuestionario/unidades/{id}','procesosController@actionUnidades');
    Route::get('procesos/ver/graficas','procesosController@Graficas')->name('verGraficas');
	Route::get('procesos/ver/todos','procesosController@actionVerProcesos')->name('verProcesos');
    Route::get('procesos/ver/sustantivos','procesosController@actionVerProcesosSustantivos')->name('verProcesosSust');
    Route::get('procesos/ver/administrativos','procesosController@actionVerProcesosAdministrativos')->name('verProcesosAdmin');
    Route::get('procesos/ver/institucionales','procesosController@actionVerProcesosInstitucionales')->name('verProcesosInst');
	Route::get('procesos/ver/todos/evaluaciones','procesosController@actionEvalProcesos')->name('evalProcesos');
    Route::get('procesos/gestion','procesosController@actionGestionProcesos')->name('procesosGestion');
    Route::get('procesos/gestion/administrativo','procesosController@actionGestionProcesosAdm')->name('procesosGestionAdm');
    Route::get('procesos/gestion/institucional','procesosController@actionGestionProcesosInst')->name('procesosGestionInst');
    Route::get('procesos/gestion/sustantivo','procesosController@actionGestionProcesosSust')->name('procesosGestionSust');
    Route::get('procesos/gestion/ver/{id}/informacion-general','procesosController@actionVerInfo')->name('procesoVerInfo');
    Route::get('procesos/gestion/unidades/administrativas','procesosController@actionGestionUnidad')->name('Gestunidades');
    Route::get('procesos/gestion/unidad/administrativa','procesosController@actionInfoUnidad')->name('unidadesInfo');
    Route::get('procesos/gestion/todos/{id}/activar','procesosController@actionActivarProcesos')->name('procesosGestionAct');
    Route::get('procesos/gestion/todos/{id}/desactivar','procesosController@actionDesactivarProcesos')->name('procesosGestionDes');
    Route::get('procesos/gestion/adm/{id}/activar','procesosController@actionActivarProcesosAdm')->name('procesosGestionActAdm');
    Route::get('procesos/gestion/adm/{id}/desactivar','procesosController@actionDesactivarProcesosAdm')->name('procesosGestionDesAdm');
    Route::get('procesos/gestion/inst/{id}/activar','procesosController@actionActivarProcesosInst')->name('procesosGestionActInst');
    Route::get('procesos/gestion/inst/{id}/desactivar','procesosController@actionDesactivarProcesosInst')->name('procesosGestionDesInst');
    Route::get('procesos/gestion/sust/{id}/activar','procesosController@actionActivarProcesosSust')->name('procesosGestionActSust');
    Route::get('procesos/gestion/sust/{id}/desactivar','procesosController@actionDesactivarProcesosSust')->name('procesosGestionDesSust');

	Route::get('downloadExcel','procesosController@export')->name('download');
    Route::get('ver/pdf/{id}','procesosController@verPDF')->name('Verpdf');
    //PLAN DE TRABAJO
    Route::get('plan-de-trabajo/nuevo','estrategiasController@actionNuevoPlan')->name('nuevoPlan');
    Route::post('plan-de-trabajo/nuevo/alta','estrategiasController@actionAltaNuevoPlan')->name('AltaNuevoPlan');
    Route::get('plan-de-trabajo/ver/todos','estrategiasController@actionVerPlan')->name('verPlan');
    Route::get('plan-de-trabajo/{id}/marcar/activo','estrategiasController@actionActivarPlan')->name('activarPlan');
    Route::get('plan-de-trabajo/{id}/marcar/inhactivo','estrategiasController@actionDesactivarPlan')->name('desactivarPlan');
    Route::get('plan-de-trabajo/{id}/marcar/pendiente','estrategiasController@actionPlanPendiente')->name('planPendiente');
    Route::get('plan-de-trabajo/{id}/marcar/concluido','estrategiasController@actionPlanConcluido')->name('planConcluido');
    Route::get('plan-de-trabajo/{id}/editar/plan-de-trabajo','estrategiasController@actionEditarPlan')->name('editarPlan');
    Route::get('plan-de-trabajo/{id}/editar/plan-de-trabajo/accion-de-mejora','estrategiasController@actionEditarAccion')->name('editarAccion');
    Route::put('plan-de-trabajo/{id}/editar/plan-de-trabajo/nueva/accion-de-mejora','estrategiasController@actionAltaAccion')->name('altaAccion');
    Route::get('plan-de-trabajo/{id}/ver/pdf','estrategiasController@actionVerPDF')->name('planPDF');
});

