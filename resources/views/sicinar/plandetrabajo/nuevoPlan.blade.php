@extends('sicinar.principal')

@section('title','Nuevo Plan de Trabajo')

@section('links')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

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
                Plan de Trabajo
                <small>Generar nuevo</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Plan de Trabajo</a></li>
                <li class="active">Nuevo</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Generar un nuevo Plan de Trabajo</h3>
                        </div>
                        {!! Form::open(['route' => 'AltaNuevoPlan', 'method' => 'POST']) !!}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-3">
                                    <label>* Secretaría </label>
                                    <select class="form-control m-bot15" name="estructura" required>
                                        <option value="21500" name="estructura">Secretaría de Desarrollo Social</option>
                                    </select><br>
                                </div>
                                <div class="col-xs-4">
                                    <label>* Dependencia / Organismo Auxiliar </label>
                                    <select class="form-control m-bot15" name="unidad" required>
                                        @foreach($unidades as $unidad)
                                            <option value="{{$unidad->depen_id}}" name="unidad">{{$unidad->depen_desc}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-5">
                                    <div class="col-xs-12">
                                        <label >* Nombre del Titular de la Dependencia / Organismo Auxiliar</label>
                                        <input type="text" class="form-control" name="titular" placeholder="Nombre del Titular de la Dependencia / Organismo Auxiliar" onkeypress="return soloAlfa(event)" required>
                                    </div>
                                </div>
                                <div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Continuar',['class' => 'btn btn-primary btn-flat pull-right']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!--<div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>NGCI {{$apartados[0]->cve_ngci}}.- {{$apartados[0]->desc_ngci}}</b></h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                <tr>
                                    <th style="background-color:black;text-align:center;vertical-align: middle;" colspan="4"><b style="color:white;">{{$apartados[0]->desc_ngci}}</b></th>
                                </tr>
                                <tr>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">No.</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Elemento de Control</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Registrar / Editar Acc. de Mejora</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Status Acc. de Mejora</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($preguntas as $pregunta)
                                    @if($pregunta->num_eci >= 1 AND $pregunta->num_eci <= 8)
                                        <tr>
                                            <td style="background-color:green;text-align:center;vertical-align: middle;"><b style="color:white;">{{$pregunta->num_eci}}</b></td>
                                            <td style="text-align:left;vertical-align: middle;">{{$pregunta->preg_eci}}</td>
                                            <td style="text-align:center;vertical-align: middle;"><a href="#" class="btn btn-primary" title="Registrar / Editar Acción de Mejora"><i class="fa fa-plus-square"></i></a></td>
                                            <td style="text-align:center;vertical-align: middle;"><a href="#" class="btn btn-success" title="Con Acción de Mejora"><i class="fa fa-check"></i></a>
                                                <a href="#" class="btn btn-danger" title="Sin Acción de Mejora"><i class="fa fa-times"></i></a></td>
                                        </tr>
                                    @endif

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>-->
                </div>
            </div>
        </section>
    </div>
@endsection

@section('request')
@endsection

@section('javascrpt')
@endsection