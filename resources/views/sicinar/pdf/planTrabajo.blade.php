@extends('sicinar.pdf.layout')

@section('content')
    <!--<h1 class="page-header">Listado de productos</h1>-->
    <table class="table table-sm" align="center">
        <thead>
        <tr>
            <th><img src="{{ asset('images/Gobierno.png') }}" alt="EDOMEX" width="75px" height="55px" style="margin-right: 15px;"/></th>
            <th style="background-color:gray; width:750px; text-align:center;"><h4 style="color:white;">PROGRAMA DE TRABAJO DE CONTROL INTERNO 2019</h4></th>
            <th><img src="{{ asset('images/Contraloria.png') }}" alt="EDOMEX" width="55px" height="55px" style="margin-left: 15px;"/></th>
        </tr>
        <tr>
            <td colspan="3"  style="text-align:center;"><b>Gobierno del Estado de México</b></td>
        </tr>
        <tr>
            <td colspan="2"><b style="color:black;font-size: small;">Dependencia / Organismo Auxiliar: {{$dependencia_aux->depen_desc}}</b></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><b style="color:black;font-size: small;">Nombre del Titular de la Dependencia / Organismo Auxiliar: {{$plan->titular}}</b></td>
            <td></td>
        </tr>
        </thead>
    </table>
<!--:::::::::::::::::::::::::::::::::::::  APARTADO 1  ::::::::::::::::::::::::::::::::::::::::::::::-->
    <table class="table table-sm" align="center">
        <thead>
            <tr>
                <th colspan="12" style="background-color:black;text-align:center;vertical-align: middle;"><h5 style="color:white;">{{$acciones1[0]->cve_ngci}}.- {{$acciones1[0]->desc_ngci}}</h5></th>
            </tr>
                <tr>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 250px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. Si / No</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. con base en la evid.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Proceso</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 15px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 100px;"><b style="color:white;font-size: x-small;">Acción de Mejora</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Inicio</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Término</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Unidad Administrativa</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Responsable</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Medios de verificación</b></th>
                </tr>
        </thead>
        <tbody>
            @foreach($acciones1 as $accion)
                <tr>
                    <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">{{$accion->num_eci}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 250px;"><b style="color:black;font-size: xx-small;">{{$accion->preg_eci}}</b></td>
                    <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                    @foreach($evaluaciones as $evaluacion)
                        @if($valuacion->num_meec == $accion->num_meec_2)
                            <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                            @break
                        @endif
                    @endforeach
                    <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->procesos}}</b></td>
                    <td style="text-align:center;vertical-align: middle;width: 15px;"><b style="color:black;font-size: xx-small;">{{$accion->no_acc_mejora}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 100px;"><b style="color:black;font-size: xx-small;">{{$accion->desc_acc_mejora}}</b></td>
                    <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ini)) !!}</b></td>
                    <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ter)) !!}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->unid_admon}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->nombres}} {{$accion->paterno}} {{$accion->materno}}</b></td>
                    <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->medios_verificacion}}</b></td>
                </tr>
                @endforeach
        </tbody>
    </table>
<!--:::::::::::::::::::::::::::::::::::::  APARTADO 2  ::::::::::::::::::::::::::::::::::::::::::::::-->
    <table style="page-break-inside: avoid;" class="table table-sm" align="center">
        <thead>
            <tr>
                <th colspan="12" style="background-color:black;text-align:center;vertical-align: middle;"><h5 style="color:white;">{{$acciones2[0]->cve_ngci}}.- {{$acciones2[0]->desc_ngci}}</h5></th>
            </tr>
            <tr>
                <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 250px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. Si / No</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. con base en la evid.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Proceso</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 15px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 100px;"><b style="color:white;font-size: x-small;">Acción de Mejora</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Inicio</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Término</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Unidad Administrativa</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Responsable</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Medios de verificación</b></th>
            </tr>
        </thead>
        <tbody>
        @foreach($acciones2 as $accion)
            <tr>
                <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">{{$accion->num_eci}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 250px;"><b style="color:black;font-size: xx-small;">{{$accion->preg_eci}}</b></td>
                <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                @foreach($evaluaciones as $evaluacion)
                    @if($valuacion->num_meec == $accion->num_meec_2)
                        <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                        @break
                    @endif
                @endforeach
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->procesos}}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 15px;"><b style="color:black;font-size: xx-small;">{{$accion->no_acc_mejora}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 100px;"><b style="color:black;font-size: xx-small;">{{$accion->desc_acc_mejora}}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ini)) !!}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ter)) !!}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->unid_admon}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->nombres}} {{$accion->paterno}} {{$accion->materno}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->medios_verificacion}}</b></td>
            </tr>
        @endforeach
        </tbody>
    </table>
