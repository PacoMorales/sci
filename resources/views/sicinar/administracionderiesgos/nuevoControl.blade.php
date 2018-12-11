@extends('sicinar.principal')

@section('title','Nuevo Control')

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
                <small>Generar nuevo control</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Evaluación de Controles</a></li>
                <li class="active">Nuevo</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Nueva Evaluación de Control</h3>
                        </div>
                        {!! Form::open(['route' => 'altaControl', 'method' => 'POST', 'id' => 'altaRiesgo']) !!}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label>* Riesgo</label>
                                    <select class="form-control m-bot15" name="riesgo" required>
                                        @foreach($riesgos as $riesgo)
                                            <option value="{{$riesgo->cve_riesgo}}">{{$riesgo->cve_riesgo}} - {{$riesgo->desc_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Factor</label>
                                    <select class="form-control m-bot15" name="factor" required>
                                        @foreach($riesgos as $riesgo)
                                            <option value="{{$riesgo->cve_riesgo}}">{{$riesgo->cve_riesgo}} - {{$riesgo->desc_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label>* Descripción del Control </label>
                                    <input type="text" class="form-control" name="control" placeholder="Descripción" required>
                                </div>
                                <div class="col-xs-2 form-group">
                                    <label>* Tipo de Control</label>
                                    <select class="form-control m-bot15" name="tipo" required>
                                        @foreach($tipos as $tipo)
                                            <option value="{{$tipo->cve_tipo_control}}">{{$tipo->desc_tipo_control}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                            </div>
                            <div class="box-header">
                                <h4 class="box-title">Determinación de Suficiencia o Deficiencia del Control</h4>
                            </div><br>
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label>Está Documentado</label>
                                    <select class="form-control m-bot15" name="documentado" required>
                                        @foreach($suficiencias as $suf)
                                            <option value="{{$suf->cve_defsuf_control}}">{{$suf->desc_defsuf_control}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Está Formalizado</label>
                                    <select class="form-control m-bot15" name="formalizado" required>
                                        @foreach($suficiencias as $suf)
                                            <option value="{{$suf->cve_defsuf_control}}">{{$suf->desc_defsuf_control}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Se Aplica</label>
                                    <select class="form-control m-bot15" name="aplica" required>
                                        @foreach($suficiencias as $suf)
                                            <option value="{{$suf->cve_defsuf_control}}">{{$suf->desc_defsuf_control}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Es Efectivo</label>
                                    <select class="form-control m-bot15" name="efectivo" required>
                                        @foreach($suficiencias as $suf)
                                            <option value="{{$suf->cve_defsuf_control}}">{{$suf->desc_defsuf_control}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>Resultado de la Determinación del Control </label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required>
                                </div>
                                <div class="col-xs-6 form-group">
                                    <label>Riesgo controlado suficientemente </label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required>
                                </div>
                                <div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Registrar',['class' => 'btn btn-success btn-block']) !!}
                                </div>
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
    {!! JsValidator::formRequest('App\Http\Requests\riesgosRequest','#altaRiesgo') !!}
@endsection

@section('javascrpt')
@endsection