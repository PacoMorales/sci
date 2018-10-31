@extends('sicinar.principal')

@section('title','Listado de Evidencias')

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
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Listado de Evidencias Sugeridas<br>
        <small> para sustentar la aplicación de los elementos de control interno</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
        <li><a href="#">Evidencias</a></li>
        <li class="active">Ver Evidencias</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Evidencias</h3>
            </div>
            <div class="box-body">
              <table id="tabla1" class="table table-striped table-bordered table-sm">
                <thead style="color: brown;" class="justify">
                  <tr>
                    <th>Número de Identificación</th>
                    <th>Nombre de la Evidencia</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($evidencias as $evidencia)
                    <tr>
                      <td>{{$evidencia->cve_evidencia}}</td>
                      <td>{{$evidencia->desc_evidencia}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
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