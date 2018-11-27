@extends('sicinar.principal')

@section('title','Editar Evaluación')

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
                Cédula de Evaluación en materia de Control Interno<small>con base en el Manual Administrativo de Aplicación General</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Cuestionario</a></li>
                <li class="active">Editar Cédula de Evaluación</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Selecciona el proceso que deseas editar</b></h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm" style="text-align:center;">
                                <thead style="color:brown;" class="justify">
                                    <tr>
                                        <th style="text-align:center;vertical-align: middle;" rowspan="2">Clave</th>
                                        <th style="text-align:center;vertical-align: middle;" rowspan="2">Proceso</th>
                                        <th style="text-align:center;vertical-align: middle;" rowspan="2">Status Evaluación</th>
                                        <th style="text-align:center;vertical-align: middle;" rowspan="2">Status Actividad</th>
                                        <th style="text-align:center;vertical-align: middle;" colspan="5">Normas Generales de Control Interno (NGCI)</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;vertical-align: middle;">1.- Ambiente de Control</th>
                                        <th style="text-align:center;vertical-align: middle;">2.- Administración de Riesgos</th>
                                        <th style="text-align:center;vertical-align: middle;">3.- Actividades de Control</th>
                                        <th style="text-align:center;vertical-align: middle;">4.- Informar y Comunicar</th>
                                        <th style="text-align:center;vertical-align: middle;">5.- Supervisión y Mejora Continua</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($procesos as $proceso)
                                        <tr>
                                            <td>{{$proceso->cve_proceso}}</td>
                                            <td>{{$proceso->desc_proceso}}</td>
                                            <td><a href="#" class="btn btn-success" title="Evaluado"><i class="fa fa-check"></i></a></td>
                                            <td><a href="#" class="btn btn-success" title="Activo"><i class="fa fa-check"></i></a></td>
                                            <!--<td><a href="#" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a></td>-->
                                            <td><a href="{{ route('EditarN1',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Editar</a></td>
                                            <td><a href="{{ route('EditarN2',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Editar</a></td>
                                            <td><a href="{{ route('EditarN3',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Editar</a></td>
                                            <td><a href="{{ route('EditarN4',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Editar</a></td>
                                            <td><a href="{{ route('EditarN5',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Editar</a></td>
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