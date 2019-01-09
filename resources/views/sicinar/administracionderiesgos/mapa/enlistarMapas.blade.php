@extends('sicinar.principal')

@section('title','Mapa de Riesgos')

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
                IV. Mapa de Riesgos
                <small> Ver todos</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">IV. Mapa de Riesgos
                <li class="active">Ver Todos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">IV. Mapa de Riesgos</h3>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" border="1" style="border: 2px solid slategray;" class="table table-bordered table-sm">
                                <thead style="border-color:brown;color: brown;" class="justify">
                                <tr>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Clave del Riesgo</th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Riesgo</th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Grado de Impacto</th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Probabilidad de Ocurrencia</th>
                                    <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Ver Mapa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($riesgos as $riesgo)
                                    <tr>
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$riesgo->cve_riesgo}}</td>
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$riesgo->desc_riesgo}}</td>
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$riesgo->grado_impacto_2}}</td>
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$riesgo->escala_valor_2}}</td>
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a class="btn btn-primary" href="{{route('verMapa',$riesgo->cve_riesgo)}}"><i class="fa fa-bar-chart"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $riesgos->appends(request()->input())->links() !!}
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