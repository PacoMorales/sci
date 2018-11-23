@extends('sicinar.principal')

@section('title','Gestionar Procesos Institucionales')

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
                Gestión de Procesos Institucionales
                <small> (Activar o desactivar procesos)</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Procesos</a></li>
                <li class="active">Gestión de Procesos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Procesos dados de alta en total: {{$total}}</h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                <tr>
                                    <th>Clave</th>
                                    <th>Proceso</th>
                                    <th>Tipo</th>
                                    <th>U. Admon. Responsable</th>
                                    <th>Responsable</th>
                                    <th>Proceso Evaluado</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
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

                                        @foreach($dependencias as $dependencia)
                                            @if(rtrim($dependencia->depen_id," ") == $proceso->cve_dependencia)
                                                <td>{{$dependencia->depen_desc}}</td>
                                                @break
                                            @endif
                                            @if($loop->last)
                                                <td>NO ASIGNADO</td>
                                            @endif
                                        @endforeach

                                        <td>{{$proceso->responsable}}</td>
                                        @if($proceso->status_1 == 'N')
                                            <td><a href="#" class="btn btn-danger" title="No Evaluado"><i class="fa fa-times"></i></a></td>
                                        @else
                                            <td><a href="#" class="btn btn-success" title="Evaluado"><i class="fa fa-check"></i></a></td>
                                        @endif

                                        @if($proceso->status_2 == 'A')
                                            <td><a href="{{route('procesosGestionDesInst',$proceso->cve_proceso)}}" class="btn btn-success" title="Activo"><i class="fa fa-check-square-o"></i></a></td>
                                        @else
                                            <td><a href="{{route('procesosGestionActInst',$proceso->cve_proceso)}}" class="btn btn-danger" title="Inactivo"><i class="fa fa-square-o"></i></a></td>
                                        @endif
                                        <td><a href="{{route('procesoVerInfo',$proceso->cve_proceso)}}" class="btn btn-default" title="Ver Información"><i class="fa fa-search"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $procesos->appends(request()->input())->links() !!}
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