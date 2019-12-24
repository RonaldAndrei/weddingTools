<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WeddingTools') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/appStyle.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<body>

  <div class="d-flex" id="wrapper">
    @auth
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div id="nameSite" class="sidebar-heading"><a class="navbar-brand" href="{{ url('/home') }}"> {{ config('app.name', 'WeddingTools') }} </a></div>
      <div class="list-group list-group-flush">
        @if ( Auth::user()->name != "convidado" )
        <a class="list-group-item list-group-item-action bg-light" data-toggle="collapse" data-target="#userDiv" aria-expanded="false"><span><i class="fas fa-users"></i></span>Usuários</a>       
        <div class="collapse navbar-collapsed" id="userDiv">
          <a href="/userhome" class="list-group-item sub-item">Listar Usuários</a>
          <a href="/usernew" class="list-group-item sub-item" id="userNew">Novo Usuário</a>
        </div>

        <a class="list-group-item list-group-item-action bg-light" data-toggle="collapse" data-target="#convidadosDiv" aria-expanded="false"><span><i class="fas fa-address-card"></i></span>Convidados</a>
        <div class="collapse navbar-collapsed" id="convidadosDiv">
          <a href="#" class="list-group-item sub-item">Listar Convidados</a>
          <a href="/convidadonew" class="list-group-item sub-item" id="userNew">Novo Convidado</a>
        </div>
        @endif
        <a href="/home" class="list-group-item list-group-item-action bg-light"><span><i class="fas fa-info-circle"></i></span>Informações</a>
        <a href="#" class="list-group-item list-group-item-action bg-light"><span><i class="fas fa-calendar-check"></i></span>Confirmar presença</a>
        <a href="#" class="list-group-item list-group-item-action bg-light"><span><i class="fas fa-trophy"></i></span>Torneio de Truco</a>
        <a href="#" class="list-group-item list-group-item-action bg-light"><span><i class="fas fa-gifts"></i></span>Presentes</a>
      </div>
    </div>
    @endauth
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav id="topBar" class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        @auth
        <!-- menu button -->                 
        <button class="btn btn-light" id="menu-toggle"><span><i class="fas fa-bars"></i></span></button>
        <!-- sair button -->   
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item" id="btnSair">
            <form action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-light">
                    <span><i class="fas fa-sign-out-alt"></i></span>
                </button>
            </form>
          </li>
        </ul>      
        @endauth
      </nav>

      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/appFunctions.js') }}"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
