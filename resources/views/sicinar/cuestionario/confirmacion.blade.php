@extends('sicinar.principal')

@section('title','Continuar?')

@section('nombre')
{{$nombre}}
@endsection

@section('usuario')
{{$usuario}}
@endsection

@section('estructura')
{{$estructura}}
@endsection

@section('content')
  <div class="content-wrapper" id="principal">
    <section class="content-header">
      <h1>
        Cédula de Evaluación en materia de Control Interno<br>con base en el Manual Administrativo de Aplicación General
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
        <li><a href="#">Cuestionario</a></li>
        <li class="active">Cédula de Evaluación</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-6">

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Deseas confirmar con la Evaluación del Proceso?</b></h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-12">
                  <b style="color:red;">¡Importante!</b><br>
                Si estás seguro de que tu información es correcta, presiona el botón "Confirmar".<br>
                Si no estás seguro de que tu información es correcta, presiona el botón "Verificar".
                </div>
              </div>
            <div class="margin">
              <div class="btn-group">
                <div class="col-md-6">
                  <a href="{{ route('confirmado') }}" class="btn btn-success"><span>Confirmar </span><i class="fa fa-check"></i></a>
                </div>
                <div class="col-md-6">
                  <a href="{{ route('verificar',$max) }}" class="btn btn-info"><span>Verificar </span><i class="fa fa-share"></i></a>
                </div>
                <br>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('request')
@endsection

@section('javascrpt')
@endsection