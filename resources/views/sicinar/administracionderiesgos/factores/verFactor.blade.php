@extends('sicinar.principal')

@section('title','Factores de Riesgo')

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
                Factor(es) del Riesgo {{$riesgo->cve_riesgo}}: {{$riesgo->desc_riesgo}}
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
                <div class="col-md-8">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Factor(es) de Riesgo</h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                    <tr>
                                        <th style="text-align:center; vertical-align: middle;">No. Factor de Riesgo</th>
                                        <th style="text-align:center; vertical-align: middle;">Descripción Factor de Riesgo</th>
                                        <th style="text-align:center; vertical-align: middle;">Clasificación</th>
                                        <th style="text-align:center; vertical-align: middle;">Tipo</th>
                                        <th style="text-align:center; vertical-align: middle;">Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($factores as $factor)
                                        <tr>
                                            <td style="text-align:center; vertical-align: middle;">{{$factor->num_factor_riesgo}}</td>
                                            <td style="text-align:center; vertical-align: middle;">{{$factor->desc_factor_riesgo}}</td>
                                            <td style="text-align:center; vertical-align: middle;">{{$factor->desc_clasif_factorriesgo}}</td>
                                            <td style="text-align:center; vertical-align: middle;">{{$factor->desc_tipo_factor}}</td>
                                            <td style="text-align:center; vertical-align: middle;"><a class="btn btn-primary" href="{{route('editarFactor',$factor->num_factor_riesgo)}}" title="Editar Factor de Riesgos"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $factores->appends(request()->input())->links() !!}
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