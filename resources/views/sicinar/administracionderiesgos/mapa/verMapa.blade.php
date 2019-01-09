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
                <small> Ver mapa</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">IV. Mapa de Riesgos</a></li>
                <li class="active">Ver Mapa</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">IV. Mapa de Riesgos</h3><br>
                            {{$riesgo->cve_riesgo}}. {{$riesgo->desc_riesgo}}<br>
                            Grado de Impacto: {{$riesgo->grado_impacto_2}}<br>
                            Probalidad de Ocurrencia: {{$riesgo->escala_valor_2}}<br>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" border="1" class="table table-bordered table-sm">
                                <tbody>
                                    @for($i=10;$i>=1;$i--)
                                        <tr>
                                            @if($i==10)
                                                <td width="50" height="50" rowspan="10" style="text-align:center; vertical-align: middle; writing-mode: vertical-lr; transform: rotate(180deg);">OCURRENCIA DE PROBABILIDAD</td>
                                            @endif
                                            <td width="50" height="50" style="text-align:center; vertical-align: middle;">{{$i}}</td>
                                            @if($i >= 6)
                                                <!-- SECCION AMARILLA -->
                                                @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==1)
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                @else
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FFFF00;"></td>
                                                @endif
                                                @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==2)
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                @else
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FFFF00;"></td>
                                                @endif
                                                @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==3)
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                @else
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FFFF00;"></td>
                                                @endif
                                                @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==4)
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                @else
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FFFF00;"></td>
                                                @endif
                                                @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==5)
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                @else
                                                    <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FFFF00;"></td>
                                                @endif
                                            @else
                                                <!-- SECCION VERDE -->
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==1)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FF00;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==2)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FF00;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==3)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FF00;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==4)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FF00;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==5)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FF00;"></td>
                                                    @endif
                                            @endif
                                            @if($i >= 1 AND $i<=5)
                                                <!-- SECCION AZUL -->
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==6)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FFFF;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==7)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FFFF;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==8)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FFFF;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==9)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FFFF;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==10)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #00FFFF;"></td>
                                                    @endif
                                            @else
                                                <!-- SECCION ROJA -->
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==6)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FF0000;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==7)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FF0000;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==8)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FF0000;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==9)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FF0000;"></td>
                                                    @endif
                                                    @if($riesgo->escala_valor_2 ==$i  AND $riesgo->grado_impacto_2 ==10)
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: orange;">{{$riesgo->grado_impacto_2}}, {{$riesgo->escala_valor_2}}</td>
                                                    @else
                                                        <td width="50" height="50" style="text-align:center; vertical-align: middle; background-color: #FF0000;"></td>
                                                    @endif
                                        @endif
                                        </tr>
                                    @endfor
                                    <tr>
                                        <td style="text-align:center; vertical-align: middle;"></td>
                                        <td style="text-align:center; vertical-align: middle;">0</td>
                                        <td style="text-align:center; vertical-align: middle;">1</td>
                                        <td style="text-align:center; vertical-align: middle;">2</td>
                                        <td style="text-align:center; vertical-align: middle;">3</td>
                                        <td style="text-align:center; vertical-align: middle;">4</td>
                                        <td style="text-align:center; vertical-align: middle;">5</td>
                                        <td style="text-align:center; vertical-align: middle;">6</td>
                                        <td style="text-align:center; vertical-align: middle;">7</td>
                                        <td style="text-align:center; vertical-align: middle;">8</td>
                                        <td style="text-align:center; vertical-align: middle;">9</td>
                                        <td style="text-align:center; vertical-align: middle;">10</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center; vertical-align: middle;"></td>
                                        <td colspan="11" style="text-align:center; vertical-align: middle;"> GRADO DE IMPACTO</td>
                                    </tr>
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