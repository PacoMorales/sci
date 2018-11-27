@extends('sicinar.principal')

@section('title','Editar Evaluación')

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
    <div class="content-wrapper" id="principal">
        <section class="content-header">
            <h1>
                Cédula de Evaluación en materia de Control Interno<small>con base en el Manual Administrativo de Aplicación General</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Cuestionario</a></li>
                <li class="active">Cédula de Evaluación</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-11">

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Información Adicional</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-5">
                                    <b style="color:red;">¡Importante!</b><br>
                                    Los campos marcados con un asterisco(*) son obligatorios.<br>
                                    Para verificar que deseas cambiar tu información, por favor elige Secretaría y Unidad responsable.
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::open(['route' => ['ActualizarN5',$num_eval_aux], 'method' => 'PUT']) !!}
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Apartado 5.- Supervisión y Mejora Continua</b></h3>
                        </div>
                        @foreach($cuestionario as $cuest)
                            @if($cuest->num_eci >= 31 AND $cuest->num_eci <= 33)
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <b style="color: orange;">Elemento de Control {{$cuest->num_eci}}</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <label style="color:gray;">{{$preguntas[($cuest->num_eci)-1]->preg_eci}}</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control m-bot15" name="responsable{{$cuest->num_eci}}" id="responsable" required>
                                                <option selected="true" disabled="disabled">Responsable</option>
                                                @foreach($servidores as $servidor)
                                                    @if($servidor->id_sp == $cuest->id_sp)
                                                        <option value="{{$servidor->id_sp}}"selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                    @else
                                                        <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control m-bot15" name="evaluacion{{$cuest->num_eci}}" id="evaluacion" required>
                                                <option selected="false" disabled="disabled">Evaluación</option>
                                                @foreach($grados as $grado)
                                                    @if($grado->cve_grado_cump === $cuest->num_meec)
                                                        <option value="{{$grado->cve_grado_cump}}" selected>{{$grado->desc_grado_cump}}</option>
                                                    @else
                                                        <option value="{{$grado->cve_grado_cump}}">{{$grado->desc_grado_cump}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" name="evidencia{{$cuest->num_eci}}" value="{{$cuest->evidencias}}" placeholder="* Evidencia(s)" onkeypress="return soloAlfa(event)">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
    </div>
    </section>
    </div>
@endsection

@section('request')
@endsection

@section('javascrpt')
@endsection