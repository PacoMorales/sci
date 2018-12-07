@extends('sicinar.principal')

@section('title','Nuevo Factor')

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
                I. Evaluación de Riesgos
                <small>Generar nuevo Factor</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Evaluación de Riesgos</a></li>
                <li class="active">Nuevo</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Riesgo al que pertenece el nuevo Factor</h3>
                        </div>
                        {!! Form::open(['route' => 'altaFactor', 'method' => 'POST','id' => 'altaFactor']) !!}
                        <div class="box-body">
                            <table id="tabla1" class="table table-striped table-bordered table-sm">
                                <thead style="color: brown;" class="justify">
                                    <tr>
                                        <th rowspan="1" style="text-align:center; vertical-align: middle;">Clave del Riesgo</th>
                                        <th rowspan="1" style="text-align:center; vertical-align: middle;">Descripción del Riesgo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center; vertical-align: middle;">{{$riesgo->cve_riesgo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$riesgo->desc_riesgo}}</td>
                                    </tr>
                                </tbody>
                            </table><br>
                        <div class="box-header">
                            <i class="fa fa-circle-o text-green"></i>
                            <h3 class="box-title">Nuevo Factor</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label><i class="fa fa-circle-o-notch"></i> Descripción </label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label><i class="fa fa-circle-o-notch"></i> Clasificación </label>
                                    <select class="form-control m-bot15" name="clasificacion" id="clasificacion" required>
                                        @foreach($clasificaciones as $clasificacion)
                                            <option value="{{$clasificacion->cve_clasif_factorriesgo}}">{{$clasificacion->desc_clasif_factorriesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label><i class="fa fa-circle-o-notch"></i> Tipo </label>
                                    <select class="form-control m-bot15" name="tipo" id="tipo" required>
                                        @foreach($tipos as $tipo)
                                            <option value="{{$tipo->cve_tipo_factor}}">{{$tipo->desc_tipo_factor}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                            </div>
                            @if(count($errors) > 0)
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                            <div class="col-md-12 offset-md-5">
                                {!! Form::submit('Registrar',['class' => 'btn btn-success btn-block']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('request')
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\factorRequest','#altaFactor') !!}
@endsection

@section('javascrpt')
@endsection