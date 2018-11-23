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
        Instructivo del Proceso de Evaluación
        <small> (Ejemplo)</small>
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
                <div class="box-tools pull-right">
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-12">
                  <!--<b style="color:red;">¡Importante!</b><br>-->
                  <b>% Ponderación = Σ {valoraciones | valoración ∈ NGCI } / Total de elementos de control  ∈ NGCI</b><br>
                  Ponderación = sumatoria de todo el conjunto de valoraciones, tal que, cada valoración pertenece a NGCI, dividido entre la cantidad total de elementos de control (TEC) que pertenecen a cada NGCI.<br>
                  (La siguiente tabla es una ponderación ejemplo).
                </div>
              </div>
              <table id="tabla1" class="table table-striped table-bordered table-sm">
                <thead style="color: brown;" class="justify">
                  <tr>
                    <th>NGCI</th>
                    <th>Suma total de valoraciones</th>
                    <th>Cantidad de elementos de control</th>
                    <th>Ponderación (%)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1.- AMBIENTE DE CONTROL</td>
                    <td>400</td>
                    <td>8</td>
                    <td><a href="#" class="btn btn-success">50 %</a></td>
                  </tr>
                  <tr>
                    <td>2.- ADMINISTRACIÓN DE RIESGOS</td>
                    <td>216.6</td>
                    <td>4</td>
                    <td><a href="#" class="btn btn-primary">54.15 %</a></td>
                  </tr>
                  <tr>
                    <td>3.- ACTIVIDADES DE CONTROL</td>
                    <td>716.6</td>
                    <td>12</td>
                    <td><a href="#" class="btn btn-primary">59.71 %</a></td>
                  </tr>
                  <tr>
                    <td>4.- INFORMAR Y COMUNICAR</td>
                    <td>299.9</td>
                    <td>6</td>
                    <td><a href="#" class="btn btn-success">49.98 %</a></td>
                  </tr>
                  <tr>
                    <td>5.- SUPERVISION Y MEJORA CONTINUA</td>
                    <td>200</td>
                    <td>3</td>
                    <td><a href="#" class="btn btn-primary">66.66 %</a></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="text-align:right;">TOTAL</td>
                    <td colspan="2" style="text-align:left;">33</td>
                  </tr>
                </tbody>
              </table>
              <br>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Criterios de Rangos de Ponderación para determinar el color del semáforo.</h3>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                      <br>Si la <b>ponderación</b> es mayor o igual a 0.0% y menor o igual a 16.7%, resaltará en color <b style="color:red;">rojo</b>.<br><br><br>
                      Si la <b>ponderación</b> es mayor o igual a 16.8% y menor o igual a 33.3%, resaltará en color <b style="color:orange;">naranja</b>.<br><br><br>
                      Si la <b>ponderación</b> es mayor o igual a 33.4% y menor o igual a 50.0%, se resaltará en color <b style="color:green;">verde</b>.<br><br><br>
                      Si la <b>ponderación</b> es mayor o igual a 50.1% y menor o igual a 66.7%, se resaltará en color <b style="color:blue;">azul</b>.<br><br><br>
                      Si la <b>ponderación</b> es mayor o igual a 66.8% y menor o igual a 83.3%, se resaltará en color <b style="color:deepskyblue;">azul claro</b>.<br><br><br>
                      Si la <b>ponderación</b> es mayor o igual a 83.4% y menor o igual a 100.0%, se resaltará en color <b style="color:gray;">gris</b>.<br><br><br>
                    </div>
                  </div>
                </div>
                <div class="box-tools pull-right">
                  <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box">
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Gráfica de ejemplo: Ponderación de NGCI</h3>
                <div class="box-tools pull-right">
                  <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                      <b style="color:green;">1.- AMBIENTE DE CONTROL: 50%</b><br>
                      <b style="color:dodgerblue;">2.- ADMINISTRACIÓN DE RIESGOS: 54.15%</b><br>
                      <b style="color:dodgerblue;">3.- ACTIVIDADES DE CONTROL: 59.71%</b><br>
                      <b style="color:green;">4.- INFORMAR Y COMUNICAR: 49.98%</b><br>
                      <b style="color:dodgerblue;">5.- SUPERVISIÓN Y MEJORA CONTINUA: 66.66%</b><br>
                    </div>
                  </div><br>
                  <canvas id="pieChart" style="height:250px"></canvas>
                </div>
              </div>
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
              <!--<small class="pull-right"><a class="btn btn-success btn-xs" href="{{ route('download') }}" style="margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL</a></small>
              <small class="pull-right" style="margin-right: 5px;">Exportar </small>-->
            </div>
            <div class="box-body">
              <table id="tabla1" class="table table-striped table-bordered table-sm">
                <thead style="color: brown;" class="justify">
                  <tr>
                    <th rowspan="2">CLAVE</th>
                    <th rowspan="2">PROCESO</th>
                    <th rowspan="2">TIPO</th>
                    <th rowspan="2">DEPEN. / ORG. AUX. RESPONSABLE</th>
                    <th rowspan="2">U. ADMON. RESPONSABLE</th>
                    <th rowspan="2">RESPONSABLE</th>
                    <th colspan="6" style="text-align:center;">NORMAS GENERALES DE CONTROL INTERNO (NGCI)</th>
                  </tr>
                  <tr>
                    @foreach($apartados as $apartado)
                      <th>{{$apartado->desc_ngci}}</th>
                    @endforeach
                      <th>TOTAL</th>
                      <th>CÉDULA</th>
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
                      @if($proceso->total >= 0 AND $proceso->total <= 16.79)
                        <th><a href="#" class="btn btn-danger"><b>{{$proceso->total}}%</b></a></th>
                      @else
                        @if($proceso->total >= 16.80 AND $proceso->total <= 33.39)
                          <th><a href="#" class="btn btn-warning"><b>{{$proceso->total}}%</b></a></th>
                        @else
                          @if($proceso->total >= 33.40 AND $proceso->total <= 50.09)
                            <th><a href="#" class="btn btn-success"><b>{{$proceso->total}}%</b></a></th>
                          @else
                            @if($proceso->total >= 50.1 AND $proceso->total <= 66.79)
                              <th><a href="#" class="btn btn-primary"><b>{{$proceso->total}}%</b></a></th>
                            @else
                              @if($proceso->total >= 66.8 AND $proceso->total <= 83.39)
                                <th><a href="#" class="btn btn-info"><b>{{$proceso->total}}%</b></a></th>
                              @else
                                @if($proceso->total >= 83.4 AND $proceso->total <= 100)
                                  <th><a href="#" class="btn btn-default"><b>{{$proceso->total}}%</b></a></th>
                                @else
                                @endif
                              @endif
                            @endif
                          @endif
                        @endif
                      @endif
                      <td><a href="{{route('Verpdf',$proceso->cve_proceso)}}" class="btn btn-warning" title="Ver Cédula de Evaluación"><i class="fa fa-file-text-o"></i></a></td>
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
  <script src="{{ asset('bower_components/chart.js/Chart.js') }}"></script>
