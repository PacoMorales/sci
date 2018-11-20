@extends('sicinar.pdf.layout')

@section('content')
    <!--<h1 class="page-header">Listado de productos</h1>-->
    <table class="table table-hover table-striped" align="center">
        <thead>
            <tr>
                <th style="background-color:gray; width:800px; text-align:center;"><h4 style="color:white;">Cédula de Evaluación en materia de Control Interno con base en <br> el  Manual Administrativo de Aplicación General</h4></th>
                <th><img src="{{ asset('images/Contraloria.png') }}" alt="EDOMEX" width="40px" height="40px" style="margin-left: 50px;"/>
                    <img src="{{ asset('images/Gobierno.png') }}" alt="EDOMEX" width="60px" height="40px"/></th>
            </tr>
            <tr>
                <td><b>Gobierno del Estado de México</b></td>
                <td><b>Fecha de la Evaluación:</b></td>
            </tr>
            <tr>
                <td><b>Dependencia / Organismo Auxiliar:</b></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Nombre del Titular de la Dependencia / Organismo Auxiliar:</b></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Objetivo General de la Evaluación:</b> Fortalecer el Sistema de Control Interno en los Entes Públicos para proporcionar una seguridad razonable sobre la consecución de las metas y objetivos institucionales y la salvaguarda de los recursos públicos, así como para prevenir actos contrarios a la integridad.</td>
                <td></td>
            </tr>
        </thead>
    </table>
    <table class="table table-hover table-striped" align="center">
        <thead>
            <tr>
                <th colspan="8" style="background-color:black; width:800px;text-align:center;"><h4 style="color:white;">APARTADO</h4></th>
            </tr>
            <tr>
                <th style="background-color:darkred;text-align:center;"><b style="color:white;">No.</b></th>
                <th style="background-color:darkred;text-align:center;"><b style="color:white;">Elemento de Control</b></th>
                <th style="background-color:darkred;text-align:center;"><b style="color:white;">Área responsable / Evidencia</b></th>
                <th style="background-color:darkred;text-align:center;"><b style="color:white;">Persona Responsable</b></th>
                <th style="background-color:darkred;text-align:center;"><b style="color:white;">Evaluación</b></th>
                <th style="background-color:darkred;text-align:center;"><b style="color:white;">Valoración</b></th>
                <th style="background-color:darkred;text-align:center;"><b style="color:white;">Nivel detectado</b></th>
                <th style="background-color:darkred;text-align:center;"><b style="color:white;">Clasificación</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="background-color:darkgreen;text-align:center;"><b style="color:white;">1</b></td>
                <td style="text-align:center;"><b style="color:black;">EJEMPLO</b></td>
                <td style="text-align:center;"><b style="color:black;">EJEMPLO</b></td>
                <td style="text-align:center;"><b style="color:black;">EJEMPLO</b></td>
                <td style="background-color:orange;text-align:center;"><b style="color:black;">EJEMPLO</b></td>
                <td style="text-align:center;"><b style="color:black;">EJEMPLO</b></td>
                <td style="text-align:center;"><b style="color:black;">EJEMPLO</b></td>
                <td style="text-align:center;"><b style="color:black;">EJEMPLO</b></td>
            </tr>
        </tbody>
    </table>

    <table class="table table-hover table-striped" align="center">
        <thead>
            <tr>
                <th style="width:900px;"><b>Nombre del Coordinador de Control Interno:</b></th>
                <th><b>Firma:</b></th>
            </tr>
            <tr>
                <th style="width:900px;"><b>Nombre del Enlace del Sistema de Control Interno Institucional:</b></th>
                <th><b>Firma:</b></th>
            </tr>
        </thead>
    </table>
    <table class="table table-hover table-striped" align="center">
        <thead>
            <tr>
                <th style="background-color:gray; width:900px;"><b style="color:white;">Nombre del Personal que participa en la Evaluación</b></th>
                <th style="background-color:gray;"><b style="color:white;">Firma</b></th>
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
    <hr>
    <p>
        <a href="#" class="btn btn-sm btn-primary">
            Descargar PDF
        </a>
    </p>
@endsection