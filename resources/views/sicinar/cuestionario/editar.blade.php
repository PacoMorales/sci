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
                <div class="col-md-11">

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Selecciona el proceso que deseas editar</b></h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                    <tr>
                                        <th>Clave</th>
                                        <th>Proceso</th>
                                        <th>Status Evaluación</th>
                                        <th>Status Actividad</th>
                                        <th>Acciones</th>
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
                                            <td><a href="{{ route('EditarN1',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Norma 1</a>
                                                <a href="{{ route('EditarN2',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Norma 2</a>
                                                <a href="{{ route('EditarN3',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Norma 3</a>
                                                <a href="{{ route('EditarN4',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Norma 4</a>
                                                <a href="{{ route('EditarN5',$proceso->cve_proceso) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i> Norma 5</a>
                                            </td>
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