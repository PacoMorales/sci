@extends('sicinar.principal')

@section('title','Administración de Riezgos')

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
                Matriz de Administración de Riesgos Institucional
                <small> Selecciona alguno para registrar o editar</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Matriz de Riesgos</a></li>
                <li class="active">Todos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Matriz de Administración de Riesgos Institucional</h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                <tr>
                                    <th style="text-align:center; vertical-align: middle;">Clave</th>
                                    <th style="text-align:center; vertical-align: middle;">Unidad Administrativa</th>
                                    <th style="text-align:center; vertical-align: middle;">Titular</th>
                                    <th style="text-align:center; vertical-align: middle;">Activo / Inactivo</th>
                                    <th style="text-align:center; vertical-align: middle;">Concluido / Pendiente</th>
                                    <th style="text-align:center; vertical-align: middle;">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($planes as $plan)
                                    <tr>
                                        <td style="text-align:center; vertical-align: middle;">{{$plan->num_eval}}</td>
                                        @foreach($unidades as $unidad)
                                            @if(strpos($unidad->depen_id,$plan->cve_dependencia)!==false)
                                                <td style="text-align:center; vertical-align: middle;">{{$unidad->depen_desc}}</td>
                                            @endif
                                        @endforeach
                                        <td style="text-align:center; vertical-align: middle;">{{$plan->titular}}</td>
                                        @if($plan->status_1 == 'S')
                                            <td style="text-align:left; vertical-align: middle;"><a href="{{route('desactivarPlan',$plan->num_eval)}}" class="btn btn-success" title="Desactivar?"><i class="fa fa-check"></i></a></td>
                                        @else
                                            <td style="text-align:right; vertical-align: middle;"><a href="{{route('activarPlan',$plan->num_eval)}}" class="btn btn-danger" title="Activar?"><i class="fa fa-times"></i></a></td>
                                        @endif
                                        @if($plan->status_2 == '1')
                                            <td style="text-align:left; vertical-align: middle;"><a href="{{route('planPendiente',$plan->num_eval)}}" class="btn btn-success" title="Pendiente?"><i class="fa fa-check-square-o"></i></a></td>
                                        @else
                                            <td style="text-align:right; vertical-align: middle;"><a href="{{route('planConcluido',$plan->num_eval)}}" class="btn btn-warning" title="Concluido?"><i class="fa fa-minus-square-o"></i></a></td>
                                        @endif
                                        <td style="text-align:center;"><a href="{{route('editarPlan',$plan->num_eval)}}" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('planPDF',$plan->num_eval)}}" class="btn btn-danger" title="Ver Plan de Trabajo"><i class="fa fa-search"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $planes->appends(request()->input())->links() !!}
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