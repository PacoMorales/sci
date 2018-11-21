@extends('sicinar.principal')

@section('title','Ver Procesos Administrativos')

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
                Lista de Procesos
                <small> cargados al sistema</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Procesos</a></li>
                <li class="active">Ver Procesos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Procesos Administrativos</h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                <tr>
                                    <th>Clave</th>
                                    <th>Proceso</th>
                                    <th>Tipo</th>
                                    <th>Secretaria Responsable</th>
                                    <th>Unidad  Responsable</th>
                                    <th>Responsable</th>
                                    <th>Evaluado</th>
                                    <th>Criterio A</th>
                                    <th>Criterio B</th>
                                    <th>Criterio C</th>
                                    <th>Criterio D</th>
                                    <th>Criterio E</th>
                                    <th>Criterio F</th>
                                    <th>Criterio G</th>
                                    <th>Criterio H</th>
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

                                        @foreach($estructuras as $est)
                                            @if(strpos((string)$est->estrucgob_id,(string)$proceso->estrucgob_id)!==false)
                                                <td>{{$est->estrucgob_desc}}</td>
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
                                            <th><a href="#" class="btn btn-danger" title="Status: No Evaluado"><i class="fa fa-times"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-success" title="Status: Evaluado"><i class="fa fa-check"></i></a></th>
                                        @endif
                                        @if($proceso->cve_crit_sproc_a == 0)
                                            <th><a href="#" class="btn btn-secondary" title="Status: No Seleccionado"><i class="fa fa-square-o"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-secondary" title="Status: Seleccionado"><i class="fa fa-check-square-o"></i></a></th>
                                        @endif
                                        @if($proceso->cve_crit_sproc_b == 0)
                                            <th><a href="#" class="btn btn-secondary" title="Status: No Seleccionado"><i class="fa fa-square-o"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-secondary" title="Status: Seleccionado"><i class="fa fa-check-square-o"></i></a></th>
                                        @endif
                                        @if($proceso->cve_crit_sproc_c == 0)
                                            <th><a href="#" class="btn btn-secondary" title="Status: No Seleccionado"><i class="fa fa-square-o"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-secondary" title="Status: Seleccionado"><i class="fa fa-check-square-o"></i></a></th>
                                        @endif
                                        @if($proceso->cve_crit_sproc_d == 0)
                                            <th><a href="#" class="btn btn-secondary" title="Status: No Seleccionado"><i class="fa fa-square-o"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-secondary" title="Status: Seleccionado"><i class="fa fa-check-square-o"></i></a></th>
                                        @endif
                                        @if($proceso->cve_crit_sproc_e == 0)
                                            <th><a href="#" class="btn btn-secondary" title="Status: No Seleccionado"><i class="fa fa-square-o"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-secondary" title="Status: Seleccionado"><i class="fa fa-check-square-o"></i></a></th>
                                        @endif
                                        @if($proceso->cve_crit_sproc_f == 0)
                                            <th><a href="#" class="btn btn-secondary" title="Status: No Seleccionado"><i class="fa fa-square-o"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-secondary" title="Status: Seleccionado"><i class="fa fa-check-square-o"></i></a></th>
                                        @endif
                                        @if($proceso->cve_crit_sproc_g == 0)
                                            <th><a href="#" class="btn btn-secondary" title="Status: No Seleccionado"><i class="fa fa-square-o"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-secondary" title="Status: Seleccionado"><i class="fa fa-check-square-o"></i></a></th>
                                        @endif
                                        @if($proceso->cve_crit_sproc_h == 0)
                                            <th><a href="#" class="btn btn-secondary" title="Status: No Seleccionado"><i class="fa fa-square-o"></i></a></th>
                                        @else
                                            <th><a href="#" class="btn btn-secondary" title="Status: Seleccionado"><i class="fa fa-check-square-o"></i></a></th>
                                        @endif

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