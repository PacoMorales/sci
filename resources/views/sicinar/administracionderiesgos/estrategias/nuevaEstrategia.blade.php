@extends('sicinar.principal')

@section('title','Nueva Estrategia')

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
                V. Estrategias para evitar el Riesgo
                <small>Generar nueva estrategia</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Estrategias para evitar el Riesgo</a></li>
                <li class="active">Nuevo</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Estrategias para evitar el Riesgo</h3>
                        </div>
                        {!! Form::open(['route' => 'altaEstrategia', 'method' => 'POST', 'id' => 'altaEstrategia']) !!}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Riesgo</label>
                                    <select class="form-control m-bot15" name="riesgo" id="riesgo" required>
                                        <option selected="true" value="0">Seleccione un Riesgo</option>
                                        @foreach($riesgos as $riesgo)
                                            <option value="{{$riesgo->cve_riesgo}}" name="riesgo">{{$riesgo->desc_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-6 form-group">
                                    <label>* Factor</label>
                                    <select class="form-control m-bot15" name="factor" id="factor" required>
                                    </select><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Estrategia para Administrar el Riesgo</label>
                                    <select class="form-control m-bot15" name="estrategia" required>
                                        @foreach($estrategias as $estrategia)
                                            <option value="{{$estrategia->cve_admon_riesgo}}" name="estrategia">{{$estrategia->desc_admon_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-6 form-group">
                                    <label>* Descripción de la(s) Acción(es)</label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción de la(s) Acción(es)" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    <label>Servidor Público a cargo de la Estrategia / Acción</label>
                                    <select class="form-control m-bot15" name="sp" required>
                                        @foreach($servidores as $servidor)
                                            @if($servidor->id_sp == '999999999')
                                                <option value="{{$servidor->id_sp}}" name="sp" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                            @else
                                                <option value="{{$servidor->id_sp}}" name="sp">{{$servidor->unid_admon}} - {{$servidor->paterno}} {{$servidor->materno}} {{$servidor->nombres}}</option>
                                            @endif
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
    {!! JsValidator::formRequest('App\Http\Requests\estrategiasRequest','#altaEstrategia') !!}
@endsection

@section('javascrpt')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#riesgo").on('change', function(){
                var sec = $(this).val();
                if(sec) {
                    $.ajax({
                        url: '/control-interno/estrategias/factores/'+sec,
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