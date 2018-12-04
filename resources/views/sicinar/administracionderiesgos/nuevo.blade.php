@extends('sicinar.principal')

@section('title','Nuevo Riesgo')

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
                I. Evaluación de Riesgos
                <small>Generar nuevo riesgo</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Evaluación de Riesgos</a></li>
                <li class="active">Nuevo</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Nueva Evaluación de Riesgos</h3>
                        </div>
                        {!! Form::open(['route' => 'altaRiesgo', 'method' => 'POST']) !!}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label>* Secretaría </label>
                                    <select class="form-control m-bot15" name="estructura" required>
                                        <option value="21500" name="estructura">Secretaría de Desarrollo Social</option>
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Unidad Administrativa </label>
                                    <select class="form-control m-bot15" name="unidad" required>
                                        @foreach($unidades as $unidad)
                                            <option value="{{$unidad->depen_id}}" name="unidad">{{$unidad->depen_desc}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Selección </label>
                                    <select class="form-control m-bot15" name="seleccion" required>
                                        @foreach($clases as $clase)
                                            <option value="{{$clase->cve_clase_riesgo}}" name="unidad">{{$clase->desc_clase_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Descripción </label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required>
                                </div>
                                <!--<div class="col-xs-5 form-group">
                                    <div class="col-xs-12">
                                        <label >* No. de Riesgo</label>
                                        <input type="text" class="form-control" name="no_riesgo" placeholder="No. de Riesgo" required>
                                    </div>
                                </div>-->
                                <!--<div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Dar de alta',['class' => 'btn btn-primary btn-flat pull-right']) !!}
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label>* Riesgo </label>
                                    <input type="text" class="form-control" name="riesgo" placeholder="Riesgo" required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Nivel de Decisión del Riesgo </label>
                                    <select class="form-control m-bot15" name="unidad" required>
                                        @foreach($niveles as $nivel)
                                            <option value="{{$nivel->cve_nivel_decriesgo}}" name="unidad">{{$nivel->desc_decriesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Selección </label>
                                    <select class="form-control m-bot15" name="seleccion" required>
                                        @foreach($clasificaciones as $clasif)
                                            <option value="{{$clasif->cve_clasif_riesgo}}" name="unidad">{{$clasif->desc_clasif_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group" id="Otro">
                                    <label>Especificar otro</label>
                                    <input type="text" class="form-control" name="otro" placeholder="Especificar otro" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Posibles Efectos del Riesgo </label>
                                    <input type="text" class="form-control" name="efectos" placeholder="Posibles Efectos del Riesgo" required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Nivel de Decisión del Riesgo </label>
                                    <select class="form-control m-bot15" name="unidad" required>
                                        @foreach($niveles as $nivel)
                                            <option value="{{$nivel->cve_nivel_decriesgo}}" name="unidad">{{$nivel->desc_decriesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Selección </label>
                                    <select class="form-control m-bot15" name="seleccion" required>
                                        @foreach($clasificaciones as $clasif)
                                            <option value="{{$clasif->cve_clasif_riesgo}}" name="unidad">{{$clasif->desc_clasif_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Dar de alta',['class' => 'btn btn-primary btn-flat pull-right']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
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