@extends('sicinar.principal')

@section('title','Editar Plan de Trabajo')

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
                <small> Selecciona alguna opción para iniciar</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Plan de Trabajo</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">PROGRAMA DE TRABAJO DE CONTROL INTERNO {!! 1+(int)date('Y') !!}</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 offset-md-12">
                                    <label>Dependencia / Organismo Auxiliar: {{$unidad->depen_desc}}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 offset-md-12">
                                    <label>Nombre del Titular de la Dependencia / Organismo Auxiliar: {{$plan->titular}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                    <tr>
                                        <th colspan="4" style="background-color:black;text-align:center;"><h5 style="color:white;">{{$apartados[0]->cve_ngci}}.- {{$apartados[0]->desc_ngci}}</h5></th>
                                    </tr>
                                    <tr>
                                        <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">No.</b></th>
                                        <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Elemento de Control</b></th>
                                        <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Con Acción de Mejora</b></th>
                                        <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Editar Acción de Mejora</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($preguntas as $pregunta)
                                    @if($pregunta->num_eci >= 1 AND $pregunta->num_eci <= 8)
                                        <tr>
                                            <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">{{$pregunta->num_eci}}</b></td>
                                            <td style="text-align:justify;vertical-align: middle;"><b style="color:black;font-size:small;">{{$pregunta->preg_eci}}</b></td>
                                            @if($acciones[($pregunta->num_eci)-1]->status_3 == '1')
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-success" title="Con Acción de Mejora"><i class="fa fa-check-square-o"></i></a></td>
                                            @else
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-danger" title="Sin Acción de Mejora"><i class="fa fa-square-o"></i></a></td>
                                            @endif
                                            <td style="text-align:center; vertical-align: middle;"><a href="{{route('editarAccion',$pregunta->num_eci)}}" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                <tr>
                                    <th colspan="4" style="background-color:black;text-align:center;"><h5 style="color:white;">{{$apartados[1]->cve_ngci}}.- {{$apartados[1]->desc_ngci}}</h5></th>
                                </tr>
                                <tr>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">No.</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Elemento de Control</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Con Acción de Mejora</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Editar Acción de Mejora</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($preguntas as $pregunta)
                                    @if($pregunta->num_eci >= 9 AND $pregunta->num_eci <= 12)
                                        <tr>
                                            <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">{{$pregunta->num_eci}}</b></td>
                                            <td style="text-align:justify;vertical-align: middle;"><b style="color:black;font-size:small;">{{$pregunta->preg_eci}}</b></td>
                                            @if($acciones[($pregunta->num_eci)-1] == '0')
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-success" title="Con Acción de Mejora"><i class="fa fa-check-square-o"></i></a></td>
                                            @else
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-danger" title="Sin Acción de Mejora"><i class="fa fa-square-o"></i></a></td>
                                            @endif
                                            <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                <tr>
                                    <th colspan="4" style="background-color:black;text-align:center;"><h5 style="color:white;">{{$apartados[2]->cve_ngci}}.- {{$apartados[2]->desc_ngci}}</h5></th>
                                </tr>
                                <tr>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">No.</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Elemento de Control</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Con Acción de Mejora</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Editar Acción de Mejora</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($preguntas as $pregunta)
                                    @if($pregunta->num_eci >= 13 AND $pregunta->num_eci <= 24)
                                        <tr>
                                            <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">{{$pregunta->num_eci}}</b></td>
                                            <td style="text-align:justify;vertical-align: middle;"><b style="color:black;font-size:small;">{{$pregunta->preg_eci}}</b></td>
                                            @if($acciones[($pregunta->num_eci)-1] == '0')
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-success" title="Con Acción de Mejora"><i class="fa fa-check-square-o"></i></a></td>
                                            @else
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-danger" title="Sin Acción de Mejora"><i class="fa fa-square-o"></i></a></td>
                                            @endif
                                            <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                <tr>
                                    <th colspan="4" style="background-color:black;text-align:center;"><h5 style="color:white;">{{$apartados[3]->cve_ngci}}.- {{$apartados[3]->desc_ngci}}</h5></th>
                                </tr>
                                <tr>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">No.</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Elemento de Control</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Con Acción de Mejora</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Editar Acción de Mejora</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($preguntas as $pregunta)
                                    @if($pregunta->num_eci >= 25 AND $pregunta->num_eci <= 30)
                                        <tr>
                                            <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">{{$pregunta->num_eci}}</b></td>
                                            <td style="text-align:justify;vertical-align: middle;"><b style="color:black;font-size:small;">{{$pregunta->preg_eci}}</b></td>
                                            @if($acciones[($pregunta->num_eci)-1] == '0')
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-success" title="Con Acción de Mejora"><i class="fa fa-check-square-o"></i></a></td>
                                            @else
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-danger" title="Sin Acción de Mejora"><i class="fa fa-square-o"></i></a></td>
                                            @endif
                                            <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                <tr>
                                    <th colspan="4" style="background-color:black;text-align:center;"><h5 style="color:white;">{{$apartados[4]->cve_ngci}}.- {{$apartados[4]->desc_ngci}}</h5></th>
                                </tr>
                                <tr>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">No.</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Elemento de Control</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Con Acción de Mejora</b></th>
                                    <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Editar Acción de Mejora</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($preguntas as $pregunta)
                                    @if($pregunta->num_eci >= 31 AND $pregunta->num_eci <= 33)
                                        <tr>
                                            <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">{{$pregunta->num_eci}}</b></td>
                                            <td style="text-align:justify;vertical-align: middle;"><b style="color:black;font-size:small;">{{$pregunta->preg_eci}}</b></td>
                                            @if($acciones[($pregunta->num_eci)-1] == '0')
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-success" title="Con Acción de Mejora"><i class="fa fa-check-square-o"></i></a></td>
                                            @else
                                                <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-danger" title="Sin Acción de Mejora"><i class="fa fa-square-o"></i></a></td>
                                            @endif
                                            <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    @endif
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