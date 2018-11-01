@extends('sicinar.principal')

@section('title','Nuevo Proceso')

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
  <div class="content-wrapper" id="principal">
    <section class="content-header">
      <h1>
        Criterios de Selección de Procesos
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
        <li><a href="#">Procesos</a></li>
        <li class="active">Nuevo Proceso</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-11">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Información Adicional</b></h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-5">
                  <b style="color:red;">¡Importante!</b><br>
                Los campos marcados con un asterisco(*) son obligatorios.
                </div>
              </div>
            </div>
          </div>
        <div class="col-md-7">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b style="color:gray;">Criterios de Selección</b></h3>
            </div>
            <div class="box-body">
            @foreach($criterios as $criterio)
              <div class="row">
                <div class="col-xs-12">
                @if($criterio->cve_crit_sproc==1)
                  <b style="color:green;">Criterio A</b><br>
                @else
                  @if($criterio->cve_crit_sproc==2)
                    <b style="color:green;">Criterio B</b><br>
                  @else
                    @if($criterio->cve_crit_sproc==3)
                      <b style="color:green;">Criterio C</b><br>
                    @else
                      @if($criterio->cve_crit_sproc==4)
                        <b style="color:green;">Criterio D</b><br>
                      @else
                        @if($criterio->cve_crit_sproc==5)
                          <b style="color:green;">Criterio E</b><br>
                        @else
                          @if($criterio->cve_crit_sproc==6)
                            <b style="color:green;">Criterio F</b><br>
                          @else
                            @if($criterio->cve_crit_sproc==7)
                              <b style="color:green;">Criterio G</b><br>
                            @else
                              @if($criterio->cve_crit_sproc==8)
                                <b style="color:green;">Criterio H</b><br>
                              @else
                                <b style="color:green;">Otro Criterio</b><br>
                              @endif
                            @endif
                          @endif
                        @endif
                      @endif
                    @endif
                  @endif
                @endif
                    {{ $criterio->desc_crit_sproc }}
                </div>
              </div>
            @endforeach
            </div>
          </div>
        </div>
      {!! Form::open(['route' => 'altaProceso', 'method' => 'POST', 'id' => 'altaProceso']) !!}
        <div class="col-md-5">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Alta nuevo proceso</b></h3>
            </div>
            <div class="box-body">
              <div class="row">
                <!--<div class="col-xs-5">
                  <label >* Nombre del Proceso</label>
                  <input type="text" class="form-control" name="nombre_proceso" id="nombre_proceso" placeholder="Nombre del Proceso" required>
                </div>-->
                <div class="col-xs-11">
                  <label >* Tipo de Proceso</label>
                  <select class="form-control m-bot15" name="tipo" required>
                    <option selected="true" disabled="disabled">Tipo</option>
                    @foreach($tipos as $tipo)
                      <option value="{{$tipo->cve_tipo_proc}}">{{$tipo->desc_tipo_proc}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-11">
                  <label >* Proceso</label>
                  <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Nombre / Descripción del Proceso" onkeypress="return soloAlfa(event)" required>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-11">
                  <label >* Secretaría responsable</label>
                    <select class="form-control m-bot15" name="secretaria" id="secretaria" required>
                      <option selected="true" disabled="disabled">Secretaría</option>
                      @foreach($estructuras as $sec)
                        <option value="{{ $sec->estrucgob_id }}">{{$sec->estrucgob_desc}}</option>
                      @endforeach
                    </select>
                </div>
              </div><br>
            @if($rango > 1)
              <div class="row">
                <div class="col-xs-11">
                  <label >Unidad responsable</label>
                    <select class="form-control m-bot15" name="unidad" id="unidad">
                    </select>
                </div>
              </div>
            @endif
            <br>
            <div class="col-xs-12">
              <div class="box-header with-border">
                <h2 class="box-title" style="color:gray;">Criterios de Selección</h2>
              </div>
              <div class="form-group row">
                <label class="col-xs-3">
                  <input name="A" type="checkbox"> Criterio A
                </label>
                <label class="col-xs-3">
                  <input name="B" type="checkbox"> Criterio B
                </label>
                <label class="col-xs-3">
                  <input name="C" type="checkbox"> Criterio C
                </label>
                <label class="col-xs-3">
                  <input name="D" type="checkbox"> Criterio D
                </label>
                <label class="col-xs-3">
                  <input name="E" type="checkbox"> Criterio E
                </label>
                <label class="col-xs-3">
                  <input name="F" type="checkbox"> Criterio F
                </label>
                <label class="col-xs-3">
                  <input name="G" type="checkbox"> Criterio G
                </label>
                <label class="col-xs-3">
                  <input name="H" type="checkbox"> Criterio H
                </label>
              </div>
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
                <div class="row">
                  <div class="col-md-12 offset-md-5">
                    <button type="submit" class="btn btn-primary btn-flat">Dar de alta</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</section>
  </div>
@endsection

@section('request')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\procesoRequest','#altaProceso') !!}
@endsection

@section('javascrpt')
<script type="text/javascript">
  $(document).ready(function(){
      $("#secretaria").on('change', function(){
        var sec = $(this).val();
        if(sec) {
          $.ajax({
            url: 'unidades/'+sec,
            type: "GET",
            dataType: "json",
            success:function(data){
              var html_select = '<option selected="true" disabled="disabled">Unidad Responsable</option>';
              for (var i=0; i<data.length ;++i)
                html_select += '<option value="'+data[i].depen_id+'">'+data[i].depen_desc+'</option>';
              $('#unidad').html(html_select);
            }
          });
        }else{
          var html_select = '<option selected="true" value="0">NO ESPECIFICADO</option>';
          $("#unidad").html(html_select);
        }
      });
    });
</script>

<script>
  function soloAlfa(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key);
       letras = "abcdefghijklmnñopqrstuvwxyz ABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890,.;:-_<>!%()=?¡¿/*+";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>
@endsection