<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WeddingTools') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/appStyle.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div id="topBar" class="container">
                <div class=".container">
                    <div class="row">
                            <!-- botao menu -->
                            <div class="col-md-1">
                                @auth                        
                                <button id="btnMenu" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sideBarLeft" aria-expanded="true">
                                    <span><i class="icon ion-md-menu"></i></span>
                                </button>
                                @endauth
                            </div>
                            <!-- nome site -->
                            <div class="col-md-10">
                                <a class="navbar-brand" href="{{ url('/home') }}"> {{ config('app.name', 'WeddingTools') }} </a>
                            </div>
                            <!-- botao sair -->
                            <div class="col-md-1">
                                @auth                             
                                    <form id="btnSair" action="{{ route('logout') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button id="btnSair" type="submit" class="navbar-toggle">
                                            <span><i class="icon ion-md-exit"></i></span>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class=".container">
            <div class="row">
                <!-- menu lateral -->
                @auth
                <div id="sideBarLeft" class="col col-lg-2">
                    <div class="navbar-default navbar-static-side">
                        <nav>
                            <ul class="nav metismenu" id="side-menu">
                                <li class="active">
                                    <ul class="nav nav-second-level collapse in">
                                        @if ( Auth::user()->name != "convidado" )
                                        <li><a href="/userhome">Usuários</a></li>
                                        @endif
                                        <li><a href="/home">Informações</a></li>
                                        <li><a href="#">Confirmar presença</a></li>
                                        <li><a href="#">Torneio de Truco</a></li>
                                        <li><a href="#">Item qualquer</a></li>
                                        <li><a href="#">Item qualquer</a></li>
                                        <li><a href="#">Item qualquer</a></li>
                                        <li><a href="#">Item qualquer</a></li>
                                        <li><a href="#">Item qualquer</a></li>
                                        <li><a href="#">Item qualquer</a></li>
                                        <li><a href="#">Item qualquer</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                @endauth
                <!-- Conteudo da pagina -->
                <div class=".col-md-auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/appFunctions.js') }}"></script>

</body>
</html>