@endsection

@section('javascrpt')
  <script>
      $(function(){
          //-------------
          //- PIE CHART -
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
          var pieChart       = new Chart(pieChartCanvas);
          var PieData        = [
              {
                  value    : 50,
                  color    : 'green',
                  highlight: 'green',
                  label    : 'AMBIENTE DE CONTROL'
              },
              {
                  value    : 54.15,
                  color    : 'dodgerblue',
                  highlight: 'dodgerblue',
                  label    : 'ADMINISTRACIÓN DE RIESGOS'
              },
              {
                  value    : 59.71,
                  color    : 'dodgerblue',
                  highlight: 'dodgerblue',
                  label    : 'ACTIVIDADES DE CONTROL'
              },
              {
                  value    : 49.98,
                  color    : 'green',
                  highlight: 'green',
                  label    : 'INFORMAR Y COMUNICAR'
              },
              {
                  value    : 66.66,
                  color    : 'dodgerblue',
                  highlight: 'dodgerblue',
                  label    : 'SUPERVISIÓN Y MEJORA CONTINUA'
              }
          ];
          var pieOptions     = {
              //Boolean - Whether we should show a stroke on each segment
              segmentShowStroke    : true,
              //String - The colour of each segment stroke
              segmentStrokeColor   : '#fff',
              //Number - The width of each segment stroke
              segmentStrokeWidth   : 2,
              //Number - The percentage of the chart that we cut out of the middle
              percentageInnerCutout: 50, // This is 0 for Pie charts
              //Number - Amount of animation steps
              animationSteps       : 100,
              //String - Animation easing effect
              animationEasing      : 'easeOutBounce',
              //Boolean - Whether we animate the rotation of the Doughnut
              animateRotate        : true,
              //Boolean - Whether we animate scaling the Doughnut from the centre
              animateScale         : false,
              //Boolean - whether to make the chart responsive to window resizing
              responsive           : true,
              // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio  : true
              //String - A legend template
          };
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          pieChart.Doughnut(PieData, pieOptions)
      })
  </script>
@endsection