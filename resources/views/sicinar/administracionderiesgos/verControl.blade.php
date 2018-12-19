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
                            <table id="tabla1" border="1" style="border: 2px solid slategray;" class="table table-bordered table-sm">
                                <thead style="border-color:brown;color: brown;" class="justify">
                                    <tr>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: green">Clave del Riesgo</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: green">Riesgo</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: dodgerblue">Clave del Factor</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: dodgerblue">Factor</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Clave del Control</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Control</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Status</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Tipo</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Está Documentado</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Está Formalizado</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Se Aplica</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Es Efectivo</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Resultado de la determinación del Control</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Riesgo Controlado Suficientemente</th>
                                    </tr>
                                </thead>
                                <?php $cont = 1;$fact = 1;$conta=1;?>
                                <tbody>
                                @foreach($controles as $control)
                                    <tr>
                                        @if($conta == $control->cve_riesgo)
                                            <td rowspan="{!! $cant_controles[($control->cve_riesgo)-1]->renglones !!}" style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$control->cve_riesgo}}</td>
                                            <td rowspan="{!! $cant_controles[($control->cve_riesgo)-1]->renglones !!}" style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$control->desc_riesgo}}</td>
                                            <?php $conta = $conta+1;?>
                                        @endif
                                            @if($fact == $control->num_factor_riesgo)
                                                @foreach($cant_factor as $factores)
                                                    @if($factores->num_factor_riesgo == $control->num_factor_riesgo)
                                                        <td rowspan="{!! $cant_factor[($control->num_factor_riesgo)-1]->renglones !!}" style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$control->num_factor_riesgo}}</td>
                                                        <td rowspan="{!! $cant_factor[($control->num_factor_riesgo)-1]->renglones !!}" style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$control->desc_factor_riesgo}}</td>
                                                        <?php $fact = $fact+1;?>
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$control->cve_control_deriesgo}}</td>
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$control->desc_control_deriesgo}}</td>
                                        @if($control->status_1 == 'S')
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('desactivarControl',$control->cve_control_deriesgo)}}" class="btn btn-success" title="Desactivar?"><i class="fa fa-check"></i></a></td>
                                        @else
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('activarControl',$control->cve_control_deriesgo)}}" class="btn btn-danger" title="Activar?"><i class="fa fa-times"></i></a></td>
                                        @endif
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$control->desc_tipo_control}}</td>
                                        @if($control->documentado == 'S')
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('desactivarDocumentado',$control->cve_control_deriesgo)}}" class="btn btn-success" title="Si">Si</a></td>
                                        @else
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('activarDocumentado',$control->cve_control_deriesgo)}}" class="btn btn-danger" title="No">No</a></td>
                                        @endif
                                        @if($control->formalizado == 'S')
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('desactivarFormalizado',$control->cve_control_deriesgo)}}" class="btn btn-success" title="Si">Si</a></td>
                                        @else
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('activarFormalizado',$control->cve_control_deriesgo)}}" class="btn btn-danger" title="No">No</a></td>
                                        @endif
                                        @if($control->aplica == 'S')
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('desactivarAplica',$control->cve_control_deriesgo)}}" class="btn btn-success" title="Si">Si</a></td>
                                        @else
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('activarAplica',$control->cve_control_deriesgo)}}" class="btn btn-danger" title="No">No</a></td>
                                        @endif
                                        @if($control->efectivo == 'S')
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('desactivarEfectivo',$control->cve_control_deriesgo)}}" class="btn btn-success" title="Si">Si</a></td>
                                        @else
                                            <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;"><a href="{{route('activarEfectivo',$control->cve_control_deriesgo)}}" class="btn btn-danger" title="No">No</a></td>
                                        @endif
                                        <td style="border: 2px solid slategray;text-align:center; vertical-align: middle;">{{$control->desc_defsuf_control}}</td>
                                        @if($cont == $control->cve_riesgo)
                                            @if($controlads == 0)
                                                    <td rowspan="{!! $cant_controles[($control->cve_riesgo)-1]->renglones !!}" style="border: 2px solid slategray;background-color: #00FF00;text-align:center; vertical-align: middle;">Si</td>
                                            @endif
                                            @foreach($controlados as $contr)
                                                @if($contr->cve_riesgo == $control->cve_riesgo)
                                                    <td rowspan="{!! $cant_controles[($control->cve_riesgo)-1]->renglones !!}" style="border: 2px solid slategray;background-color: #FFFF99;text-align:center; vertical-align: middle;">No</td>
                                                    @break
                                                @endif
                                                @if($loop->last)
                                                        <td rowspan="{!! $cant_controles[($control->cve_riesgo)-1]->renglones !!}" style="border: 2px solid slategray;background-color: #00FF00;text-align:center; vertical-align: middle;">Si</td>
                                                @endif
                                            @endforeach
                                            <?php $cont = $cont+1;?>
                                        @endif
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