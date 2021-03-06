@extends('sicinar.principal')

@section('title','Editar Estrategia')

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
                <small>Editar estrategia</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Estrategias para evitar el Riesgo</a></li>
                <li class="active">Editar</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Estrategias para evitar el Riesgo</h3>
                        </div>
                        {!! Form::open(['route' => ['actualizarEstrategia',$estrateg->cve_accion], 'method' => 'PUT', 'id' => 'actualizarEstrategia']) !!}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Estrategia para Administrar el Riesgo</label>
                                    <select class="form-control m-bot15" name="estrategia" required>
                                        @foreach($estrategias as $estrategia)
                                            @if($estrateg->cve_admon_riesgo == $estrategia->cve_admon)
                                                <option value="{{$estrategia->cve_admon_riesgo}}" name="estrategia" selected>{{$estrategia->desc_admon_riesgo}}</option>
                                            @else
                                                <option value="{{$estrategia->cve_admon_riesgo}}" name="estrategia">{{$estrategia->desc_admon_riesgo}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-6 form-group">
                                    <label>* Descripción de la(s) Acción(es)</label>
                                    <input type="text" class="form-control" name="descripcion" value="{{$estrateg->desc_accion}}" placeholder="Descripción de la(s) Acción(es)" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    <label>Servidor Público a cargo de la Estrategia / Acción</label>
                                    <select class="form-control m-bot15" name="sp" required>
                                        @foreach($servidores as $servidor)
                                            @if($servidor->id_sp == $estrateg->id_sp)
                                                <option value="{{$servidor->id_sp}}" name="sp" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                            @else
                                                <option value="{{$servidor->id_sp}}" name="sp">{{$servidor->unid_admon}} - {{$servidor->paterno}} {{$servidor->materno}} {{$servidor->nombres}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                            </div>
                            <div class="col-md-12 offset-md-5">
                                {!! Form::submit('Actualizar',['class' => 'btn btn-primary btn-block']) !!}
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
    {!! JsValidator::formRequest('App\Http\Requests\editarEstrategiaRequest','#actualizarEstrategia') !!}
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