@extends('sicinar.principal')

@section('title','Nuevo Acción de Mejora')

@section('links')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
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
                Nueva Acción de Mejora
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Plan de Trabajo</a></li>
                <li class="active">Nueva Acción de Mejora</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h4 class="box-title"><b style="color:gray;">La Acción de Mejora a agregar / editar pertenece a la siguiente NGCI</b></h4>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-striped table-bordered table-sm">
                                        <thead style="color: brown;" class="justify">
                                            <tr>
                                                <th colspan="2" style="background-color:black;text-align:center;"><h5 style="color:white;">{{$pregunta[0]->cve_ngci}}.- {{$pregunta[0]->desc_ngci}}</h5></th>
                                            </tr>
                                            <tr>
                                                <th style="background-color:darkred;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">No.</b></th>
                                                <th style="background-color:darkred;text-align:center;vertical-align: middle;"><b style="color:white;">Elemento de Control</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="background-color:darkgreen;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">{{$pregunta[0]->num_eci}}</b></td>
                                                <td style="text-align:justify;vertical-align: middle;"><b style="color:black;font-size:small;">{{$pregunta[0]->preg_eci}}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h4 class="box-title"><b style="color:gray;">Estos son los procesos que pertenecen a esta Unidad Administrativa</b></h4>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-striped table-bordered table-sm">
                                        <thead style="color: brown;" class="justify">
                                        <tr>
                                            <th colspan="2" style="background-color:dodgerblue;text-align:center;"><h5 style="color:white;">Procesos dados de alta</h5></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:gray;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">Proceso</b></th>
                                            <th style="background-color:gray;text-align:center;vertical-align: middle;"><b style="color:white;">Descripción</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($procesos as $proceso)
                                            <tr>
                                                <td style="background-color:cornflowerblue;text-align:center;vertical-align: middle;width: 5px;"><b style="color:white;">{{$proceso->cve_proceso}}</b></td>
                                                <td style="text-align:justify;vertical-align: middle;"><b style="color:black;font-size:small;">{{$proceso->desc_proceso}}</b></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::open(['route' => ['altaAccion',$pregunta[0]->num_eci], 'method' => 'PUT', 'id' => 'altaAccion']) !!}
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Nueva Acción de Mejora</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>% Cumplimiento Si / No </label>
                                        <select class="form-control m-bot15" name="cumplimiento1" required>
                                            @foreach($grados as $grado)
                                                @if($grado->cve_grado_cump == $accion->num_meec)
                                                    <option value="{{$grado->cve_grado_cump}}" selected>{{$grado->porc_meec}}% - {{$grado->desc_grado_cump}}</option>
                                                @else
                                                    <option value="{{$grado->cve_grado_cump}}">{{$grado->porc_meec}}% - {{$grado->desc_grado_cump}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>% Cumplimiento con base en la Evidencia</label>
                                        <select class="form-control m-bot15" name="cumplimiento2" required>
                                            @foreach($grados as $grado)
                                                @if($grado->cve_grado_cump == $accion->num_meec_2)
                                                    <option value="{{$grado->cve_grado_cump}}" selected>{{$grado->porc_meec}}% - {{$grado->desc_grado_cump}}</option>
                                                @else
                                                    <option value="{{$grado->cve_grado_cump}}">{{$grado->porc_meec}}% - {{$grado->desc_grado_cump}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label >Proceso</label>
                                            <input type="text" class="form-control" name="procesos" placeholder="Proceso" value="{{$accion->procesos}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Número de Acción de Mejora</label>
                                        <input type="text" class="form-control" name="no" placeholder="Número de Acción de Mejora" value="{{$accion->no_acc_mejora}}" required>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label>Acción de Mejora</label>
                                        <input type="text" class="form-control" name="accion" placeholder="Acción de Mejora" value="{{$accion->desc_acc_mejora}}" required>
                                        @if ($errors->has('accion'))
                                            <span class="text-danger">{{ $errors->first('accion') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Fecha de Inicio:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker1" value="{!! date('d/m/Y',strtotime($accion->fecha_ini)) !!}" name="fecha_ini">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Fecha de Término:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker2" value="{!! date('d/m/Y',strtotime($accion->fecha_ter)) !!}" name="fecha_fin">
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label>Responsable</label>
                                        <select class="form-control m-bot15" name="responsable" required>
                                            @foreach($servidores as $servidor)
                                                @if($servidor->id_sp == $accion->id_sp)
                                                    <option value="{{$servidor->id_sp}}" selected>{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @else
                                                    <option value="{{$servidor->id_sp}}">{{$servidor->unid_admon}} - {{$servidor->nombres}} {{$servidor->paterno}} {{$servidor->materno}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Medios de Verificación</label>
                                        <input type="text" class="form-control" name="medios" placeholder="Medios de Verificación" value="{{$accion->medios_verificacion}}" required>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12 offset-md-5">
                                    <button type="submit" class="btn btn-primary btn-block">Agregar Acción de Mejora</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </section>
    </div>
@endsection

@section('request')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\accionRequest','#altaAccion') !!}
@endsection

@section('javascrpt')
    <script>
        $(function () {
            //Date picker
            $('#datepicker1').datepicker({
                format: "dd/mm/yyyy",
                startDate: "today",
                startView: 2,
                maxViewMode: 2,
                clearBtn: true,
                language: "es",
                autoclose: true
            })

            $('#datepicker2').datepicker({
                format: "dd/mm/yyyy",
                startDate: "tomorrow",
                startView: 2,
                maxViewMode: 2,
                clearBtn: true,
                language: "es",
                autoclose: true
            })
        })
    </script>
@endsection