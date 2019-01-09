@extends('sicinar.principal')

@section('title','Nueva Valoración')

@section('links')
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
                III. Valoración de Riesgos vs Controles
                <small>Generar nueva valoración</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Valoración de riesgos vs controles</a></li>
                <li class="active">Nuevo</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Valoración de Riesgos vs Controles</h3>
                            (Valoración Final)
                        </div>
                        {!! Form::open(['route' => 'altaValoracion', 'method' => 'POST', 'id' => 'altaValoracion']) !!}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Riesgo</label>
                                    <select class="form-control m-bot15" name="riesgo" required>
                                        @foreach($riesgos as $riesgo)
                                            <option value="{{$riesgo->cve_riesgo}}" name="riesgo">{{$riesgo->desc_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Grado de Impacto</label>
                                    <select class="form-control m-bot15" name="grado" required>
                                        @foreach($grados as $grado)
                                            <option value="{{$grado->grado_impacto}}" name="grado">{{$grado->grado_impacto}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Probabilidad de Ocurrencia</label>
                                    <select class="form-control m-bot15" name="probabilidad" required>
                                        @foreach($probabilidades as $prob)
                                            <option value="{{$prob->escala_valor}}" name="probabilidad">{{$prob->escala_valor}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\valoracionRequest','#altaValoracion') !!}
@endsection

@section('javascrpt')
@endsection