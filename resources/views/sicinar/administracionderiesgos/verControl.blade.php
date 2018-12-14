@extends('sicinar.principal')

@section('title','Evaluación de Controles')

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
                II. Evaluación de Controles
                <small> Ver todos</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">II. Evaluación de Controles</a></li>
                <li class="active">Ver Todos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">II. Evaluación de Controles</h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                    <tr>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;"><b style="color: green">Clave del Riesgo</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;"><b style="color: green">Riesgo</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;"><b style="color: dodgerblue">Clave del Factor</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;"><b style="color: dodgerblue">Factor</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;">Clave del Control</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;">Control</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;">Tipo</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;">Status</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;">Resultado de la determinación del Control</th>
                                        <th colspan="1" rowspan="{{$total}}" style="text-align:center; vertical-align: middle;">Riesgo Controlado Suficientemente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($controles as $control)
                                    <tr>
                                        <td style="text-align:center; vertical-align: middle;">{{$control->cve_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$control->desc_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$control->num_factor_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$control->desc_factor_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$control->cve_control_deriesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$control->desc_control_deriesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$control->desc_tipo_control}}</td>
                                        @if($control->status_1 == 'S')
                                            <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-success">Activo</a></td>
                                        @else
                                            <td style="text-align:center; vertical-align: middle;"><a href="#" class="btn btn-success">Inactivo</a></td>
                                        @endif
                                        <td style="text-align:center; vertical-align: middle;">{{$control->desc_defsuf_control}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$control->status_1}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $controles->appends(request()->input())->links() !!}
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