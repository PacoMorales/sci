@extends('sicinar.principal')

@section('title','Editar Control')

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
                <small>Editar control</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Evaluación de Controles</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Editar Evaluación de Control</h3>
                        </div>
                        {!! Form::open(['route' => ['actualizarControl',$control->cve_control_deriesgo], 'method' => 'PUT', 'id' => 'altaControl']) !!}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label>* Riesgo</label>
                                    <input type="text" class="form-control" name="riesgo" value="{{$control->desc_riesgo}}" readonly="readonly">
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Factor</label>
                                    <input type="text" class="form-control" name="factor" value="{{$control->desc_factor_riesgo}}" readonly="readonly">
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Descripción del Control </label>
                                    <input type="text" class="form-control" name="control" placeholder="Descripción" value="{{$control->desc_control_deriesgo}}" required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Tipo de Control</label>
                                    <select class="form-control m-bot15" name="tipo" required>
                                        @foreach($tipos as $tipo)
                                            @if($tipo->cve_tipo_control == $control->cve_tipo_control)
                                                <option value="{{$tipo->cve_tipo_control}}" selected>{{$tipo->desc_tipo_control}}</option>
                                            @else
                                                <option value="{{$tipo->cve_tipo_control}}">{{$tipo->desc_tipo_control}}</option>
                                            @endif
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
                                        @if($control->documentado == 'S')
                                            <option value="S" selected>SI</option>
                                            <option value="N">NO</option>
                                        @else
                                            <option value="S">SI</option>
                                            <option value="N" selected>NO</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Está Formalizado</label>
                                    <select class="form-control m-bot15" name="formalizado" required>
                                        @if($control->formalizado == 'S')
                                            <option value="S" selected>SI</option>
                                            <option value="N">NO</option>
                                        @else
                                            <option value="S">SI</option>
                                            <option value="N" selected>NO</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Se Aplica</label>
                                    <select class="form-control m-bot15" name="aplica" required>
                                        @if($control->aplica == 'S')
                                            <option value="S" selected>SI</option>
                                            <option value="N">NO</option>
                                        @else
                                            <option value="S">SI</option>
                                            <option value="N" selected>NO</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Es Efectivo</label>
                                    <select class="form-control m-bot15" name="efectivo" required>
                                        @if($control->efectivo == 'S')
                                            <option value="S" selected>SI</option>
                                            <option value="N">NO</option>
                                        @else
                                            <option value="S">SI</option>
                                            <option value="N" selected>NO</option>
                                        @endif
                                    </select>
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
                                <div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Guardar',['class' => 'btn btn-primary btn-block']) !!}
                                </div>
                            </div><br>
                        <!--<div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>Resultado de la Determinación del Control </label>
                                    <input type="text" class="form-control" name="resultado" placeholder="Descripción" required>
                                </div>
                                <div class="col-xs-6 form-group">
                                    <label>Riesgo controlado suficientemente </label>
                                    <input type="text" class="form-control" name="controlado" placeholder="Descripción" required>
                                </div>
                                <div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Registrar',['class' => 'btn btn-success btn-block']) !!}
                                </div>
                            </div>-->
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
    {!! JsValidator::formRequest('App\Http\Requests\controlRequest','#altaControl') !!}
@endsection

@section('javascrpt')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#riesgo").on('change', function(){
                var sec = $(this).val();
                if(sec) {
                    $.ajax({
                        url: '/control-interno/factores/'+sec,
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            var html_select = '<option selected="true" disabled="disabled">Seleccione un Factor</option>';
                            for (var i=0; i<data.length ;++i)
                                html_select += '<option value="'+data[i].num_factor_riesgo+'">'+data[i].desc_factor_riesgo+'</option>';
                            $('#factor').html(html_select);
                        }
                    });
                }else{
                    var html_select = '<option selected="true" disabled="disabled">Seleccione un Factor</option>';
                    $("#factor").html(html_select);
                }
            });
        });
    </script>
@endsection