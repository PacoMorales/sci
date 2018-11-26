@extends('sicinar.principal')

@section('title','Gestionar Unidades Administrativas')

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
                Gestión de Unidades Administrativas
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Gestión</a></li>
                <li class="active">Unidad</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Seleccione una opción</h3>
                            <br>Por favor, seleccione la Unidad Administrativa que desea visualizar.
                        </div>
                        {!! Form::open(['route' => 'unidadesInfo', 'method' => 'GET']) !!}
                        <div class="box-body">
                            <select class="form-control m-bot15" name="unidad" required>
                                @foreach($unidades as $unidad)
                                    <option value="{{$unidad->depen_id}}" name="unidad">{{$unidad->depen_desc}}</option>
                                @endforeach
                            </select><br>
                            <div class="row">
                                <div class="col-md-12 offset-md-5">
                                {!! Form::submit('Ver Información',['class' => 'btn btn-primary btn-flat pull-right']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
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