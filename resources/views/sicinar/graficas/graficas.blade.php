@extends('sicinar.principal')

@section('title','Gráficas de Procesos')

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
                Unidad Administrativa: Secretaría de Desarrollo Social
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Gráficas</a></li>
                <li class="active">Ver Gráficas</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Gráfica por Tipo de Proceso</h3>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <b style="color:red;">{{$procesos[0]->tipo}}: {{$procesos[0]->total}}</b><br>
                                            <b style="color:green;">{{$procesos[1]->tipo}}: {{$procesos[1]->total}}</b><br>
                                            <b style="color:deepskyblue;">{{$procesos[2]->tipo}}: {{$procesos[2]->total}}</b><br>
                                        </div>
                                    </div>
                                </div>

                            <div class="box-tools pull-right">
                                <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart" style="height:250px"></canvas>
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
                value    : <?php echo $procesos[0]->total;?>,
                color    : '#f56954',
                highlight: '#f56954',
                label    : '<?php echo $procesos[0]->tipo;?>'
              },
              {
                value    : <?php echo $procesos[1]->total;?>,
                color    : '#00a65a',
                highlight: '#00a65a',
                label    : '<?php echo $procesos[1]->tipo;?>'
              },
              {
                value    : <?php echo $procesos[2]->total;?>,
                color    : '#00c0ef',
                highlight: '#00c0ef',
                label    : '<?php echo $procesos[2]->tipo;?>'
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