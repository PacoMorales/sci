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
        Lista de Procesos Evaluados
        <small> en sistema</small>
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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Procesos evaluados: {{$total}}</h3>
            </div>
            <div class="box-body">
              <table id="tabla1" class="table table-striped table-bordered table-sm">
                <thead style="color: brown;" class="justify">
                  <tr>
                    <th>Clave</th>
                    <th>Proceso</th>
                    <th>Tipo</th>
                    <th>Secretaria Responsable</th>
                    <th>Unidad Responsable</th>
                    <th>Responsable</th>
                    <th>Secc. 1</th>
                    <th>Secc. 2</th>
                    <th>Secc. 3</th>
                    <th>Secc. 4</th>
                    <th>Secc. 5</th>
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
                      @if($proceso->pond_ngci1 <= 59.99)
                        <th><a href="#" class="btn btn-danger" title="Bajo"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci1 >= 60.00 AND $proceso->pond_ngci1 <= 79.99)
                          <th><a href="#" class="btn btn-warning" title="Medio"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci1 >= 80.00)
                            <th><a href="#" class="btn btn-success" title="Alto"><b>{{$proceso->pond_ngci1}}%</b></a></th>
                            <!--<th>{{$proceso->pond_ngci1}}</th>-->
                          @else
                            <th>{{$proceso->pond_ngci1}}</th>
                          @endif
                        @endif
                      @endif
                      @if($proceso->pond_ngci2 <= 59.99)
                        <th><a href="#" class="btn btn-danger" title="Bajo"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci2 >= 60.00 AND $proceso->pond_ngci2 <= 79.99)
                          <th><a href="#" class="btn btn-warning" title="Medio"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci2 >= 80.00)
                            <th><a href="#" class="btn btn-success" title="Alto"><b>{{$proceso->pond_ngci2}}%</b></a></th>
                            <!--<th>{{$proceso->pond_ngci1}}</th>-->
                          @else
                            <th>{{$proceso->pond_ngci2}}</th>
                          @endif
                        @endif
                      @endif
                      @if($proceso->pond_ngci3 <= 59.99)
                        <th><a href="#" class="btn btn-danger" title="Bajo"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci3 >= 60.00 AND $proceso->pond_ngci3 <= 79.99)
                          <th><a href="#" class="btn btn-warning" title="Medio"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci3 >= 80.00)
                            <th><a href="#" class="btn btn-success" title="Alto"><b>{{$proceso->pond_ngci3}}%</b></a></th>
                            <!--<th>{{$proceso->pond_ngci1}}</th>-->
                          @else
                            <th>{{$proceso->pond_ngci3}}</th>
                          @endif
                        @endif
                      @endif
                      @if($proceso->pond_ngci4 <= 59.99)
                        <th><a href="#" class="btn btn-danger" title="Bajo"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci4 >= 60.00 AND $proceso->pond_ngci4 <= 79.99)
                          <th><a href="#" class="btn btn-warning" title="Medio"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci4 >= 80.00)
                            <th><a href="#" class="btn btn-success" title="Alto"><b>{{$proceso->pond_ngci4}}%</b></a></th>
                          @else
                            <th>{{$proceso->pond_ngci4}}</th>
                          @endif
                        @endif
                      @endif
                      @if($proceso->pond_ngci5 <= 59.99)
                        <th><a href="#" class="btn btn-danger" title="Bajo"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                      @else
                        @if($proceso->pond_ngci5 >= 60.00 AND $proceso->pond_ngci5 <= 79.99)
                          <th><a href="#" class="btn btn-warning" title="Medio"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                        @else
                          @if($proceso->pond_ngci5 >= 80.00)
                            <th><a href="#" class="btn btn-success" title="Alto"><b>{{$proceso->pond_ngci5}}%</b></a></th>
                          @else
                            <th>{{$proceso->pond_ngci5}}</th>
                          @endif
                        @endif
                      @endif
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