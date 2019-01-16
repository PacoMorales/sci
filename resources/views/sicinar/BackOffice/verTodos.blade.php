@extends('sicinar.backOffice')

@section('title','Gestión de Usuarios')

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
            <h1><i class="fa fa-users"></i>
                Gestión de Usuarios
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Usuarios</a></li>
                <li class="active">Ver Todos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Ver Usuarios</b></h3>
                            <a href="{{route('backUsuarios')}}" class="btn btn-info pull-right" title="Dar de alta un nuevo usuario"><i class="fa fa-user-plus"></i> Nuevo</a>
                        </div>
                        <div class="box-body">
                            <table id="tabla1" border="1" style="border: 2px solid slategray;" class="table table-bordered table-sm">
                                <thead style="border-color:brown;color: brown;" class="justify">
                                    <tr>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: green">Nombre</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: green">E-mail</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: orangered">Unidad Administrativa</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: dodgerblue">Usuario</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;"><b style="color: dodgerblue">Contraseña</b></th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Rol</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Status</th>
                                        <th colspan="1" style="text-align:center; vertical-align: middle;border: 2px solid slategray;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td style="text-align:center; vertical-align: middle;">{{$usuario->nombre_completo}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$usuario->email}}</td>
                                        @if($usuario->cve_dependencia == '0' OR $usuario->cve_dependencia == ' ')
                                            <td style="text-align:center; vertical-align: middle;">NO ASIGNADO</td>
                                        @else
                                            @foreach($dependencias as $dependencia)
                                                @if(strpos($dependencia->depen_id,$usuario->cve_dependencia)!==false)
                                                    <td style="text-align:center; vertical-align: middle;">{{$dependencia->depen_desc}}</td>
                                                    @break
                                                @endif
                                                @if($loop->last)
                                                    <td style="text-align:center; vertical-align: middle;">NO ASIGNADO</td>
                                                @endif
                                            @endforeach
                                        @endif
                                        <td style="text-align:center; vertical-align: middle;">{{$usuario->login}}</td>
                                        <td style="text-align:center; vertical-align: middle;">{{$usuario->password}}</td>
                                        @if($usuario->status_1 == 4)
                                            <td style="text-align:center; vertical-align: middle;"><a class="btn btn-danger" title="Super Administrador"><i class="fa  fa-user-secret"></i></a></td>
                                        @else
                                            @if($usuario->status_1 == 3)
                                                <td style="text-align:center; vertical-align: middle;"><a class="btn btn-warning" title="Administrador"><i class="fa fa-users"></i></a></td>
                                            @else
                                                @if($usuario->status_1 == 2)
                                                    <td style="text-align:center; vertical-align: middle;"><a class="btn btn-primary" title="Particular"><i class="fa fa-user"></i></a></td>
                                                @else
                                                    <td style="text-align:center; vertical-align: middle;"><a class="btn btn-info" title="Operativo"><i class="fa fa-male"></i></a></td>
                                                @endif
                                            @endif
                                        @endif
                                        @if($usuario->status_2 == 1)
                                            <td style="text-align:center; vertical-align: middle;"><a href="{{route('desactivarUsuario',$usuario->folio)}}" class="btn btn-success" title="Activo"><i class="fa fa-unlock"></i></a></td>
                                        @else
                                            <td style="text-align:center; vertical-align: middle;"><a href="{{route('activarUsuario',$usuario->folio)}}" class="btn btn-danger" title="Inactivo"><i class="fa  fa-lock"></i></a></td>
                                        @endif
                                        <td style="text-align:center; vertical-align: middle;"><a href="{{route('editarUsuario',$usuario->folio)}}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $usuarios->appends(request()->input())->links() !!}
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