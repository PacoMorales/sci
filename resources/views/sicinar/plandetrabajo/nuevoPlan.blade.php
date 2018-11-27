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
                                <div class="col-xs-6">
                                    <label>* Dependencia / Organismo Auxiliar </label>
                                    <select class="form-control m-bot15" name="unidad" required>
                                        @foreach($unidades as $unidad)
                                            <option value="{{$unidad->depen_id}}" name="unidad">{{$unidad->depen_desc}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-12">
                                        <label >* Nombre del Titular de la Dependencia / Organismo Auxiliar</label>
                                        <input type="text" class="form-control" name="titular" placeholder="Nombre del Titular de la Dependencia / Organismo Auxiliar" onkeypress="return soloAlfa(event)" required>
                                    </div>
                                </div>
                                <div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Ver Información',['class' => 'btn btn-primary btn-flat pull-right']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b></b></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-5">
                                    <b style="color: orange;">Elemento de Control {{$pregunta->num_eci}}</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label style="color:gray;">{{$pregunta->preg_eci}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Apartado {{$apartados[0]->cve_ngci}}.- {{$apartados[0]->desc_ngci}}</b></h3>
                        </div>
                        @foreach($preguntas as $pregunta)
                            @if($pregunta->num_eci >= 1 AND $pregunta->num_eci <= 8)
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <b style="color: orange;">Elemento de Control {{$pregunta->num_eci}}</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label style="color:gray;">{{$pregunta->preg_eci}}</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
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