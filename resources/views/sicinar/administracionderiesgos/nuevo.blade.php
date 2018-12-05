@extends('sicinar.principal')

@section('title','Nuevo Riesgo')

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
                <small>Generar nuevo riesgo</small>
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
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Nueva Evaluación de Riesgos</h3>
                        </div>
                        {!! Form::open(['route' => 'altaRiesgo', 'method' => 'POST', 'id' => 'altaRiesgo']) !!}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label>* Secretaría </label>
                                    <select class="form-control m-bot15" name="estructura" required>
                                        <option value="21500" name="estructura">Secretaría de Desarrollo Social</option>
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Unidad Administrativa </label>
                                    <select class="form-control m-bot15" name="unidad" required>
                                        @foreach($unidades as $unidad)
                                            <option value="{{$unidad->depen_id}}" name="unidad">{{$unidad->depen_desc}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Alineación a Estrategias, Objetivos o Metas</label>
                                    <select class="form-control m-bot15" name="seleccion" required>
                                        @foreach($clases as $clase)
                                            <option value="{{$clase->cve_clase_riesgo}}" name="unidad">{{$clase->desc_clase_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Descripción </label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Titular de la Unidad Administrativa<b style="color:deepskyblue;"> (Para habilitar las casillas siguientes elige la opción SIN ESPECIFICAR)</b></label>
                                    <select class="form-control m-bot15" name="titular" onchange="tit(this);" required>
                                        @foreach($servidores as $servidor)
                                            <option value="{{$servidor->id_sp}}" name="unidad">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Nombre del Titular de la Unidad Administrativa</label>
                                    <input type="text" class="form-control" name="titular_aux" id="titular_aux" placeholder="Nombre del Titular" disabled required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Clave de Servidor Público del Titular de la Unidad Administrativa</label>
                                    <input type="text" class="form-control" name="id_sp_aux" id="id_sp_aux" placeholder="Clave de Servidor Público del Titular" disabled required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Coordinador<b style="color:deepskyblue;"> (Para habilitar las casillas siguientes elige la opción SIN ESPECIFICAR)</b></label>
                                    <select class="form-control m-bot15" name="coordinador" onchange="coor(this);" required>
                                        @foreach($servidores as $servidor)
                                            <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Nombre del Coordinador</label>
                                    <input type="text" class="form-control" name="coor_aux" id="coor_aux" placeholder="Nombre del Coordinador" disabled required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Clave de Servidor Público del Coordinador</label>
                                    <input type="text" class="form-control" name="id_sp_coor" id="id_sp_coor" placeholder="Clave de Servidor Público del Coordinador" disabled required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Enlace <b style="color:deepskyblue;"> (Para habilitar las casillas siguientes elige la opción SIN ESPECIFICAR)</b></label>
                                    <select class="form-control m-bot15" name="enlace" onchange="enl(this);" required>
                                        @foreach($servidores as $servidor)
                                            <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Nombre del Enlace</label>
                                    <input type="text" class="form-control" name="enlace_aux" id="enlace_aux" placeholder="Nombre del Enlace" disabled required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Clave de Servidor Público del Enlace</label>
                                    <input type="text" class="form-control" name="id_sp_enlace" id="id_sp_enlace" placeholder="Clave de Servidor Público del Enlace" disabled required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label>* Riesgo </label>
                                    <input type="text" class="form-control" name="riesgo" placeholder="Riesgo" required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Nivel de Decisión del Riesgo </label>
                                    <select class="form-control m-bot15" name="decision" required>
                                        @foreach($niveles as $nivel)
                                            <option value="{{$nivel->cve_nivel_decriesgo}}" name="unidad">{{$nivel->desc_decriesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Clasificación del Riesgo </label>
                                    <select class="form-control m-bot15" name="clasificacion" id="clasificacion" onchange="carg(this);" required>
                                        @foreach($clasificaciones as $clasif)
                                            <option value="{{$clasif->cve_clasif_riesgo}}">{{$clasif->desc_clasif_riesgo}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Especificar otro</label>
                                    <input type="text" class="form-control" name="otro" id="otro" placeholder="Especificar otro..." disabled required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Posibles Efectos del Riesgo </label>
                                    <input type="text" class="form-control" name="efectos" placeholder="Posibles Efectos del Riesgo" required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Grado de Impacto </label>
                                    <select class="form-control m-bot15" name="impacto" required>
                                        @foreach($grados as $grado)
                                            <option value="{{$grado->grado_impacto}}" name="unidad">{{$grado->grado_impacto}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Probabilidad de Ocurrencia </label>
                                    <select class="form-control m-bot15" name="ocurrencia" required>
                                        @foreach($probabilidades as $probabilidad)
                                            <option value="{{$probabilidad->escala_valor}}" name="unidad">{{$probabilidad->escala_valor}}</option>
                                        @endforeach
                                    </select><br>
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
    <script type="text/javascript">
        var titular = document.getElementById('titular_aux');
        var id_sp = document.getElementById('id_sp_aux');
        function tit(elemento) {
            t = elemento.value;
            if(t == "999999999"){
                titular.disabled = false;
                id_sp.disabled = false;
            }else{
                titular.disabled = true;
                id_sp.disabled = true;
            }
        }

        var cor = document.getElementById('coor_aux');
        var id_sp_coor = document.getElementById('id_sp_coor');
        function coor(elemento) {
            c = elemento.value;
            if(c == "999999999"){
                cor.disabled = false;
                id_sp_coor.disabled = false;
            }else{
                cor.disabled = true;
                id_sp_coor.disabled = true;
            }
        }

        var enlace = document.getElementById('enlace_aux');
        var id_sp_enlace = document.getElementById('id_sp_enlace');
        function enl(elemento) {
            e = elemento.value;
            if(e == "999999999"){
                enlace.disabled = false;
                id_sp_enlace.disabled = false;
            }else{
                enlace.disabled = true;
                id_sp_enlace.disabled = true;
            }
        }

        var input = document.getElementById('otro');
        function carg(elemento) {
            d = elemento.value;
            if(d == "99"){
                input.disabled = false;
            }else{
                input.disabled = true;
            }
        }
    </script>
@endsection