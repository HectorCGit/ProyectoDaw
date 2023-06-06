<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aeroweb') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/sidebar.css'])
    @vite(['resources/css/footer.css'])
    <script type="text/javascript" defer>
        function openNav() {
            document.getElementById('mySidebar').style.width = '250px';
            document.getElementById('main').style.marginLeft = '250px';
        }

        function closeNav() {
            document.getElementById('mySidebar').style.width = '0';
            document.getElementById('main').style.marginLeft = '0';
        }
    </script>
</head>
<body class="min-vh-100 position-relative pb-auto">
<div id="app">
    <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="sidebarContainer">
            <div id="mySidebar" class="sidebar">
                <a class="closebtn" onclick="closeNav()">×</a>
                @auth
                    @if( Auth::user()->hasRole('company'))
                        <a href="{{route('homeCompany')}}">Principal</a>
                    @elseif(Auth::user()->hasRole('passenger'))
                        <a href="{{route('homePassenger')}}">Principal</a>

                    @endif
                @else
                    <a href="{{route('homePassenger')}}">Principal</a>
                @endauth
                @auth
                    @if( Auth::user()->hasRole('passenger'))
                        <a href="{{ route('ruleta') }}">Ruleta</a>
                        <a href="{{route('billetesCheckIn')}}">Check-in</a>
                        <a href="{{route('billetesPassenger')}}">Mis Billetes</a>
                    @endif
                @endauth
                <a href="{{route('foro')}}">Foro</a>
                <a href="{{route('contacto')}}">Contacto</a>
                <a href="{{route('info')}}">Información</a>
            </div>

            <div id="main">
                <button class="openbtn" onclick="openNav()">☰</button>
            </div>
        </div>
        <div class="container">

            <a class="navbar-brand" href="{{ route('accederHome') }}"><img style="width:100px;height:100px"
                                                               src="{{ asset('imgLogo/logoAeroweb.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler openbtn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">☰</button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto listaOculta menu">
                    <li><a class="nav-link" href="{{route('homePassenger')}}">Principal</a></li>
                        @auth
                            @if( Auth::user()->hasRole('passenger'))
                            <li>      <a class="nav-link" href="{{ route('ruleta') }}">Ruleta</a></li>
                            <li>     <a class="nav-link" href="{{route('billetesCheckIn')}}">Check-in</a></li>
                            <li>     <a class="nav-link" href="{{route('billetesPassenger')}}">Mis Billetes</a></li>
                            @endif
                        @endauth
                    <li>  <a class="nav-link" href="{{route('foro')}}">Foro</a></li>
                    <li>  <a class="nav-link" href="#">Contacto</a></li>
                    <li>  <a class="nav-link" href="#">Información</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto menu">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Registrarse
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('register.company') }}">
                                        {{ __('Empresa') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('register.passenger') }}">
                                        {{ __('Pasajero') }}
                                    </a>
                                </div>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')

    </main>

</div>

@extends('layouts.footer')

</body>
</html>
