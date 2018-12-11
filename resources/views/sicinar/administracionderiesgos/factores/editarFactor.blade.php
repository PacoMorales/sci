@extends('sicinar.principal')

@section('title','Editar Factor')

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
                <small>Editar Factor</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Evaluación de Riesgos</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Editar Factor</h3>
                        </div>
                        {!! Form::open(['route' => ['actualizarFactor',$factor->num_factor_riesgo], 'method' => 'PUT','id' => 'altaFactor']) !!}
                        <div class="box-body">
                            <div class="box-header">
                                <i class="fa fa-circle-o text-blue"></i>
                                <h3 class="box-title">Editar Factor</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-6 form-group">
                                        <label><i class="fa fa-circle-o-notch"></i> Descripción </label>
                                        <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{$factor->desc_factor_riesgo}}" placeholder="Descripción" required>
                                    </div>
                                    <div class="col-xs-3 form-group">
                                        <label><i class="fa fa-circle-o-notch"></i> Clasificación </label>
                                        <select class="form-control m-bot15" name="clasificacion" id="clasificacion" required>
                                            @foreach($clasificaciones as $clasificacion)
                                                @if($factor->cve_clasif_factorriesgo == $clasificacion->cve_clasif_factorriesgo)
                                                    <option value="{{$clasificacion->cve_clasif_factorriesgo}}" selected>{{$clasificacion->desc_clasif_factorriesgo}}</option>
                                                @else
                                                    <option value="{{$clasificacion->cve_clasif_factorriesgo}}">{{$clasificacion->desc_clasif_factorriesgo}}</option>
                                                @endif
                                            @endforeach
                                        </select><br>
                                    </div>
                                    <div class="col-xs-3 form-group">
                                        <label><i class="fa fa-circle-o-notch"></i> Tipo </label>
                                        <select class="form-control m-bot15" name="tipo" id="tipo" required>
                                            @foreach($tipos as $tipo)
                                                @if($factor->cve_tipo_factor == $tipo->cve_tipo_factor)
                                                    <option value="{{$tipo->cve_tipo_factor}}" selected>{{$tipo->desc_tipo_factor}}</option>
                                                @else
                                                    <option value="{{$tipo->cve_tipo_factor}}">{{$tipo->desc_tipo_factor}}</option>
                                                @endif
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
                                {!! Form::submit('Guardar',['class' => 'btn btn-primary btn-block']) !!}
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