<!--:::::::::::::::::::::::::::::::::::::  APARTADO 3  ::::::::::::::::::::::::::::::::::::::::::::::-->
    <table class="table table-sm" align="center">
        <thead>
        <tr>
            <th colspan="12" style="background-color:black;text-align:center;vertical-align: middle;"><h5 style="color:white;">{{$acciones3[0]->cve_ngci}}.- {{$acciones3[0]->desc_ngci}}</h5></th>
        </tr>
        <tr>
            <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 250px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. Si / No</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. con base en la evid.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Proceso</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 15px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 100px;"><b style="color:white;font-size: x-small;">Acción de Mejora</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Inicio</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Término</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Unidad Administrativa</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Responsable</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Medios de verificación</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($acciones3 as $accion)
            <tr>
                <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">{{$accion->num_eci}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 250px;"><b style="color:black;font-size: xx-small;">{{$accion->preg_eci}}</b></td>
                <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                @foreach($evaluaciones as $evaluacion)
                    @if($valuacion->num_meec == $accion->num_meec_2)
                        <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                        @break
                    @endif
                @endforeach
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->procesos}}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 15px;"><b style="color:black;font-size: xx-small;">{{$accion->no_acc_mejora}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 100px;"><b style="color:black;font-size: xx-small;">{{$accion->desc_acc_mejora}}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ini)) !!}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ter)) !!}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->unid_admon}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->nombres}} {{$accion->paterno}} {{$accion->materno}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->medios_verificacion}}</b></td>
        </tr>
        @endforeach
        </tbody>
    </table>
<!--:::::::::::::::::::::::::::::::::::::  APARTADO 4  ::::::::::::::::::::::::::::::::::::::::::::::-->
    <table class="table table-sm" align="center">
        <thead>
        <tr>
            <th colspan="12" style="background-color:black;text-align:center;vertical-align: middle;"><h5 style="color:white;">{{$acciones4[0]->cve_ngci}}.- {{$acciones4[0]->desc_ngci}}</h5></th>
        </tr>
        <tr>
            <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 250px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. Si / No</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. con base en la evid.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Proceso</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 15px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 100px;"><b style="color:white;font-size: x-small;">Acción de Mejora</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Inicio</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Término</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Unidad Administrativa</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Responsable</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Medios de verificación</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($acciones4 as $accion)
            <tr>
                <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">{{$accion->num_eci}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 250px;"><b style="color:black;font-size: xx-small;">{{$accion->preg_eci}}</b></td>
                <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                @foreach($evaluaciones as $evaluacion)
                    @if($valuacion->num_meec == $accion->num_meec_2)
                        <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                        @break
                    @endif
                @endforeach
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->procesos}}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 15px;"><b style="color:black;font-size: xx-small;">{{$accion->no_acc_mejora}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 100px;"><b style="color:black;font-size: xx-small;">{{$accion->desc_acc_mejora}}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ini)) !!}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ter)) !!}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->unid_admon}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->nombres}} {{$accion->paterno}} {{$accion->materno}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->medios_verificacion}}</b></td>
            </tr>
        @endforeach
        </tbody>
    </table>
<!--:::::::::::::::::::::::::::::::::::::  APARTADO 5  ::::::::::::::::::::::::::::::::::::::::::::::-->
    <table style="page-break-inside: avoid;" class="table table-sm" align="center">
        <thead>
        <tr>
            <th colspan="12" style="background-color:black;text-align:center;vertical-align: middle;"><h5 style="color:white;">{{$acciones5[0]->cve_ngci}}.- {{$acciones5[0]->desc_ngci}}</h5></th>
        </tr>
        <tr>
            <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 250px;"><b style="color:white;font-size: x-small;">Elemento de Control</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. Si / No</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 10px;"><b style="color:white;font-size: x-small;">% Cump. con base en la evid.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Proceso</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 15px;"><b style="color:white;font-size: x-small;">No.</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 100px;"><b style="color:white;font-size: x-small;">Acción de Mejora</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Inicio</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 25px;"><b style="color:white;font-size: x-small;">Fecha de Término</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Unidad Administrativa</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Responsable</b></th>
                    <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 50px;"><b style="color:white;font-size: x-small;">Medios de verificación</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($acciones5 as $accion)
            <tr>
                <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;font-size: x-small;">{{$accion->num_eci}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 250px;"><b style="color:black;font-size: xx-small;">{{$accion->preg_eci}}</b></td>
                <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                @foreach($evaluaciones as $evaluacion)
                    @if($valuacion->num_meec == $accion->num_meec_2)
                        <td style="background-color:#FFC000;text-align:center;vertical-align: middle;width: 10px;"><b style="color:black;font-size: xx-small;">{{$accion->porc_meec}}%</b></td>
                        @break
                    @endif
                @endforeach
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->procesos}}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 15px;"><b style="color:black;font-size: xx-small;">{{$accion->no_acc_mejora}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 100px;"><b style="color:black;font-size: xx-small;">{{$accion->desc_acc_mejora}}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ini)) !!}</b></td>
                <td style="text-align:center;vertical-align: middle;width: 25px;"><b style="color:black;font-size: xx-small;">{!! date('d/m/Y',strtotime($accion->fecha_ter)) !!}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->unid_admon}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->nombres}} {{$accion->paterno}} {{$accion->materno}}</b></td>
                <td style="text-align:justify;vertical-align: middle;width: 50px;"><b style="color:black;font-size: xx-small;">{{$accion->medios_verificacion}}</b></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br><br><br>
    <table class="table table-hover" align="center">
        <thead>
        <tr>
            <th style="text-align:center;"><b>Autorizó<br>Titular de la Institución<br>(Firma)</b></th>
            <th style="text-align:center;"><b>Revisó<br>Coordinador de Control Interno<br>(Firma)</b></th>
            <th style="text-align:center;"><b>Elaboró<br>Enlace del SCII<br>(Firma)</b></th>
        </tr>
        </thead>
    </table>
@endsection