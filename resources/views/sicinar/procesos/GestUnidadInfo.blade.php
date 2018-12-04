@extends('sicinar.principal')

@section('title','Gestionar Unidades Administrativas')

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
                Gestión de Unidades Administrativas
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Gestión</a></li>
                <li class="active">Unidad</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-5">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Seleccione una opción</h3>
                            <br>Por favor, seleccione la Unidad Administrativa que desea visualizar.
                        </div>
                        {!! Form::open(['route' => 'unidadesInfo', 'method' => 'GET']) !!}
                        <div class="box-body">
                            <select class="form-control m-bot15" name="unidad" required>
                                @foreach($unidades as $unidad)
                                    <option value="{{$unidad->depen_id}}" name="unidad">{{$unidad->depen_desc}}</option>
                                @endforeach
                            </select><br>
                            <div class="row">
                                <div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Ver Información',['class' => 'btn btn-primary btn-flat pull-right']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="box">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Criterios de Rangos de Ponderación para determinar el color del semáforo.</h3>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            Si la <b>ponderación</b> es mayor o igual a 0.0% y menor o igual a 16.7%, resaltará en color <b style="color:red;">rojo</b>.<br>
                                            Si la <b>ponderación</b> es mayor o igual a 16.8% y menor o igual a 33.3%, resaltará en color <b style="color:orange;">naranja</b>.<br>
                                            Si la <b>ponderación</b> es mayor o igual a 33.4% y menor o igual a 50.0%, se resaltará en color <b style="color:green;">verde</b>.<br>
                                            Si la <b>ponderación</b> es mayor o igual a 50.1% y menor o igual a 66.7%, se resaltará en color <b style="color:blue;">azul</b>.<br>
                                            Si la <b>ponderación</b> es mayor o igual a 66.8% y menor o igual a 83.3%, se resaltará en color <b style="color:deepskyblue;">azul claro</b>.<br>
                                            Si la <b>ponderación</b> es mayor o igual a 83.4% y menor o igual a 100.0%, se resaltará en color <b style="color:gray;">gris</b>.<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">UNIDAD ADMINISTRATIVA: {{$admon[0]->depen_desc}}</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead style="color: brown;" class="justify">
                                    <tr>
                                        <th rowspan="2">CLAVE</th>
                                        <th rowspan="2">PROCESO</th>
                                        <th rowspan="2">TIPO</th>
                                        <th colspan="6" style="text-align:center;">NORMAS GENERALES DE CONTROL INTERNO (NGCI)</th>
                                    </tr>
                                    <tr>
                                        @foreach($apartados as $apartado)
                                            <th>{{$apartado->desc_ngci}}</th>
                                        @endforeach
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($procesos as $proceso)
                                            <tr>
                                                <td>{{$proceso->cve_proceso}}</td>
                                                <td>{{$proceso->desc_proceso}}</td>
                                                @foreach($tipos as $tipo)
                                                    @if($proceso->cve_tipo_proc == $tipo->cve_tipo_proc)
                                                        <td>{{$tipo->desc_tipo_proc}}</td>
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($proceso->pond_ngci1 >= 0 AND $proceso->pond_ngci1 <= 16.79)
                                                    <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                                                @else
                                                    @if($proceso->pond_ngci1 >= 16.80 AND $proceso->pond_ngci1 <= 33.39)
                                                        <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                                                    @else
                                                        @if($proceso->pond_ngci1 >= 33.40 AND $proceso->pond_ngci1 <= 50.09)
                                                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                                                        @else
                                                            @if($proceso->pond_ngci1 >= 50.1 AND $proceso->pond_ngci1 <= 66.79)
                                                                <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                                                            @else
                                                                @if($proceso->pond_ngci1 >= 66.8 AND $proceso->pond_ngci1 <= 83.39)
                                                                    <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                                                                @else
                                                                    @if($proceso->pond_ngci1 >= 83.4 AND $proceso->pond_ngci1 <= 100)
                                                                        <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                                                                    @else
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                @if($proceso->pond_ngci2 >= 0 AND $proceso->pond_ngci2 <= 16.79)
                                                    <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                                                @else
                                                    @if($proceso->pond_ngci2 >= 16.80 AND $proceso->pond_ngci2 <= 33.39)
                                                        <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                                                    @else
                                                        @if($proceso->pond_ngci2 >= 33.40 AND $proceso->pond_ngci2 <= 50.09)
                                                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                                                        @else
                                                            @if($proceso->pond_ngci2 >= 50.1 AND $proceso->pond_ngci2 <= 66.79)
                                                                <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                                                            @else
                                                                @if($proceso->pond_ngci2 >= 66.8 AND $proceso->pond_ngci2 <= 83.39)
                                                                    <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                                                                @else
                                                                    @if($proceso->pond_ngci2 >= 83.4 AND $proceso->pond_ngci2 <= 100)
                                                                        <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                                                                    @else
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                @if($proceso->pond_ngci3 >= 0 AND $proceso->pond_ngci3 <= 16.79)
                                                    <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                                                @else
                                                    @if($proceso->pond_ngci3 >= 16.80 AND $proceso->pond_ngci3 <= 33.39)
                                                        <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                                                    @else
                                                        @if($proceso->pond_ngci3 >= 33.40 AND $proceso->pond_ngci3 <= 50.09)
                                                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                                                        @else
                                                            @if($proceso->pond_ngci3 >= 50.1 AND $proceso->pond_ngci3 <= 66.79)
                                                                <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                                                            @else
                                                                @if($proceso->pond_ngci3 >= 66.8 AND $proceso->pond_ngci3 <= 83.39)
                                                                    <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                                                                @else
                                                                    @if($proceso->pond_ngci3 >= 83.4 AND $proceso->pond_ngci3 <= 100)
                                                                        <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                                                                    @else
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                @if($proceso->pond_ngci4 >= 0 AND $proceso->pond_ngci4 <= 16.79)
                                                    <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                                                @else
                                                    @if($proceso->pond_ngci4 >= 16.80 AND $proceso->pond_ngci4 <= 33.39)
                                                        <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                                                    @else
                                                        @if($proceso->pond_ngci4 >= 33.40 AND $proceso->pond_ngci4 <= 50.09)
                                                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                                                        @else
                                                            @if($proceso->pond_ngci4 >= 50.1 AND $proceso->pond_ngci4 <= 66.79)
                                                                <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                                                            @else
                                                                @if($proceso->pond_ngci4 >= 66.8 AND $proceso->pond_ngci4 <= 83.39)
                                                                    <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                                                                @else
                                                                    @if($proceso->pond_ngci4 >= 83.4 AND $proceso->pond_ngci4 <= 100)
                                                                        <th><a href="#" class="btn btn default"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                                                                    @else
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                @if($proceso->pond_ngci5 >= 0 AND $proceso->pond_ngci5 <= 16.79)
                                                    <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                                                @else
                                                    @if($proceso->pond_ngci5 >= 16.80 AND $proceso->pond_ngci5 <= 33.39)
                                                        <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                                                    @else
                                                        @if($proceso->pond_ngci5 >= 33.40 AND $proceso->pond_ngci5 <= 50.09)
                                                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                                                        @else
                                                            @if($proceso->pond_ngci5 >= 50.1 AND $proceso->pond_ngci5 <= 66.79)
                                                                <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                                                            @else
                                                                @if($proceso->pond_ngci5 >= 66.8 AND $proceso->pond_ngci5 <= 83.39)
                                                                    <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                                                                @else
                                                                    @if($proceso->pond_ngci5 >= 83.4 AND $proceso->pond_ngci5 <= 100)
                                                                        <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                                                                    @else
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                @if($proceso->total >= 0 AND $proceso->total <= 16.79)
                                                    <th><a href="#" class="btn btn-danger"><b>{{$proceso->total}}%</b></a></th>
                                                @else
                                                    @if($proceso->total >= 16.80 AND $proceso->total <= 33.39)
                                                        <th><a href="#" class="btn btn-warning"><b>{{$proceso->total}}%</b></a></th>
                                                    @else
                                                        @if($proceso->total >= 33.40 AND $proceso->total <= 50.09)
                                                            <th><a href="#" class="btn btn-success"><b>{{$proceso->total}}%</b></a></th>
                                                        @else
                                                            @if($proceso->total >= 50.1 AND $proceso->total <= 66.79)
                                                                <th><a href="#" class="btn btn-primary"><b>{{$proceso->total}}%</b></a></th>
                                                            @else
                                                                @if($proceso->total >= 66.8 AND $proceso->total <= 83.39)
                                                                    <th><a href="#" class="btn btn-info"><b>{{$proceso->total}}%</b></a></th>
                                                                @else
                                                                    @if($proceso->total >= 83.4 AND $proceso->total <= 100)
                                                                        <th><a href="#" class="btn btn-default"><b>{{$proceso->total}}%</b></a></th>
                                                                    @else
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" style="text-align:right;">TOTAL(ES):</td>
                                            @if($apartado1 >= 0 AND $apartado1 <= 16.79)
                                                <th><a href="#" class="btn btn-danger"><b>{{$apartado1}}%</b></a></th>
                                            @else
                                                @if($apartado1 >= 16.80 AND $apartado1 <= 33.39)
                                                    <th><a href="#" class="btn btn-warning"><b>{{$apartado1}}%</b></a></th>
                                                @else
                                                    @if($apartado1 >= 33.40 AND $apartado1 <= 50.09)
                                                        <th><a href="#" class="btn btn-success"><b>{{$apartado1}}%</b></a></th>
                                                    @else
                                                        @if($apartado1 >= 50.1 AND $apartado1 <= 66.79)
                                                            <th><a href="#" class="btn btn-primary"><b>{{$apartado1}}%</b></a></th>
                                                        @else
                                                            @if($apartado1 >= 66.8 AND $apartado1 <= 83.39)
                                                                <th><a href="#" class="btn btn-info"><b>{{$apartado1}}%</b></a></th>
                                                            @else
                                                                @if($apartado1 >= 83.4 AND $apartado1 <= 100)
                                                                    <th><a href="#" class="btn btn-default"><b>{{$apartado1}}%</b></a></th>
                                                                @else
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            @if($apartado2 >= 0 AND $apartado2 <= 16.79)
                                                <th><a href="#" class="btn btn-danger"><b>{{$apartado2}}%</b></a></th>
                                            @else
                                                @if($apartado2 >= 16.80 AND $apartado2 <= 33.39)
                                                    <th><a href="#" class="btn btn-warning"><b>{{$apartado2}}%</b></a></th>
                                                @else
                                                    @if($apartado2 >= 33.40 AND $apartado2 <= 50.09)
                                                        <th><a href="#" class="btn btn-success"><b>{{$apartado2}}%</b></a></th>
                                                    @else
                                                        @if($apartado2 >= 50.1 AND $apartado2 <= 66.79)
                                                            <th><a href="#" class="btn btn-primary"><b>{{$apartado2}}%</b></a></th>
                                                        @else
                                                            @if($apartado2 >= 66.8 AND $apartado2 <= 83.39)
                                                                <th><a href="#" class="btn btn-info"><b>{{$apartado2}}%</b></a></th>
                                                            @else
                                                                @if($apartado2 >= 83.4 AND $apartado2 <= 100)
                                                                    <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                                                                @else
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            @if($apartado3 >= 0 AND $apartado3 <= 16.79)
                                                <th><a href="#" class="btn btn-danger"><b>{{$apartado3}}%</b></a></th>
                                            @else
                                                @if($apartado3 >= 16.80 AND $apartado3 <= 33.39)
                                                    <th><a href="#" class="btn btn-warning"><b>{{$apartado3}}%</b></a></th>
                                                @else
                                                    @if($apartado3 >= 33.40 AND $apartado3 <= 50.09)
                                                        <th><a href="#" class="btn btn-success"><b>{{$apartado3}}%</b></a></th>
                                                    @else
                                                        @if($apartado3 >= 50.1 AND $apartado3 <= 66.79)
                                                            <th><a href="#" class="btn btn-primary"><b>{{$apartado3}}%</b></a></th>
                                                        @else
                                                            @if($apartado3 >= 66.8 AND $apartado3 <= 83.39)
                                                                <th><a href="#" class="btn btn-info"><b>{{$apartado3}}%</b></a></th>
                                                            @else
                                                                @if($apartado3 >= 83.4 AND $apartado3 <= 100)
                                                                    <th><a href="#" class="btn btn-default"><b>{{$apartado3}}%</b></a></th>
                                                                @else
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            @if($apartado4 >= 0 AND $apartado4 <= 16.79)
                                                <th><a href="#" class="btn btn-danger"><b>{{$apartado4}}%</b></a></th>
                                            @else
                                                @if($apartado4 >= 16.80 AND $apartado4 <= 33.39)
                                                    <th><a href="#" class="btn btn-warning"><b>{{$apartado4}}%</b></a></th>
                                                @else
                                                    @if($apartado4 >= 33.40 AND $apartado4 <= 50.09)
                                                        <th><a href="#" class="btn btn-success"><b>{{$apartado4}}%</b></a></th>
                                                    @else
                                                        @if($apartado4 >= 50.1 AND $apartado4 <= 66.79)
                                                            <th><a href="#" class="btn btn-primary"><b>{{$apartado4}}%</b></a></th>
                                                        @else
                                                            @if($apartado4 >= 66.8 AND $apartado4 <= 83.39)
                                                                <th><a href="#" class="btn btn-info"><b>{{$apartado4}}%</b></a></th>
                                                            @else
                                                                @if($apartado4 >= 83.4 AND $apartado4 <= 100)
                                                                    <th><a href="#" class="btn btn default"><b>{{$apartado4}}%</b></a></th>
                                                                @else
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            @if($apartado5 >= 0 AND $apartado5 <= 16.79)
                                                <th><a href="#" class="btn btn-danger"><b>{{$apartado5}}%</b></a></th>
                                            @else
                                                @if($apartado5 >= 16.80 AND $apartado5 <= 33.39)
                                                    <th><a href="#" class="btn btn-warning"><b>{{$apartado5}}%</b></a></th>
                                                @else
                                                    @if($apartado5 >= 33.40 AND $apartado5 <= 50.09)
                                                        <th><a href="#" class="btn btn-success"><b>{{$apartado5}}%</b></a></th>
                                                    @else
                                                        @if($apartado5 >= 50.1 AND $apartado5 <= 66.79)
                                                            <th><a href="#" class="btn btn-primary"><b>{{$apartado5}}%</b></a></th>
                                                        @else
                                                            @if($apartado5 >= 66.8 AND $apartado5 <= 83.39)
                                                                <th><a href="#" class="btn btn-info"><b>{{$apartado5}}%</b></a></th>
                                                            @else
                                                                @if($apartado5 >= 83.4 AND $apartado5 <= 100)
                                                                    <th><a href="#" class="btn btn-default"><b>{{$apartado5}}%</b></a></th>
                                                                @else
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            @if($total_pond >= 0 AND $total_pond <= 16.79)
                                                <th><a href="#" class="btn btn-danger"><b>{{$total_pond}}%</b></a></th>
                                            @else
                                                @if($total_pond >= 16.80 AND $total_pond <= 33.39)
                                                    <th><a href="#" class="btn btn-warning"><b>{{$total_pond}}%</b></a></th>
                                                @else
                                                    @if($total_pond >= 33.40 AND $total_pond <= 50.09)
                                                        <th><a href="#" class="btn btn-success"><b>{{$total_pond}}%</b></a></th>
                                                    @else
                                                        @if($total_pond >= 50.1 AND $total_pond <= 66.79)
                                                            <th><a href="#" class="btn btn-primary"><b>{{$total_pond}}%</b></a></th>
                                                        @else
                                                            @if($total_pond >= 66.8 AND $total_pond <= 83.39)
                                                                <th><a href="#" class="btn btn-info"><b>{{$total_pond}}%</b></a></th>
                                                            @else
                                                                @if($total_pond >= 83.4 AND $total_pond <= 100)
                                                                    <th><a href="#" class="btn btn-default"><b>{{$total_pond}}%</b></a></th>
                                                                @else
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Gráfica de Ponderación de las Normas Generales de  Control Iinterno (NGCI)</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                @foreach($apartados as $apartado)
                                    @if($apartado->cve_ngci == 1)
                                        @if($apartado1 >= 0 AND $apartado1 <= 16.79)
                                            <b style="color:red;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado1}}%</b><br>
                                        @else
                                            @if($apartado1 >= 16.80 AND $apartado1 <= 33.39)
                                                <b style="color:orange;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado1}}%</b><br>
                                            @else
                                                @if($apartado1 >= 33.40 AND $apartado1 <= 50.09)
                                                    <b style="color:green;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado1}}%</b><br>
                                                @else
                                                    @if($apartado1 >= 50.1 AND $apartado1 <= 66.79)
                                                        <b style="color:blue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado1}}%</b><br>
                                                    @else
                                                        @if($apartado1 >= 66.8 AND $apartado1 <= 83.39)
                                                            <b style="color:deepskyblue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado1}}%</b><br>
                                                        @else
                                                            @if($apartado1 >= 83.4 AND $apartado1 <= 100)
                                                                <b style="color:gray;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado1}}%</b><br>
                                                            @else
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @else
                                        @if($apartado->cve_ngci == 2)
                                            @if($apartado2 >= 0 AND $apartado2 <= 16.79)
                                                <b style="color:red;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado2}}%</b><br>
                                            @else
                                                @if($apartado2 >= 16.80 AND $apartado2 <= 33.39)
                                                    <b style="color:orange;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado2}}%</b><br>
                                                @else
                                                    @if($apartado2 >= 33.40 AND $apartado2 <= 50.09)
                                                        <b style="color:green;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado2}}%</b><br>
                                                    @else
                                                        @if($apartado2 >= 50.1 AND $apartado2 <= 66.79)
                                                            <b style="color:blue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado2}}%</b><br>
                                                        @else
                                                            @if($apartado2 >= 66.8 AND $apartado2 <= 83.39)
                                                                <b style="color:deepskyblue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado2}}%</b><br>
                                                            @else
                                                                @if($apartado2 >= 83.4 AND $apartado2 <= 100)
                                                                    <b style="color:gray;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado2}}%</b><br>
                                                                @else
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @else
                                            @if($apartado->cve_ngci == 3)
                                                @if($apartado3 >= 0 AND $apartado3 <= 16.79)
                                                    <b style="color:red;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado3}}%</b><br>
                                                @else
                                                    @if($apartado3 >= 16.80 AND $apartado3 <= 33.39)
                                                        <b style="color:orange;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado3}}%</b><br>
                                                    @else
                                                        @if($apartado3 >= 33.40 AND $apartado3 <= 50.09)
                                                            <b style="color:green;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado3}}%</b><br>
                                                        @else
                                                            @if($apartado3 >= 50.1 AND $apartado3 <= 66.79)
                                                                <b style="color:blue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado3}}%</b><br>
                                                            @else
                                                                @if($apartado3 >= 66.8 AND $apartado3 <= 83.39)
                                                                    <b style="color:deepskyblue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado3}}%</b><br>
                                                                @else
                                                                    @if($apartado3 >= 83.4 AND $apartado3 <= 100)
                                                                        <b style="color:gray;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado3}}%</b><br>
                                                                    @else
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @else
                                                @if($apartado->cve_ngci == 4)
                                                    @if($apartado4 >= 0 AND $apartado4 <= 16.79)
                                                        <b style="color:red;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado4}}%</b><br>
                                                    @else
                                                        @if($apartado4 >= 16.80 AND $apartado4 <= 33.39)
                                                            <b style="color:orange;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado4}}%</b><br>
                                                        @else
                                                            @if($apartado4 >= 33.40 AND $apartado4 <= 50.09)
                                                                <b style="color:green;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado4}}%</b><br>
                                                            @else
                                                                @if($apartado4 >= 50.1 AND $apartado4 <= 66.79)
                                                                    <b style="color:blue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado4}}%</b><br>
                                                                @else
                                                                    @if($apartado4 >= 66.8 AND $apartado4 <= 83.39)
                                                                        <b style="color:deepskyblue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado4}}%</b><br>
                                                                    @else
                                                                        @if($apartado4 >= 83.4 AND $apartado4 <= 100)
                                                                            <b style="color:gray;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado4}}%</b><br>
                                                                        @else
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @else
                                                    @if($apartado->cve_ngci == 5)
                                                        @if($apartado5 >= 0 AND $apartado5 <= 16.79)
                                                            <b style="color:red;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado5}}%</b><br>
                                                        @else
                                                            @if($apartado5 >= 16.80 AND $apartado5 <= 33.39)
                                                                <b style="color:orange;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado5}}%</b><br>
                                                            @else
                                                                @if($apartado5 >= 33.40 AND $apartado5 <= 50.09)
                                                                    <b style="color:green;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado5}}%</b><br>
                                                                @else
                                                                    @if($apartado5 >= 50.1 AND $apartado5 <= 66.79)
                                                                        <b style="color:blue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado5}}%</b><br>
                                                                    @else
                                                                        @if($apartado5 >= 66.8 AND $apartado5 <= 83.39)
                                                                            <b style="color:deepskyblue;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado5}}%</b><br>
                                                                        @else
                                                                            @if($apartado5 >= 83.4 AND $apartado5 <= 100)
                                                                                <b style="color:gray;">{{$apartado->cve_ngci}}.- {{$apartado->desc_ngci}}: {{$apartado5}}%</b><br>
                                                                            @else
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            <canvas id="pieChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Grados de Cumplimiento de los elementos de control con base en la evidencia documental</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <br>Ponderación obtenida: {{$total_pond}}%
                            <br>Si la ponderación esta entre 0% y 50.09%, la matriz se iluminará de color <b style="color:red">rojo</b>
                            <br>Si la ponderación esta entre 50.1% y 83.39%, la matriz se iluminará de color <b style="color:yellowgreen">amarillo</b>
                            <br>Si la ponderación esta entre 84.4% y 100%, la matriz se iluminará de color <b style="color:green">verde</b>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered table-sm">
                                            <thead style="color: white;" class="justify">
                                                <tr>
                                                    <th></th>
                                                    <th colspan="6" style="background-color:#C4BC96;text-align:center;vertical-align: middle;">MATRIZ DE EVALUACIÓN DE LOS ELEMENTOS DE CONTROL CON BASE EN LA EVIDENCIA</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr>
                                                <td style="background-color:#C4BC96;text-align:center;vertical-align: middle;"><b style="color:white">{{$matriz[2]->etapa_grado}}</b></td>
                                                <td style="background-color:red;text-align:center;vertical-align: middle;" colspan="3"><b style="color:white">{{$matriz[2]->c_1}}</b></td>
                                                <td style="background-color:yellow;text-align:center;vertical-align: middle;" colspan="2"><b style="color:black">{{$matriz[2]->c_4}}</b></td>
                                                <td style="background-color:green;text-align:center;vertical-align: middle;"><b style="color:white">{{$matriz[2]->c_6}}</b></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color:#E5DFEC;text-align:center;vertical-align: middle;">{{$matriz[3]->etapa_grado}}</td>
                                                @if($total_pond >= 0 AND $total_pond <= 16.79)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[3]->c_1}}</td>
                                                @else
                                                    <td style="background-color:#D7E7F0;text-align:center;vertical-align: middle;">{{$matriz[3]->c_1}}</td>
                                                @endif
                                                @if($total_pond >= 16.80 AND $total_pond <= 33.39)
                                                        <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[3]->c_2}}</td>
                                                @else
                                                        <td style="background-color:#D7E7F0;text-align:center;vertical-align: middle;">{{$matriz[3]->c_2}}</td>
                                                @endif
                                                @if($total_pond >= 33.40 AND $total_pond <= 50.09)
                                                        <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[3]->c_3}}</td>
                                                @else
                                                        <td style="background-color:#D7E7F0;text-align:center;vertical-align: middle;">{{$matriz[3]->c_3}}</td>
                                                @endif
                                                @if($total_pond >= 50.1 AND $total_pond <= 66.79)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[3]->c_4}}</td>
                                                @else
                                                        <td style="background-color:#D7E7F0;text-align:center;vertical-align: middle;">{{$matriz[3]->c_4}}</td>
                                                @endif
                                                @if($total_pond >= 66.8 AND $total_pond <= 83.39)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[3]->c_5}}</td>
                                                @else
                                                        <td style="background-color:#D7E7F0;text-align:center;vertical-align: middle;">{{$matriz[3]->c_5}}</td>
                                                @endiF
                                                @if($total_pond >= 83.4 AND $total_pond <= 100)
                                                        <td style="background-color:blue;text-align:center;vertical-align: middle;">{{$matriz[3]->c_6}}</td>
                                                @else
                                                        <td style="background-color:#D7E7F0;text-align:center;vertical-align: middle;">{{$matriz[3]->c_6}}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td style="background-color:#C6E6A2;text-align:center;vertical-align: middle;">{{$matriz[4]->etapa_grado}}</td>
                                                @if($total_pond >= 0 AND $total_pond <= 16.79)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[4]->c_1}}</td>
                                                @else
                                                    <td style="background-color:#F7F6DA;text-align:center;vertical-align: middle;">{{$matriz[4]->c_1}}</td>
                                                @endif
                                                @if($total_pond >= 16.80 AND $total_pond <= 33.39)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[4]->c_2}}</td>
                                                @else
                                                    <td style="background-color:#F7F6DA;text-align:center;vertical-align: middle;">{{$matriz[4]->c_2}}</td>
                                                @endif
                                                @if($total_pond >= 33.40 AND $total_pond <= 50.09)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[4]->c_3}}</td>
                                                @else
                                                    <td style="background-color:#F7F6DA;text-align:center;vertical-align: middle;">{{$matriz[4]->c_3}}</td>
                                                @endif
                                                @if($total_pond >= 50.1 AND $total_pond <= 66.79)
                                                    <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[4]->c_4}}</td>
                                                @else
                                                    <td style="background-color:#F8DCD3;text-align:center;vertical-align: middle;">{{$matriz[4]->c_4}}</td>
                                                @endif
                                                @if($total_pond >= 66.8 AND $total_pond <= 83.39)
                                                    <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[4]->c_5}}</td>
                                                @else
                                                    <td style="background-color:#F8DCD3;text-align:center;vertical-align: middle;">{{$matriz[4]->c_5}}</td>
                                                @endiF
                                                @if($total_pond >= 83.4 AND $total_pond <= 100)
                                                    <td style="background-color:green;text-align:center;vertical-align: middle;">{{$matriz[4]->c_6}}</td>
                                                @else
                                                    <td style="background-color:#61D6FF;text-align:center;vertical-align: middle;">{{$matriz[4]->c_6}}</td>
                                                @endif
                                            </tr>
                                            <!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
                                            <tr>
                                                <td style="background-color:#F0F5CF;text-align:center;vertical-align: middle;" rowspan="5">{{$matriz[5]->etapa_grado}}</td>
                                                @if($total_pond >= 0 AND $total_pond <= 16.79)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[5]->c_1}}</td>
                                                @else
                                                    <td style="background-color:#F2F2F2;text-align:center;vertical-align: middle;">{{$matriz[5]->c_1}}</td>
                                                @endif
                                                @if($total_pond >= 16.80 AND $total_pond <= 33.39)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[5]->c_2}}</td>
                                                @else
                                                    <td style="background-color:#F2F2F2;text-align:center;vertical-align: middle;">{{$matriz[5]->c_2}}</td>
                                                @endif
                                                @if($total_pond >= 33.40 AND $total_pond <= 50.09)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[5]->c_3}}</td>
                                                @else
                                                    <td style="background-color:#F2F2F2;text-align:center;vertical-align: middle;">{{$matriz[5]->c_3}}</td>
                                                @endif
                                                @if($total_pond >= 50.1 AND $total_pond <= 66.79)
                                                    <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[5]->c_4}}</td>
                                                @else
                                                    <td style="background-color:#F2F2F2;text-align:center;vertical-align: middle;">{{$matriz[5]->c_4}}</td>
                                                @endif
                                                @if($total_pond >= 66.8 AND $total_pond <= 83.39)
                                                    <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[5]->c_5}}</td>
                                                @else
                                                    <td style="background-color:#F2F2F2;text-align:center;vertical-align: middle;">{{$matriz[5]->c_5}}</td>
                                                @endiF
                                                @if($total_pond >= 83.4 AND $total_pond <= 100)
                                                    <td style="background-color:green;text-align:center;vertical-align: middle;">{{$matriz[5]->c_6}}</td>
                                                @else
                                                    <td style="background-color:#F2F2F2;text-align:center;vertical-align: middle;">{{$matriz[5]->c_6}}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                @if($total_pond >= 0 AND $total_pond <= 16.79)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[6]->c_1}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[6]->c_1}}</td>
                                                @endif
                                                @if($total_pond >= 16.80 AND $total_pond <= 33.39)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[6]->c_2}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[6]->c_2}}</td>
                                                @endif
                                                @if($total_pond >= 33.40 AND $total_pond <= 50.09)
                                                        <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[6]->c_3}}</td>
                                                @else
                                                        <td style="background-color:#D9D9D9;text-align:center;vertical-align: middle;">{{$matriz[6]->c_3}}</td>
                                                @endif
                                                @if($total_pond >= 50.1 AND $total_pond <= 66.79)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[6]->c_4}}</td>
                                                @else
                                                        <td style="background-color:#D9D9D9;text-align:center;vertical-align: middle;">{{$matriz[6]->c_4}}</td>
                                                @endif
                                                @if($total_pond >= 66.8 AND $total_pond <= 83.39)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[6]->c_5}}</td>
                                                @else
                                                        <td style="background-color:#D9D9D9;text-align:center;vertical-align: middle;">{{$matriz[6]->c_5}}</td>
                                                @endiF
                                                @if($total_pond >= 83.4 AND $total_pond <= 100)
                                                        <td style="background-color:green;text-align:center;vertical-align: middle;">{{$matriz[6]->c_6}}</td>
                                                @else
                                                        <td style="background-color:#D9D9D9;text-align:center;vertical-align: middle;">{{$matriz[6]->c_6}}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                @if($total_pond >= 0 AND $total_pond <= 16.79)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[7]->c_1}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[7]->c_1}}</td>
                                                @endif
                                                @if($total_pond >= 16.80 AND $total_pond <= 33.39)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[7]->c_2}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[7]->c_2}}</td>
                                                @endif
                                                @if($total_pond >= 33.40 AND $total_pond <= 50.09)
                                                        <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[7]->c_3}}</td>
                                                @else
                                                        <td style="text-align:center;vertical-align: middle;">{{$matriz[7]->c_3}}</td>
                                                @endif
                                                @if($total_pond >= 50.1 AND $total_pond <= 66.79)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[7]->c_4}}</td>
                                                @else
                                                        <td style="background-color:#BFBFBF;text-align:center;vertical-align: middle;">{{$matriz[7]->c_4}}</td>
                                                @endif
                                                @if($total_pond >= 66.8 AND $total_pond <= 83.39)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[7]->c_5}}</td>
                                                @else
                                                        <td style="background-color:#BFBFBF;text-align:center;vertical-align: middle;">{{$matriz[7]->c_5}}</td>
                                                @endiF
                                                @if($total_pond >= 83.4 AND $total_pond <= 100)
                                                        <td style="background-color:gree;text-align:center;vertical-align: middle;">{{$matriz[7]->c_6}}</td>
                                                @else
                                                        <td style="background-color:#BFBFBF;text-align:center;vertical-align: middle;">{{$matriz[7]->c_6}}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                @if($total_pond >= 0 AND $total_pond <= 16.79)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[8]->c_1}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[8]->c_1}}</td>
                                                @endif
                                                @if($total_pond >= 16.80 AND $total_pond <= 33.39)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[8]->c_2}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[8]->c_2}}</td>
                                                @endif
                                                @if($total_pond >= 33.40 AND $total_pond <= 50.09)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[8]->c_3}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[8]->c_3}}</td>
                                                @endif
                                                @if($total_pond >= 50.1 AND $total_pond <= 66.79)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[8]->c_4}}</td>
                                                @else
                                                        <td style="text-align:center;vertical-align: middle;">{{$matriz[8]->c_4}}</td>
                                                @endif
                                                @if($total_pond >= 66.8 AND $total_pond <= 83.39)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[8]->c_5}}</td>
                                                @else
                                                        <td style="background-color:#ADADAD;text-align:center;vertical-align: middle;">{{$matriz[8]->c_5}}</td>
                                                @endiF
                                                @if($total_pond >= 83.4 AND $total_pond <= 100)
                                                        <td style="background-color:green;text-align:center;vertical-align: middle;">{{$matriz[8]->c_6}}</td>
                                                @else
                                                        <td style="background-color:#ADADAD;text-align:center;vertical-align: middle;">{{$matriz[8]->c_6}}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                @if($total_pond >= 0 AND $total_pond <= 16.79)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[9]->c_1}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[9]->c_1}}</td>
                                                @endif
                                                @if($total_pond >= 16.80 AND $total_pond <= 33.39)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[9]->c_2}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[9]->c_2}}</td>
                                                @endif
                                                @if($total_pond >= 33.40 AND $total_pond <= 50.09)
                                                    <td style="background-color:red;text-align:center;vertical-align: middle;">{{$matriz[9]->c_3}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[9]->c_3}}</td>
                                                @endif
                                                @if($total_pond >= 50.1 AND $total_pond <= 66.79)
                                                    <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[9]->c_4}}</td>
                                                @else
                                                    <td style="text-align:center;vertical-align: middle;">{{$matriz[9]->c_4}}</td>
                                                @endif
                                                @if($total_pond >= 66.8 AND $total_pond <= 83.39)
                                                        <td style="background-color:yellow;text-align:center;vertical-align: middle;">{{$matriz[9]->c_5}}</td>
                                                @else
                                                        <td style="text-align:center;vertical-align: middle;">{{$matriz[9]->c_5}}</td>
                                                @endiF
                                                @if($total_pond >= 83.4 AND $total_pond <= 100)
                                                        <td style="background-color:green;text-align:center;vertical-align: middle;">{{$matriz[9]->c_6}}</td>
                                                @else
                                                        <td style="background-color:#9D9D9D;text-align:center;vertical-align: middle;">{{$matriz[9]->c_6}}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
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
    <script src="{{ asset('bower_components/chart.js/Chart.js') }}"></script>
