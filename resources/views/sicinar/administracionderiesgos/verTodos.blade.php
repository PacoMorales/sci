@extends('sicinar.principal')

@section('title','Administración de Riesgos')

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
                <small> I. Evaluación de Riesgos</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">I. Evaluación de Riesgos</a></li>
                <li class="active">Ver Todos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">I. Evaluación de Riesgos</h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                    <tr>
                                        <th rowspan="1" style="text-align:center; vertical-align: middle;">Clave</th>
                                        <th rowspan="1" style="text-align:center; vertical-align: middle;">Riesgo</th>
                                        <th rowspan="1" style="text-align:center; vertical-align: middle;">Unidad Administrativa</th>
                                        <th rowspan="1" style="text-align:center; vertical-align: middle;">Activo / Inactivo</th>
                                        <th rowspan="1" style="text-align:center; vertical-align: middle;">Riesgo controlado suficientemente? <br> Si / No</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;">Editar Evaluación</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle; color:green;">Agregar Factor</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle; color:green;">Ver Factor</th>
                                        <!--<th colspan="1" style="text-align:center; vertical-align: middle;">Acciones</th>-->
                                    </tr>
                                    <!--<tr>
                                        <th style="text-align:center; vertical-align: middle;">I. Evaluación Riesgos</th>
                                        <th style="text-align:center; vertical-align: middle;">II. Evaluación de Controles</th>
                                        <th style="text-align:center; vertical-align: middle;">III. Valoración de Riesgos vs Controles</th>
                                        <th style="text-align:center; vertical-align: middle;">IV. Mapa de Riesgos</th>
                                        <th style="text-align:center; vertical-align: middle;">V. Estrategias y Acciones</th>
                                        <th style="text-align:center; vertical-align: middle;">Ver Evaluación Completa</th>
                                    </tr>-->
                                </thead>
                                <tbody>
                                @foreach($riesgos as $riesgo)
                                    <tr>
                                        <td style="text-align:center; vertical-align: middle;">{{$riesgo->cve_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$riesgo->desc_riesgo}}</td>
                                        @foreach($unidades as $unidad)
                                            @if(strpos($unidad->depen_id,$riesgo->cve_dependencia) !== false)
                                                <td style="text-align:center; vertical-align: middle;">{{$unidad->depen_desc}}</td>
                                                @break
                                            @endif
                                        @endforeach
                                        @if($riesgo->status_1 == 'S')
                                            <td style="text-align:left; vertical-align: middle;"><a href="{{route('desactivarRiesgo',$riesgo->cve_riesgo)}}" class="btn btn-success" title="Desactivar?"><i class="fa fa-check"></i></a></td>
                                        @else
                                            <td style="text-align:right; vertical-align: middle;"><a href="{{route('activarRiesgo',$riesgo->cve_riesgo)}}" class="btn btn-danger" title="Activar?"><i class="fa fa-times"></i></a></td>
                                        @endif
                                        @if($riesgo->status_2 == 'S')
                                            <td style="text-align:center;vertical-align: middle;"><a href="{{route('descontrolarRiesgo',$riesgo->cve_riesgo)}}" class="btn btn-success" title="Si"><i class="fa fa-check-square-o"></i></a></td>
                                        @else
                                            <td style="text-align:center;vertical-align: middle;"><a href="{{route('controlarRiesgo',$riesgo->cve_riesgo)}}" class="btn btn-danger" title="No"><i class="fa fa-minus-square-o"></i></a></td>
                                        @endif
                                        <td style="text-align:center;vertical-align: middle;"><a href="{{route('editarRiesgo',$riesgo->cve_riesgo)}}" class="btn btn-primary" title="Editar Evaluación de Riesgos"><i class="fa fa-edit"></i></a></td>
                                        <td style="text-align:center;vertical-align: middle;"><a href="#" class="btn btn-success" title="Agregar un Factor"><i class="fa fa-plus"></i></a></td>
                                        <td style="text-align:center;vertical-align: middle;"><a href="#" class="btn btn-info" title="Ver Factor"><i class="fa fa-search"></i></a></td>
                                        <!--<td style="text-align:center;"><a href="#" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        <td style="text-align:center;"><a href="#" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        <td style="text-align:center;"><a href="#" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        <td style="text-align:center;"><a href="#" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a></td>
                                        <td style="text-align:center;"><a href="#" class="btn btn-danger" title="Ver (formato PDF)"><i class="fa fa-file-pdf-o"></i> PDF</a></td>-->

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $riesgos->appends(request()->input())->links() !!}
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