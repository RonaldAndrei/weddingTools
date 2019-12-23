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
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
</head>

<body>

  <div class="d-flex" id="wrapper">
    @auth
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div id="nameSite" class="sidebar-heading"><a class="navbar-brand" href="{{ url('/home') }}"> {{ config('app.name', 'WeddingTools') }} </a></div>
      <div class="list-group list-group-flush">
        @if ( Auth::user()->name != "convidado" )
        <a href="/userhome" class="list-group-item list-group-item-action bg-light">Usuários</a>
        @endif
        <a href="/home" class="list-group-item list-group-item-action bg-light">Informações</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Confirmar presença</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Torneio de Truco</a>
      </div>
    </div>
    @endauth
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav id="topBar" class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        @auth
        <!-- menu button -->                 
        <button class="btn btn-light" id="menu-toggle"><span><i class="icon ion-md-menu"></i></span></button>
        <!-- sair button -->   
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                <button id="btnSair" type="submit" class="btn btn-light">
                    <span><i class="icon ion-md-exit"></i></span>
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