@endsection

@section('javascrpt')
    <script>
        $(function () {
            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieChart       = new Chart(pieChartCanvas)
            var PieData        = [
                {
                    value    : <?php echo $apartado1;?>,
                    color    : '<?php echo $colores[0];?>',
                    highlight: '<?php echo $colores[0];?>',
                    label    : '<?php echo $apartados[0]->desc_ngci;?>'
                },
                {
                    value    : <?php echo $apartado2;?>,
                    color    : '<?php echo $colores[1];?>',
                    highlight: '<?php echo $colores[1];?>',
                    label    : '<?php echo $apartados[1]->desc_ngci;?>'
                },
                {
                    value    : <?php echo $apartado3;?>,
                    color    : '<?php echo $colores[2];?>',
                    highlight: '<?php echo $colores[2];?>',
                    label    : '<?php echo $apartados[2]->desc_ngci;?>'
                },
                {
                    value    : <?php echo $apartado4;?>,
                    color    : '<?php echo $colores[3];?>',
                    highlight: '<?php echo $colores[3];?>',
                    label    : '<?php echo $apartados[3]->desc_ngci;?>'
                },
                {
                    value    : <?php echo $apartado5;?>,
                    color    : '<?php echo $colores[4];?>',
                    highlight: '<?php echo $colores[4];?>',
                    label    : '<?php echo $apartados[4]->desc_ngci;?>'
                }
            ]
            var pieOptions     = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke    : true,
                //String - The colour of each segment stroke
                segmentStrokeColor   : '#fff',
                //Number - The width of each segment stroke
                segmentStrokeWidth   : 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps       : 100,
                //String - Animation easing effect
                animationEasing      : 'easeOutBounce',
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate        : true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale         : false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive           : true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio  : true,
                //String - A legend template
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
  })
</script>
@endsection