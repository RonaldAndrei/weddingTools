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
</head>

<style>
    #btnMenu {
        float: left;
        display: block;
        
    }

    #topBar {
        width: 100%;
    }

    #sideBarLeft {
        float: left;
        width: 20%;
        margin-top: -1%;
    }
    
    #dropDownLogout {

    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div id="topBar" class="container">
                <div class="navbar-header"> 
                    @auth
                    <!-- Collapsed Hamburger -->
                    <button id="btnMenu" type="button" class="navbar-toggle collapsed" data-toggle="collapse" onclick="showMenuLateral();" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @endauth
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'WeddingTools') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
    @auth
    <!-- Left Side Of Navbar -->
    <nav id="sideBarLeft" class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">                    
                        <li id="dropDownLogout" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                <strong>Bem vindo {{ Auth::user()->name }} <span class="caret"></span></strong>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    
                </li>
            </ul>
        </div>
        <div>
            <ul class="nav metismenu" id="side-menu">
                <li class="active">
                    <ul class="nav nav-second-level collapse in">
                        <li><a href="/usernew">Convidados</a></li>
                        <li><a href="/home">Informações</a></li>
                        <li><a href="#">Confirmação</a></li>
                        <li><a href="#">Torneio de Truco</a></li>
                        <li><a href="#">Presentes</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    @endauth
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        
        function showMenuLateral() {
            if($('#sideBarLeft').css('display') == 'none') {
                $('#sideBarLeft').show();
            } else {
                $('#sideBarLeft').hide();
            }
        };

    </script>

@yield('content')

</body>
</html>
