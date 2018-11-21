@extends('sicinar.pdf.layout')

@section('content')
    <!--<h1 class="page-header">Listado de productos</h1>-->
    <table class="table table-hover table-striped" align="center">
        <thead>
        <tr>
            <th style="font-size: x-small;background-color:gray; width:700px; text-align:center;"><h4 style="color:white;">Cédula de Evaluación en materia de Control Interno con base en <br> el  Manual Administrativo de Aplicación General</h4></th>
            <th><img src="{{ asset('images/Contraloria.png') }}" alt="EDOMEX" width="40px" height="40px" style="margin-left: 10px;"/>
                <img src="{{ asset('images/Gobierno.png') }}" alt="EDOMEX" width="60px" height="40px"/></th>
        </tr>
        <tr>
            <td style="font-size: x-small;"><b>Gobierno del Estado de México</b></td>
            <td style="font-size: x-small;"><b>Fecha de la Evaluación: {!! date('d/m/Y',strtotime($preguntas[0]->fecha_reg)) !!}</b></td>
        </tr>
        <tr>
            <td style="font-size: x-small;"><b>Dependencia / Organismo Auxiliar: {{$unidades->depen_desc}}</b></td>
            <td></td>
        </tr>
        <tr>
            <td style="font-size: x-small;"><b>Nombre del Titular de la Dependencia / Organismo Auxiliar: {{$proceso[0]->responsable}}</b></td>
            <td></td>
        </tr>
        <tr>
            <td style="font-size: x-small;"><b>Objetivo General de la Evaluación:</b> Fortalecer el Sistema de Control Interno en los Entes Públicos para proporcionar una seguridad razonable sobre la consecución de las metas y objetivos institucionales y la salvaguarda de los recursos públicos, así como para prevenir actos contrarios a la integridad.</td>
            <td></td>
        </tr>
        </thead>
    </table>
    <!-- :::::::::::::::::::::::APARTADO 1::::::::::::::::::::::::: -->
    <table class="table table-sm" align="center">
        <thead>
        <tr>
            <th colspan="8" style="background-color:black; width:800px;text-align:center;"><h5 style="color:white;">{{$apartados[0]->cve_ngci}}.- {{$apartados[0]->desc_ngci}}</h5></th>
        </tr>
        <tr>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">No.</b></th>
            <th style="background-color:darkred;text-align:center;width: 600px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Área responsable / Evidencia</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Persona Responsable</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Evaluación</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Valoración</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Nivel detectado</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Clasificación</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($preguntas as $pregunta)
            @if($pregunta->num_eci >= 1 AND $pregunta->num_eci <= 8)
                <tr>
                    <td style="background-color:darkgreen;text-align:center;vertical-align: middle;"><b style="color:white;font-size: x-small;">{{$pregunta->num_eci}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 600px;"><b style="color:black;font-size: xx-small;">{{$pregunta->preg_eci}}</b></td>
                    @foreach($servidores as $servidor)
                        @if($servidor->id_sp == $pregunta->id_sp)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->unid_admon}}</b></td>
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</b></td>
                        @endif
                    @endforeach
                    <td style="background-color:orange;text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$pregunta->num_meec}}</b></td>
                    @foreach($valores as $valor)
                        @if($valor->num_meec == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$valor->porc_meec}}%</b></td>
                        @endif
                    @endforeach
                    @foreach($grados as $grado)
                        @if($grado->cve_grado_cump == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$grado->desc_grado_cump}}</b></td>
                        @endif
                    @endforeach
                    @if($pregunta->num_eci == 1)
                        <td rowspan="8" style="text-align:center; vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$proceso[0]->pond_ngci1}}%</b></td>
                    @endif
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    <!-- :::::::::::::::::::::::APARTADO 2::::::::::::::::::::::::: -->
    <table class="table table-sm" align="center">
        <thead>
        <tr>
            <th colspan="8" style="background-color:black; width:800px;text-align:center;"><h5 style="color:white;">{{$apartados[1]->cve_ngci}}.- {{$apartados[1]->desc_ngci}}</h5></th>
        </tr>
        <tr>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">No.</b></th>
            <th style="background-color:darkred;text-align:center;width: 600px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Área responsable / Evidencia</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Persona Responsable</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Evaluación</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Valoración</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Nivel detectado</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Clasificación</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($preguntas as $pregunta)
            @if($pregunta->num_eci >= 9 AND $pregunta->num_eci <= 12)
                <tr>
                    <td style="background-color:darkgreen;text-align:center;vertical-align: middle;"><b style="color:white;font-size: x-small;">{{$pregunta->num_eci}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 600px;"><b style="color:black;font-size: xx-small;">{{$pregunta->preg_eci}}</b></td>
                    @foreach($servidores as $servidor)
                        @if($servidor->id_sp == $pregunta->id_sp)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->unid_admon}}</b></td>
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</b></td>
                        @endif
                    @endforeach
                    <td style="background-color:orange;text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$pregunta->num_meec}}</b></td>
                    @foreach($valores as $valor)
                        @if($valor->num_meec == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$valor->porc_meec}}%</b></td>
                        @endif
                    @endforeach
                    @foreach($grados as $grado)
                        @if($grado->cve_grado_cump == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$grado->desc_grado_cump}}</b></td>
                        @endif
                    @endforeach
                    @if($pregunta->num_eci == 9)
                        <td rowspan="4" style="text-align:center; vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$proceso[0]->pond_ngci2}}%</b></td>
                    @endif
                </tr>
            @endif
        @endforeach

        </tbody>
    </table>
    <!-- :::::::::::::::::::::::APARTADO 3::::::::::::::::::::::::: -->
    <table class="table table-sm" align="center">
        <thead>
        <tr>
            <th colspan="8" style="background-color:black; width:800px;text-align:center;"><h5 style="color:white;">{{$apartados[2]->cve_ngci}}.- {{$apartados[2]->desc_ngci}}</h5></th>
        </tr>
        <tr>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">No.</b></th>
            <th style="background-color:darkred;text-align:center;width: 600px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Área responsable / Evidencia</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Persona Responsable</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Evaluación</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Valoración</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Nivel detectado</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Clasificación</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($preguntas as $pregunta)
            @if($pregunta->num_eci >= 13 AND $pregunta->num_eci <= 24)
                <tr>
                    <td style="background-color:darkgreen;text-align:center;vertical-align: middle;"><b style="color:white;font-size: x-small;">{{$pregunta->num_eci}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 600px;"><b style="color:black;font-size: xx-small;">{{$pregunta->preg_eci}}</b></td>
                    @foreach($servidores as $servidor)
                        @if($servidor->id_sp == $pregunta->id_sp)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->unid_admon}}</b></td>
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</b></td>
                        @endif
                    @endforeach
                    <td style="background-color:orange;text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$pregunta->num_meec}}</b></td>
                    @foreach($valores as $valor)
                        @if($valor->num_meec == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$valor->porc_meec}}%</b></td>
                        @endif
                    @endforeach
                    @foreach($grados as $grado)
                        @if($grado->cve_grado_cump == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$grado->desc_grado_cump}}</b></td>
                        @endif
                    @endforeach
                    @if($pregunta->num_eci == 13)
                        <td rowspan="12" style="text-align:center; vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$proceso[0]->pond_ngci3}}%</b></td>
                    @endif
                </tr>
            @endif
        @endforeach

        </tbody>
    </table>
    <!-- :::::::::::::::::::::::APARTADO 4::::::::::::::::::::::::: -->
    <table class="table table-sm" align="center">
        <thead>
        <tr>
            <th colspan="8" style="background-color:black; width:800px;text-align:center;"><h5 style="color:white;">{{$apartados[3]->cve_ngci}}.- {{$apartados[3]->desc_ngci}}</h5></th>
        </tr>
        <tr>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">No.</b></th>
            <th style="background-color:darkred;text-align:center;width: 600px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Área responsable / Evidencia</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Persona Responsable</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Evaluación</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Valoración</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Nivel detectado</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Clasificación</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($preguntas as $pregunta)
            @if($pregunta->num_eci >= 25 AND $pregunta->num_eci <= 30)
                <tr>
                    <td style="background-color:darkgreen;text-align:center;vertical-align: middle;"><b style="color:white;font-size: x-small;">{{$pregunta->num_eci}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 600px;"><b style="color:black;font-size: xx-small;">{{$pregunta->preg_eci}}</b></td>
                    @foreach($servidores as $servidor)
                        @if($servidor->id_sp == $pregunta->id_sp)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->unid_admon}}</b></td>
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</b></td>
                        @endif
                    @endforeach
                    <td style="background-color:orange;text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$pregunta->num_meec}}</b></td>
                    @foreach($valores as $valor)
                        @if($valor->num_meec == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$valor->porc_meec}}%</b></td>
                        @endif
                    @endforeach
                    @foreach($grados as $grado)
                        @if($grado->cve_grado_cump == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$grado->desc_grado_cump}}</b></td>
                        @endif
                    @endforeach
                    @if($pregunta->num_eci == 25)
                        <td rowspan="5" style="text-align:center; vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$proceso[0]->pond_ngci4}}%</b></td>
                    @endif
                </tr>
            @endif
        @endforeach

        </tbody>
    </table>
    <!-- :::::::::::::::::::::::APARTADO 5::::::::::::::::::::::::: -->
    <table class="table table-sm" align="center">
        <thead>
        <tr>
            <th colspan="8" style="background-color:black; width:800px;text-align:center;"><h4 style="color:white;">{{$apartados[4]->cve_ngci}}.- {{$apartados[4]->desc_ngci}}</h4></th>
        </tr>
        <tr>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">No.</b></th>
            <th style="background-color:darkred;text-align:center;width: 600px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Área responsable / Evidencia</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Persona Responsable</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Evaluación</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Valoración</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Nivel detectado</b></th>
            <th style="background-color:darkred;text-align:center;"><b style="color:white;font-size: x-small;">Clasificación</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($preguntas as $pregunta)
            @if($pregunta->num_eci >= 31 AND $pregunta->num_eci <= 33)
                <tr>
                    <td style="background-color:darkgreen;text-align:center;vertical-align: middle;"><b style="color:white;font-size: x-small;">{{$pregunta->num_eci}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 600px;"><b style="color:black;font-size: xx-small;">{{$pregunta->preg_eci}}</b></td>
                    @foreach($servidores as $servidor)
                        @if($servidor->id_sp == $pregunta->id_sp)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->unid_admon}}</b></td>
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</b></td>
                        @endif
                    @endforeach
                    <td style="background-color:orange;text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$pregunta->num_meec}}</b></td>
                    @foreach($valores as $valor)
                        @if($valor->num_meec == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$valor->porc_meec}}%</b></td>
                        @endif
                    @endforeach
                    @foreach($grados as $grado)
                        @if($grado->cve_grado_cump == $pregunta->num_meec)
                            <td style="text-align:center;vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$grado->desc_grado_cump}}</b></td>
                        @endif
                    @endforeach
                    @if($pregunta->num_eci == 31)
                        <td rowspan="3" style="text-align:center; vertical-align: middle;"><b style="color:black;font-size: x-small;">{{$proceso[0]->pond_ngci5}}%</b></td>
                    @endif
                </tr>
            @endif
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td colspan="5"></td>
            <td colspan="2" style="background-color:darkgreen;text-align:center;"><b style="color:white;font-size: x-small;">TOTAL:</b></td>
            <td colspan="1" style="background-color:darkgreen;text-align:center;"><b style="color:white;font-size: x-small;">{{$proceso[0]->total}}%</b></td>
        </tr>
        </tfoot>
    </table>
    <table class="table table-hover table-striped" align="center">
        <thead>
        <tr>
            <th style="width:700px;"><b style="font-size: x-small;">Nombre del Coordinador de Control Interno:</b></th>
            <th><b>Firma:</b></th>
        </tr>
        <tr>
            <th style="width:700px;"><b style="font-size: x-small;">Nombre del Enlace del Sistema de Control Interno Institucional:</b></th>
            <th><b>Firma:</b></th>
        </tr>
        </thead>
    </table>
    <table class="table table-hover table-striped" align="center">
        <thead>
        <tr>
            <th style="background-color:gray; width:700px;"><b style="color:white;font-size: x-small;">Nombre del Personal que participa en la Evaluación</b></th>
            <th style="background-color:gray;"><b style="color:white;font-size: x-small;">Firma</b></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
@endsection