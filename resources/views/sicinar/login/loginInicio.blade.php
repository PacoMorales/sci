@extends('main')

@section('title','Iniciar Sesión')

@section('content')
<!--<body class="hold-transition login-page">-->
<body class="hold-transition">
  <img src="{{ asset('images/Logo-Gobierno.png') }}" border="1" width="200" height="60" style="margin-left: 200px;margin-right: 50%">
  <img src="{{ asset('images/Edomex.png') }}" border="1" width="80" height="60">
<!--<body>-->
  <!--<style type="text/css">
    body{
    background-image: url("{{asset('images/indice2.png')}}");
    height: 50%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
  </style>-->
  <!--<img src="{{ asset('images/Logo-Gobierno.png') }}" border="1" width="200" height="60" style="margin-right: 1000px;">-->
  <!--<img src="{{ asset('images/Edomex.png') }}" border="1" width="80" height="60" style="position: relative;">-->
  <div class="login-box">
    <!--<img src="{{ asset('images/Logo-Gobierno.png') }}" border="1" width="200" height="60" style="margin-right: 20px;">
    <img src="{{ asset('images/Edomex.png') }}" border="1" width="80" height="60">-->
    <div class="login-logo">
      <a href="#"><b style="color:green;">SCI</b></a>
      <!--<b style="color:blue;"><h3>SISTEMA DE CONTROL INTERNO Y ADMINISTRACIÓN DE RIESGOS</h3></b>-->
      <h4 style="color:LightSteelBlue;">SISTEMA DE CONTROL INTERNO Y ADMINISTRACIÓN DE RIESGOS</h4>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>

      {!! Form::open(['route' => 'login', 'method' => 'POST', 'id' => 'logeo']) !!}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="usuario" placeholder="Usuario">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Contraseña">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
            <!--{!! Form::submit('Mostrar',['class' => 'btn btn-success']) !!}-->
          </div>
          <!-- /.col -->
        </div>
      {!! Form::close() !!}
    </div>
    <!-- /.login-box-body -->
    <div class="login-logo"><br><br>
      <!--<a href="#"><b>SEDESEM</b></a>-->
      <!--<b style="color:blue;"><h3>SISTEMA DE CONTROL INTERNO Y ADMINISTRACIÓN DE RIESGOS</h3></b>-->
      <h4 style="color:LightSkyBlue;">SECRETARIA DE DESARROLLO SOCIAL</h4>
    </div>
  </div>

  <!--<div class="login-box">
    <div class="login-logo">
      <a href="#"><b>SEDESEM</b></a>
      <h4 style="color:gray;">SECRETARIA DE DESARROLLO SOCIAL</h4>
    </div>
  </div>-->

  <!-- /.login-box -->

  <!-- Javascript Requirements -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

  <!-- Laravel Javascript Validation -->
  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

  {!! JsValidator::formRequest('App\Http\Requests\usuarioRequest','#logeo') !!}
</body>
@endsection