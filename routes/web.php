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
    //ADMINISTRACIÓN DE RIEGOS
    Route::get('admin-de-riesgos/inicio','adm_riesgosController@actionVerRiesgo')->name('verRiesgos');
    Route::get('admin-de-riesgos/{id}/activar/riesgo','adm_riesgosController@activarRiesgo')->name('activarRiesgo');
    Route::get('admin-de-riesgos/{id}/desactivar/riesgo','adm_riesgosController@desactivarRiesgo')->name('desactivarRiesgo');
    Route::get('admin-de-riesgos/{id}/controlar/riesgo','adm_riesgosController@controlarRiesgo')->name('controlarRiesgo');
    Route::get('admin-de-riesgos/{id}/descontrolar/riesgo','adm_riesgosController@descontrolarRiesgo')->name('descontrolarRiesgo');
    // I. EVALUACIÓN DE RIESGOS
    Route::get('admin-de-riesgos/nuevo','adm_riesgosController@actionNuevoRiesgo')->name('nuevoRiesgo');
    Route::post('admin-de-riesgos/nuevo/alta','adm_riesgosController@actionAltaRiesgo')->name('altaRiesgo');
    Route::get('admin-de-riesgos/{id}/editar-I/riesgo','adm_riesgosController@editarRiesgo')->name('editarRiesgo');
    Route::put('admin-de-riesgos/{id}/actualizar-I/riesgo','adm_riesgosController@actualizarRiesgoI')->name('actualizarRiesgoI');
    // FACTORES DE EVALUACION DE RIESGOS
    Route::get('admin-de-riesgos/{id}/nuevo/factor-de-riesgo','adm_riesgosController@actionNuevoFactor')->name('nuevoFactor');
    Route::post('admin-de-riesgos/alta/nuevo/factor-de-riesgo','adm_riesgosController@actionAltaFactor')->name('altaFactor');
    Route::get('admin-de-riesgos/{id}/ver/factor-de-riesgo','adm_riesgosController@actionVerFactor')->name('verFactor');
    Route::get('admin-de-riesgos/{id}/editar/factor-de-riesgo','adm_riesgosController@actionEditarFactor')->name('editarFactor');
    Route::put('admin-de-riesgos/{id}/actualizar/factor-de-riesgo','adm_riesgosController@actionActualizarFactor')->name('actualizarFactor');
    // II. EVALUACIÓN DE CONTROLES
    Route::get('admin-de-riesgos/nuevo/control','adm_riesgosController@actionNuevoControl')->name('nuevoControl');
    Route::post('admin-de-riesgos/alta/nuevo/control','adm_riesgosController@actionAltaControl')->name('altaControl');
    Route::get('factores/{id}','adm_riesgosController@actionObtFactores')->name('factores');
    Route::get('admin-de-riesgos/ver/todos/controles','adm_riesgosController@actionVerControl')->name('verControl');
    Route::get('admin-de-riesgos/editar/control/{id}','adm_riesgosController@actionEditarControl')->name('editarControl');
    Route::put('admin-de-riesgos/actualizar/control/{id}','adm_riesgosController@actionActualizarControl')->name('actualizarControl');
    Route::get('admin-de-riesgos/activar/control/{id}','adm_riesgosController@activarControl')->name('activarControl');
    Route::get('admin-de-riesgos/desactivar/control/{id}','adm_riesgosController@desactivarControl')->name('desactivarControl');
    Route::get('admin-de-riesgos/activar/documentado/{id}','adm_riesgosController@activarDocumentado')->name('activarDocumentado');
    Route::get('admin-de-riesgos/desactivar/documentado/{id}','adm_riesgosController@desactivarDocumentado')->name('desactivarDocumentado');
    Route::get('admin-de-riesgos/activar/formalizado/{id}','adm_riesgosController@activarFormalizado')->name('activarFormalizado');
    Route::get('admin-de-riesgos/desactivar/formalizado/{id}','adm_riesgosController@desactivarFormalizado')->name('desactivarFormalizado');
    Route::get('admin-de-riesgos/activar/aplica/{id}','adm_riesgosController@activarAplica')->name('activarAplica');
    Route::get('admin-de-riesgos/desactivar/aplica/{id}','adm_riesgosController@desactivarAplica')->name('desactivarAplica');
    Route::get('admin-de-riesgos/activar/efectivo/{id}','adm_riesgosController@activarEfectivo')->name('activarEfectivo');
    Route::get('admin-de-riesgos/desactivar/efectivo/{id}','adm_riesgosController@desactivarEfectivo')->name('desactivarEfectivo');
});

