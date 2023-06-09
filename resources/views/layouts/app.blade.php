<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aeroweb') }}</title>

    <!-- Estilos -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/sidebar.css'])
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
                    @else
                        <a href="{{route('homeAdmin')}}">Principal</a>
                    @endif
                @else
                    <a href="{{route('home')}}">Principal</a>
                @endauth
                @auth
                    @if( Auth::user()->hasRole('passenger'))
                        <a href="{{ route('ruleta') }}">Ruleta</a>
                        <a href="{{route('billetesCheckIn')}}">Check-in</a>
                        <a href="{{route('billetesPassenger')}}">Mis Billetes</a>
                        <a href="{{route('descuentosPassenger')}}">Mis Descuentos</a>
                    @endif
                @endauth
                @auth
                    @if( Auth::user()->hasRole('admin'))
                        <a href="{{route('user-passengers.index')}}">Pasajeros</a>
                        <a href="{{route('user-companies.index')}}">Compañias</a>
                    @endif
                @endauth
                <a href="{{route('foro')}}">Foro</a>
                <a href="{{route('contacto')}}" id="contactos">Contacto</a>
                <a href="{{route('info')}}" id="informacion">Información</a>
            </div>

            <div id="main">
                <button class="openbtn" onclick="openNav()">☰</button>
            </div>
        </div>
        <div class="container">

            <a class="navbar-brand" href="{{ route('accederHome') }}"><img style="width:100px;height:100px"
                                                                           src="{{ asset('imgLogo/logoAeroweb.png') }}"
                                                                           alt="Logo">
            </a>
            <button class="navbar-toggler openbtn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">☰
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Lado izquierdo del Navbar -->
                <ul class="navbar-nav me-auto listaOculta menu">
                    @auth
                        @if( Auth::user()->hasRole('company'))
                            <li><a class="nav-link" href="{{route('homeCompany')}}">Principal</a></li>
                        @elseif(Auth::user()->hasRole('passenger'))
                            <li><a class="nav-link" href="{{route('homePassenger')}}">Principal</a></li>
                        @else
                            <li><a class="nav-link" href="{{route('homeAdmin')}}">Principal</a></li>
                        @endif
                    @else
                        <li><a class="nav-link" href="{{route('home')}}">Principal</a></li>
                    @endauth

                    @auth
                        @if( Auth::user()->hasRole('passenger'))
                            <li><a class="nav-link" href="{{ route('ruleta') }}">Ruleta</a></li>
                            <li><a class="nav-link" href="{{route('billetesCheckIn')}}">Check-in</a></li>
                            <li><a class="nav-link" href="{{route('billetesPassenger')}}">Mis Billetes</a></li>
                                <li><a class="nav-link" href="{{route('descuentosPassenger')}}">Mis Descuentos</a></li>
                        @endif
                    @endauth
                    @auth
                        @if( Auth::user()->hasRole('admin'))
                                <li><a class="nav-link" href="{{route('user-passengers.index')}}">Pasajeros</a></li>
                                <li> <a class="nav-link" href="{{route('user-companies.index')}}">Compañias</a></li>
                        @endif
                    @endauth
                    <li><a class="nav-link" href="{{route('foro')}}">Foro</a></li>
                    <li id="contactos2"><a class="nav-link" href="{{route('contacto')}}"  >Contacto</a></li>
                    <li id="informacion2"><a class="nav-link" href="{{route('info')}}" >Información</a></li>
                </ul>

                <!-- Lado derecho del navbar -->
                <ul class="navbar-nav ms-auto menu">
                    <!--Links de autentificación-->
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
