<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('title','Inicio') | SCI</title>
      <link rel="shortcut icon" type="image/png" href="{{ asset('images/Edomex.png') }}"/>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
      <!-- Morris chart -->
      <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
      <!-- jvectormap -->
      <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
      <!-- Date Picker -->
      <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



      <section>@yield('links')</section>

      @toastr_css
    </head>
    <body class="hold-transition skin-green sidebar-mini">
      <div class="wrapper">
        @jquery
        @toastr_js
        @toastr_render
        <header class="main-header">
          <!-- Logo -->
          <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b> SCI</b></span>
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!--<img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">-->
                    <span class="hidden-xs"><section>@yield('nombre')</section></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <!--<img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">-->
                      <p>
                        <section style="color:white;">@yield('nombre')</section>
                          <small style="color:blue;">Tipo: <section style="color:white;">@yield('usuario')</section></small>
                          <small style="color:blue;">Estructura: <section style="color:white;">@yield('estructura')</section></small>
                      </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <!--<div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                      </div>-->
                      <div class="pull-right">
                        <a href="{{ route('terminada') }}" class="btn btn-default btn-flat">Salir</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MENÚ PRINCIPAL</li>
            @if($rango>=1 AND $rango<=4)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-gears"></i> <span>Procesos</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('nuevoProceso') }}"><i class="fa fa-circle-o"></i> Nuevo Proceso</a></li>
                  @if($rango>1)
                  <!--<li><a href="{{ route('verProcesos') }}"><i class="fa fa-circle-o"></i> Ver Procesos</a></li>-->
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i> Ver Procesos
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{ route('verProcesos') }}"><i class="fa fa-square-o"></i> Todos</a></li>
                        <li><a href="{{ route('verProcesosSust')  }}"><i class="fa fa-square-o"></i> Procesos sustantivos</a></li>
                        <li><a href="{{ route('verProcesosAdmin')  }}"><i class="fa fa-square-o"></i> Procesos administrativos</a></li>
                        <li><a href="{{ route('verProcesosInst')  }}"><i class="fa fa-square-o"></i> Procesos institucionales</a></li>
                      </ul>
                    </li>
                  <li><a href="{{ route('evalProcesos') }}"><i class="fa fa-circle-o"></i> Evaluados</a></li>
                  @endif
                </ul>
              </li>
            @endif
              @if($rango>=3)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-folder"></i> <span>Gestión</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Por Procesos
                          <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{route('procesosGestion')}}"><i class="fa fa-square-o"></i> Todos</a></li>
                          <li><a href="{{route('procesosGestionSust')}}"><i class="fa fa-square-o"></i> Procesos sustantivos</a></li>
                          <li><a href="{{route('procesosGestionAdm')}}"><i class="fa fa-square-o"></i> Procesos administrativos</a></li>
                          <li><a href="{{route('procesosGestionInst')}}"><i class="fa fa-square-o"></i> Procesos institucionales</a></li>
                        </ul>
                      </li>
                      <li><a href="{{route('Gestunidades')}}"><i class="fa fa-circle-o"></i> Por Unidad Administrativa</a></li>
                  </ul>
                </li>
              @endif
            @if($rango>=1 AND $rango<=4)
              <li  class="treeview">
                <a href="#"><i class="fa fa-edit"></i> <span>Cédula de Evaluación</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('cuestionario') }}"><i class="fa fa-circle-o"></i> Evaluar Proceso</a></li>
                  @if($rango >=1)
                    <li><a href="{{ route('evalEditar') }}"><i class="fa fa-circle-o"></i> Editar Evaluación</a></li>
                  @endif
                </ul>
              </li>
            @endif
              @if($rango >= 3)
                <li  class="treeview">
                  <a href="#"><i class="fa fa-book"></i> <span>Plan de Trabajo</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{route('nuevoPlan')}}"><i class="fa fa-circle-o"></i> Nuevo Plan de Trabajo</a></li>
                    <li><a href="{{route('verPlan')}}"><i class="fa fa-circle-o"></i> Editar Plan de Trabajo</a></li>
                  </ul>
                </li>
              @endif
              @if($rango >= 4)
                <li  class="treeview">
                  <a href="#"><i class="fa fa-th-large"></i> <span>Administración de Riesgos</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i> Nuevo
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{route('nuevoRiesgo')}}">I. Evaluación de Riesgos</a></li>
                        <li><a href="{{route('nuevoControl')}}">II. Evaluación de Controles</a></li>
                        <li><a href="{{route('nuevaValoracion')}}">III. Valoración de Riesgos vs Controles</a></li>
                        <li><a href="{{route('enlistaMapas')}}">IV. Mapa de Riesgos</a></li>
                        <li><a href="{{route('nuevaEstrategia')}}">V. Estrategias y Acciones</a></li>
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i>Editar
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{route('verRiesgos')}}">I. Evaluación de Riesgos</a></li>
                        <li><a href="{{route('verControl')}}">II. Evaluación de Controles</a></li>
                        <li><a href="{{route('verValoracion')}}">III. Valoración de Riesgos vs Controles</a></li>
                        <li><a href="{{route('enlistaMapas')}}">IV. Mapa de Riesgos</a></li>
                        <li><a href="{{route('verEstrategias')}}">V. Estrategias y Acciones</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
              @endif
              @if($rango>1 AND $rango<=4)
                <li>
                  <a href="{{ route('verGraficas') }}">
                    <i class="fa fa-pie-chart"></i><span>Gráficas</span>
                    <span class="pull-right-container">
                    <!--<small class="label pull-right bg-green">new</small>-->
                  </span>
                  </a>
                </li>
              @endif
            @if($rango>=1 AND $rango<=4)
              <li class="header">ELEMENTOS AUXILIARES</li>
              <li>
                <a href="{{ route('evidencias') }}">
                  <i class="fa fa-th"></i> <span>Evidencias</span>
                  <span class="pull-right-container">
                    <!--<small class="label pull-right bg-green">new</small>-->
                  </span>
                </a>
              </li>
            @endif
            </ul>
          </section>
          <!-- /.sidebar -->
        </aside>
        <section>@yield('content')</section>
        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
          </div>
          <strong>Derechos reservados: Gobierno del Estado de México. Unidad de Desarrollo Institucional y Tecnologías de la Información (UDITI).</strong>
        </footer>
      </div>
      <!-- jQuery 3 -->
      <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
      <!-- FastClick -->
      <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{ asset('dist/js/demo.js') }}"></script>

      <section>@yield('request')</section>
      <section>@yield('javascrpt')</section>

    </body>
</html>