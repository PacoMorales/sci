@extends('sicinar.principal')

@section('title','Evaluación de Procesos')

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
        Procesos Evaluados
        <small> por sistema</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
        <li><a href="#">Procesos</a></li>
        <li class="active">Ver Procesos</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Ponderación de Normas Generales de Control Interno (NGCI)</b></h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-12">
                  <!--<b style="color:red;">¡Importante!</b><br>-->
                  <b>Ponderación = Σ {valoraciones | valoración ∈ NGCI } / total de elementos de control  ∈ NGCI</b><br>
                  Ponderación = sumatoria de todo el conjunto de valoraciones, tal que, cada valoración pertenece a NGCI, dividido entre la cantidad total de elementos de control que pertenecen a cada NGCI.<br>
                  (La siguiente tabla es una ponderación ejemplo).
                </div>
              </div>
              <table id="tabla1" class="table table-striped table-bordered table-sm">
                <thead style="color: brown;" class="justify">
                  <tr>
                    <th>NGCI</th>
                    <th>Suma total de valoraciones (%)</th>
                    <th>Cantidad de elementos de control</th>
                    <th>Ponderación (%)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1.- AMBIENTE DE CONTROL</td>
                    <td>400 %</td>
                    <td>8</td>
                    <td>50 %</td>
                  </tr>
                  <tr>
                    <td>2.- ADMINISTRACIÓN DE RIEZGOS</td>
                    <td>216.6 %</td>
                    <td>4</td>
                    <td>54.15 %</td>
                  </tr>
                  <tr>
                    <td>3.- ACTIVIDADES DE CONTROL</td>
                    <td>716.6 %</td>
                    <td>12</td>
                    <td>59.71 %</td>
                  </tr>
                  <tr>
                    <td>4.- INFORMAR Y COMUNICAR</td>
                    <td>299.9 %</td>
                    <td>6</td>
                    <td>49.98 %</td>
                  </tr>
                  <tr>
                    <td>5.- SUPERVISION Y MEJORA CONTINUA</td>
                    <td>200 %</td>
                    <td>3</td>
                    <td>66.66 %</td>
                  </tr>
                </tbody>
              </table>
              <br>
              <div class="row">
                <div class="col-xs-12">
                  <b>Semáforos</b><br>
                  Si la <b>ponderación</b> es mayor o igual a 0.0% y menor o igual a 16.7%, resaltará en color <b style="color:red;">rojo</b>.<br>
                  Si la <b>ponderación</b> es mayor o igual a 16.8% y menor o igual a 33.3%, resaltará en color <b style="color:orange;">naranja</b>.<br>
                  Si la <b>ponderación</b> es mayor o igual a 33.4% y menor o igual a 50.0%, se resaltará en color <b style="color:green;">verde</b>.<br>
                  Si la <b>ponderación</b> es mayor o igual a 50.1% y menor o igual a 66.7%, se resaltará en color <b style="color:blue;">azul</b>.<br>
                  Si la <b>ponderación</b> es mayor o igual a 66.8% y menor o igual a 83.3%, se resaltará en color <b style="color:deepskyblue;">azul claro</b>.<br>
                  Si la <b>ponderación</b> es mayor o igual a 83.4% y menor o igual a 100.0%, se resaltará en color <b style="color:gray;">gris</b>.<br>
                </div>
              </div>
              <!--<div class="margin">
                <div class="btn-group">
                  <div class="col-md-6">
                    <a href="#" class="btn btn-success"><span>Confirmar </span><i class="fa fa-check"></i></a>
                  </div>
                  <div class="col-md-6">
                    <a href="#" class="btn btn-info"><span>Verificar </span><i class="fa fa-share"></i></a>
                  </div>
                  <br>
                </div>
              </div>-->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>Ponderación de Normas Generales de Control Interno (NGCI)</b></h3>
              <br>Cantidad total de procesos evaluados: {{$total}}
              <!--<small class="pull-right"><a class="btn btn-danger btn-xs" href="{{ route('generarpdf',$procesos[0]->cve_proceso) }}" style="margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</a></small>
              <small class="pull-right"><a class="btn btn-success btn-xs" href="{{ route('download') }}" style="margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL</a></small>
              <small class="pull-right" style="margin-right: 5px;">Exportar </small>-->
            </div>
            <div class="box-body">
              <table id="tabla1" class="table table-striped table-bordered table-sm">
                <thead style="color: brown;" class="justify">
                  <tr>
                    <th rowspan="2">CLAVE</th>
                    <th rowspan="2">PROCESO</th>
                    <th rowspan="2">TIPO</th>
                    <th rowspan="2">SECRETARÍA RESPONSABLE</th>
                    <th rowspan="2">UNIDAD RESPONSABLE</th>
                    <th rowspan="2">RESPONSABLE</th>
                    <th colspan="6" style="text-align:center;">NORMAS GENERALES DE CONTROL INTERNO (NGCI)</th>
                  </tr>
                  <tr>
                    @foreach($apartados as $apartado)
                      <th>{{$apartado->desc_ngci}}</th>
                    @endforeach
                      <th>TOTAL</th>
                      <!--<th>CÉDULA</th>-->
                  </tr>
                </thead>
                <tbody>
                  @foreach($procesos as $proceso)
                    <tr>
                      <td>{{$proceso->cve_proceso}}</td>
                      <td>{{$proceso->desc_proceso}}</td>
                      @foreach($tipos as $tipo)
                        @if($proceso->cve_tipo_proc == $tipo->cve_tipo_proc)
                          <td>{{$tipo->desc_tipo_proc}}</td>
                          @break
                        @endif
                      @endforeach

                      @foreach($estructuras as $est)
                        @if(strpos((string)$est->estrucgob_id,(string)$proceso->estrucgob_id)!==false)
                          <td>{{$est->estrucgob_desc}}</td>
                          @break
                        @endif
                      @endforeach                      

                      @foreach($dependencias as $dependencia)
                        @if(rtrim($dependencia->depen_id," ") == $proceso->cve_dependencia)
                          <td>{{$dependencia->depen_desc}}</td>
                          @break
                        @endif
                        @if($loop->last)
                          <td>NO ASIGNADO</td>
                        @endif
                      @endforeach

                      <td>{{$proceso->responsable}}</td>
                      @if($proceso->pond_ngci1 >= 0 AND $proceso->pond_ngci1 <= 16.79)
                        <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci1 >= 16.80 AND $proceso->pond_ngci1 <= 33.39)
                          <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci1 >= 33.40 AND $proceso->pond_ngci1 <= 50.09)
                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                          @else
                            @if($proceso->pond_ngci1 >= 50.1 AND $proceso->pond_ngci1 <= 66.79)
                              <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                            @else
                              @if($proceso->pond_ngci1 >= 66.8 AND $proceso->pond_ngci1 <= 83.39)
                                <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                              @else
                                @if($proceso->pond_ngci1 >= 83.4 AND $proceso->pond_ngci1 <= 100)
                                  <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                                @else
                                @endif
                              @endif
                            @endif
                          @endif
                        @endif
                      @endif
                      @if($proceso->pond_ngci2 >= 0 AND $proceso->pond_ngci2 <= 16.79)
                        <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci2 >= 16.80 AND $proceso->pond_ngci2 <= 33.39)
                          <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci2 >= 33.40 AND $proceso->pond_ngci2 <= 50.09)
                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                          @else
                            @if($proceso->pond_ngci2 >= 50.1 AND $proceso->pond_ngci2 <= 66.79)
                              <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                            @else
                              @if($proceso->pond_ngci2 >= 66.8 AND $proceso->pond_ngci2 <= 83.39)
                                <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                              @else
                                @if($proceso->pond_ngci2 >= 83.4 AND $proceso->pond_ngci2 <= 100)
                                  <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                                @else
                                @endif
                              @endif
                            @endif
                          @endif
                        @endif
                      @endif
                      @if($proceso->pond_ngci3 >= 0 AND $proceso->pond_ngci3 <= 16.79)
                        <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci3 >= 16.80 AND $proceso->pond_ngci3 <= 33.39)
                          <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci3 >= 33.40 AND $proceso->pond_ngci3 <= 50.09)
                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                          @else
                            @if($proceso->pond_ngci3 >= 50.1 AND $proceso->pond_ngci3 <= 66.79)
                              <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                            @else
                              @if($proceso->pond_ngci3 >= 66.8 AND $proceso->pond_ngci3 <= 83.39)
                                <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                              @else
                                @if($proceso->pond_ngci3 >= 83.4 AND $proceso->pond_ngci3 <= 100)
                                  <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                                @else
                                @endif
                              @endif
                            @endif
                          @endif
                        @endif
                      @endif
                      @if($proceso->pond_ngci4 >= 0 AND $proceso->pond_ngci4 <= 16.79)
                        <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci4 >= 16.80 AND $proceso->pond_ngci4 <= 33.39)
                          <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci4 >= 33.40 AND $proceso->pond_ngci4 <= 50.09)
                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                          @else
                            @if($proceso->pond_ngci4 >= 50.1 AND $proceso->pond_ngci4 <= 66.79)
                              <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                            @else
                              @if($proceso->pond_ngci4 >= 66.8 AND $proceso->pond_ngci4 <= 83.39)
                                <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                              @else
                                @if($proceso->pond_ngci4 >= 83.4 AND $proceso->pond_ngci4 <= 100)
                                  <th><a href="#" class="btn btn default"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                                @else
                                @endif
                              @endif
                            @endif
                          @endif
                        @endif
                      @endif
                      @if($proceso->pond_ngci5 >= 0 AND $proceso->pond_ngci5 <= 16.79)
                        <th><a href="#" class="btn btn-danger"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci5 >= 16.80 AND $proceso->pond_ngci5 <= 33.39)
                          <th><a href="#" class="btn btn-warning"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci5 >= 33.40 AND $proceso->pond_ngci5 <= 50.09)
                            <th><a href="#" class="btn btn-success"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                          @else
                            @if($proceso->pond_ngci5 >= 50.1 AND $proceso->pond_ngci5 <= 66.79)
                              <th><a href="#" class="btn btn-primary"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                            @else
                              @if($proceso->pond_ngci5 >= 66.8 AND $proceso->pond_ngci5 <= 83.39)
                                <th><a href="#" class="btn btn-info"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                              @else
                                @if($proceso->pond_ngci5 >= 83.4 AND $proceso->pond_ngci5 <= 100)
                                  <th><a href="#" class="btn btn-default"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                                @else
                                @endif
                              @endif
                            @endif
                          @endif
                        @endif
                      @endif
                      <td><b>{{$proceso->total}}%</b></td>
                      <!--<td><a href="{{route('Verpdf',$proceso->cve_proceso)}}" class="btn btn-danger"><i class="fa fa-file-text-o"></i></a></td>-->
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $procesos->appends(request()->input())->links() !!}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('request')
@endsection

@section('javascrpt')
@endsection