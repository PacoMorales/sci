@extends('sicinar.principal')

@section('title','Estrategias')

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
                V. Estrategias para evitar el Riesgo
                <small> Ver todos</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">V. Estrategias para evitar el Riesgo</a></li>
                <li class="active">Ver Todos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">V. Estrategias para evitar el Riesgo</h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" border="1" style="border: 2px solid slategray;" class="table table-bordered table-sm">
                                <thead style="border-color:brown;color: brown;" class="justify">
                                <tr>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: green">Clave del Riesgo</b></th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: green">Riesgo</b></th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: dodgerblue">Clave del Factor</b></th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: dodgerblue">Factor</b></th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Estrategia</th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Descripción de la(s) Acción(es)</th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Status</th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Status
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: dodgerblue">Editar</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($estrategias as $estrategia)
                                        <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;">{{$estrategia->cve_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;">{{$estrategia->desc_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;">{{$estrategia->num_factor_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;">{{$estrategia->desc_factor_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;">{{$estrategia->desc_admon_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;">{{$estrategia->desc_accion}}</td>
                                        @if($estrategia->status_1 == 'S')
                                            <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><a href="#" title="Activo" class="btn btn-success"><i class="fa fa-check"></i></a></td>
                                        @else
                                            <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><a href="#" title="Inactivo" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
                                        @endif
                                        @if($estrategia->status_2 == '1')
                                            <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><a href="#" title="Concluido" class="btn btn-success"><i class="fa fa-check"></i></a></td>
                                        @else
                                            <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><a href="#" title="Pendiente" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
                                        @endif
                                        <td style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><a href="#" title="Editar" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                    @endforeach
                                </tbody>
                                {!! $estrategias->appends(request()->input())->links() !!}
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