@extends('main')

@section('title','Sesión Expirada!')

@section('content')
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><b>Sesión </b> Expirada!</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">Ingresa tus datos</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="{{asset('dist/img/user1-128x128.jpg')}}" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    {!! Form::open(['route' => 'login','class' => 'lockscreen-credentials', 'method' => 'POST', 'id' => 'logeo']) !!}
      @csrf
      <div class="input-group">
        <input type="text" class="form-control" name="usuario" placeholder="usuario">
        <input type="password" class="form-control" name="password" placeholder="password">
        <div class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    {!! Form::close() !!}
    <!-- /.lockscreen credentials -->
    @if(count($errors) > 0)
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Tu sesión ha expirado
  </div>
  <div class="text-center">
    Ingresa tus datos si quieres iniciar con otro usuario
  </div>
  <!--<div class="text-center">
    <a href="login.html">Or sign in as a different user</a>
  </div>-->
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2018. Elaboró <b><a href="https://adminlte.io" class="text-black">UDITI</a></b><br>
    Todos los derechos reservados.
  </div>
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\usuarioRequest','#logeo') !!}
</body>
@endsection