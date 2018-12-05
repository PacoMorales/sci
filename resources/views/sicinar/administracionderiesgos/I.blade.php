@extends('sicinar.principal')

@section('title','Editar Apartado I')

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
                <small>Editar riesgo</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Evaluación de Riesgos</a></li>
                <li class="active">Editar Apartado I</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Editar Evaluación de Riesgos</h3>
                        </div>
                        {!! Form::open(['route' => ['actualizarRiesgoI',$riesgo->cve_riesgo], 'method' => 'PUT', 'id' => 'editarRiesgo']) !!}
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
                                            @if(strpos($unidad->depen_id,$riesgo->cve_dependencia) !== false)
                                                <option value="{{$unidad->depen_id}}" name="unidad" selected>{{$unidad->depen_desc}}</option>
                                            @else
                                                <option value="{{$unidad->depen_id}}" name="unidad">{{$unidad->depen_desc}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Alineación a Estrategias, Objetivos o Metas</label>
                                    <select class="form-control m-bot15" name="seleccion" required>
                                        @foreach($clases as $clase)
                                            @if($clase->cve_clase_riesgo == $riesgo->cve_clase_riesgo)
                                                <option value="{{$clase->cve_clase_riesgo}}" selected>{{$clase->desc_clase_riesgo}}</option>
                                            @else
                                                <option value="{{$clase->cve_clase_riesgo}}">{{$clase->desc_clase_riesgo}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Descripción </label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción" value="{{$riesgo->alineacion_riesgo}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Titular de la Unidad Administrativa<b style="color:deepskyblue;"> (Para habilitar las casillas siguientes elige la opción SIN ESPECIFICAR)</b></label>
                                    <select class="form-control m-bot15" name="titular" onchange="tit(this);" required>
                                        @if($riesgo->id_sp_1 == '999999999')
                                            @foreach($servidores as $servidor)
                                                @if(strpos($servidor->id_sp,'999999999')!==false)
                                                    <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @else
                                                    <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($servidores as $servidor)
                                                @if(strpos($servidor->id_sp,$riesgo->id_sp_1)!==false)
                                                    <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @else
                                                    <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @endif
                                                @if($loop->last)
                                                    @foreach($servidores as $servidor)
                                                            @if(strpos($servidor->id_sp,'999999999')!==false)
                                                                <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                            @else
                                                                <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                            @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Nombre del Titular de la Unidad Administrativa</label>
                                    @if($riesgo->id_sp_1 == '999999999')
                                        <input type="text" class="form-control" name="titular_aux" id="titular_aux" placeholder="Nombre del Titular" disabled required>
                                    @else
                                        <input type="text" class="form-control" name="titular_aux" id="titular_aux" value="{{$riesgo->titular}}" placeholder="Nombre del Titular" required>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Clave de Servidor Público del Titular de la Unidad Administrativa</label>
                                    @if($riesgo->id_sp_1 == '999999999')
                                        <input type="text" class="form-control" name="id_sp_aux" id="id_sp_aux" placeholder="Clave de Servidor Público del Titular" disabled required>
                                    @else
                                        <input type="text" class="form-control" name="id_sp_aux" id="id_sp_aux" value="{{$riesgo->id_sp_1}}" placeholder="Clave de Servidor Público del Titular" required>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Coordinador<b style="color:deepskyblue;"> (Para habilitar las casillas siguientes elige la opción SIN ESPECIFICAR)</b></label>
                                    <select class="form-control m-bot15" name="coordinador" onchange="coor(this);" required>
                                        @if($riesgo->id_sp_2 == '999999999')
                                            @foreach($servidores as $servidor)
                                                @if(strpos($servidor->id_sp,'999999999')!==false)
                                                    <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @else
                                                    <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($servidores as $servidor)
                                                @if(strpos($servidor->id_sp,$riesgo->id_sp_2)!==false)
                                                    <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @else
                                                    <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @endif
                                                @if($loop->last)
                                                    @foreach($servidores as $servidor)
                                                        @if(strpos($servidor->id_sp,'999999999')!==false)
                                                            <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                        @else
                                                            <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Nombre del Coordinador</label>
                                    @if($riesgo->id_sp_2 == '999999999')
                                        <input type="text" class="form-control" name="coor_aux" id="coor_aux" placeholder="Nombre del Coordinador" disabled required>
                                    @else
                                        <input type="text" class="form-control" name="coor_aux" id="coor_aux" value="{{$riesgo->coordinador}}" placeholder="Nombre del Coordinador" required>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Clave de Servidor Público del Coordinador</label>
                                    @if($riesgo->id_sp_2 == '999999999')
                                        <input type="text" class="form-control" name="id_sp_coor" id="id_sp_coor" placeholder="Clave de Servidor Público del Coordinador" disabled required>
                                    @else
                                        <input type="text" class="form-control" name="id_sp_coor" id="id_sp_coor" value="{{$riesgo->id_sp_2}}" placeholder="Clave de Servidor Público del Coordinador" required>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Enlace <b style="color:deepskyblue;"> (Para habilitar las casillas siguientes elige la opción SIN ESPECIFICAR)</b></label>
                                    <select class="form-control m-bot15" name="enlace" onchange="enl(this);" required>
                                        @if($riesgo->id_sp_3 == '999999999')
                                            @foreach($servidores as $servidor)
                                                @if(strpos($servidor->id_sp,'999999999')!==false)
                                                    <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @else
                                                    <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($servidores as $servidor)
                                                @if(strpos($servidor->id_sp,$riesgo->id_sp_3)!==false)
                                                    <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @else
                                                    <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @endif
                                                @if($loop->last)
                                                    @foreach($servidores as $servidor)
                                                        @if(strpos($servidor->id_sp,'999999999')!==false)
                                                            <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                        @else
                                                            <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Nombre del Enlace</label>
                                    @if($riesgo->id_sp_3 == '999999999')
                                        <input type="text" class="form-control" name="enlace_aux" id="enlace_aux" placeholder="Nombre del Enlace" disabled required>
                                    @else
                                        <input type="text" class="form-control" name="enlace_aux" id="enlace_aux" value="{{$riesgo->enlace}}" placeholder="Nombre del Enlace" required>
                                    @endif
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Clave de Servidor Público del Enlace</label>
                                    @if($riesgo->id_sp_3 == '999999999')
                                        <input type="text" class="form-control" name="id_sp_enlace" id="id_sp_enlace" placeholder="Clave de Servidor Público del Enlace" disabled required>
                                    @else
                                        <input type="text" class="form-control" name="id_sp_enlace" id="id_sp_enlace" value="{{$riesgo->id_sp_3}}" placeholder="Clave de Servidor Público del Enlace" required>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 form-group">
                                    <label>* Riesgo </label>
                                    <input type="text" class="form-control" name="riesgo" value="{{$riesgo->desc_riesgo}}" placeholder="Riesgo" required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Nivel de Decisión del Riesgo </label>
                                    <select class="form-control m-bot15" name="decision" required>
                                        @foreach($niveles as $nivel)
                                            @if($nivel->cve_nivel_decriesgo == $riesgo->cve_nivel_decriesgo)
                                                <option value="{{$nivel->cve_nivel_decriesgo}}" selected>{{$nivel->desc_decriesgo}}</option>
                                            @else
                                                <option value="{{$nivel->cve_nivel_decriesgo}}">{{$nivel->desc_decriesgo}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Clasificación del Riesgo </label>
                                    <select class="form-control m-bot15" name="clasificacion" id="clasificacion" onchange="carg(this);" required>
                                        @foreach($clasificaciones as $clasif)
                                            @if($clasif->cve_clasif_riesgo == $riesgo->cve_clasif_riesgo)
                                                <option value="{{$clasif->cve_clasif_riesgo}}" selected>{{$clasif->desc_clasif_riesgo}}</option>
                                            @else
                                                <option value="{{$clasif->cve_clasif_riesgo}}">{{$clasif->desc_clasif_riesgo}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>Especificar otro</label>
                                    @if($riesgo->cve_clasif_riesgo == 99)
                                        <input type="text" class="form-control" name="otro" id="otro" value="{{$riesgo->otro_clasif_riesgo}}" placeholder="Especificar otro..." required>
                                    @else
                                        <input type="text" class="form-control" name="otro" id="otro" placeholder="Especificar otro..." disabled required>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 form-group">
                                    <label>* Posibles Efectos del Riesgo </label>
                                    <input type="text" class="form-control" name="efectos" value="{{$riesgo->efectos_riesgo}}" placeholder="Posibles Efectos del Riesgo" required>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Grado de Impacto </label>
                                    <select class="form-control m-bot15" name="impacto" required>
                                        @foreach($grados as $grado)
                                            @if($grado->grado_impacto == $riesgo->grado_impacto)
                                                <option value="{{$grado->grado_impacto}}" selected>{{$grado->grado_impacto}}</option>
                                            @else
                                                <option value="{{$grado->grado_impacto}}">{{$grado->grado_impacto}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label>* Probabilidad de Ocurrencia </label>
                                    <select class="form-control m-bot15" name="ocurrencia" required>
                                        @foreach($probabilidades as $probabilidad)
                                            @if($probabilidad->escala_valor == $riesgo->escala_valor)
                                                <option value="{{$probabilidad->escala_valor}}" selected>{{$probabilidad->escala_valor}}</option>
                                            @else
                                                <option value="{{$probabilidad->escala_valor}}">{{$probabilidad->escala_valor}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="col-md-12 offset-md-5">
                                    {!! Form::submit('Guardar',['class' => 'btn btn-success btn-block']) !!}
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