<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
</head>
<body class="min-vh-100 position-relative pb-xxl-5">

@extends('layouts.app')
@section('content')
    <div class="container">
    @switch($premio)
        @case('nada')
            <div class="alert alert-danger m-3">
                <h1>LO SENTIMOS, NO HAS GANADO NADA</h1>
                <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver a la página principal</a><br>
            <div>
            @break

        @case('20%')
            <div class="alert alert-success m-3">
                <h1>HAS CONSEGUIDO UN 20% DE DESCUENTO</h1>
                <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver a la página principal</a><br>
            {{--DONDE PUEDE VER EL USUARIO SUS DESCUENTOS?--}}
            </div>
            @break

        @case('15%')
            <div class="alert alert-success m-3">
                <h1>HAS CONSEGUIDO UN 15% DE DESCUENTO</h1>
                <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver a la página principal</a><br>
            </div>
            @break

        @case('billete')
            <div class="alert alert-success m-3">
                <h1>HAS CONSEGUIDO UN BILLETE DE AVION, COMPRUÉBALO EN TU CARRITO</h1>
                <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver a la página principal</a><br>
                <a class="text-decoration-none" href="{{route('billetesPassenger')}}">Carrito</a>
            </div>
            @break

        @case('puntos')
            <div class="alert alert-success m-3">
                <h1>HAS RECUPERADO TUS 500 PUNTOS, VUELVE A LA RULETA PARA TIRAR OTRA VEZ</h1>
                <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver a la página principal</a><br>
                <a class="text-decoration-none" href="{{route('ruleta')}}">Ruleta</a>
            </div>
            @break
    @endswitch
        <div style="width: 400px; height: 500px"></div>
    </div>
@endsection
</body>
</html>
