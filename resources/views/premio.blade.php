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
            <h1>LO SENTIMOS, NO HAS GANADO NADA</h1>
            @break

        @case('20%')
            <h1>HAS CONSEGUIDO UN 20% DE DESCUENTO</h1>
            @break

        @case('15%')
            <h1>HAS CONSEGUIDO UN 15% DE DESCUENTO</h1>
            @break

        @case('billete')
            <h1>HAS CONSEGUIDO UN BILLETE DE AVION, COMPRUÉBALO EN TU CARRITO</h1>
            @break

        @case('puntos')
            <h1>HAS RECUPERADO TUS 500 PUNTOS, VUELVE A LA RULETA PARA TIRAR OTRA VEZ</h1>
            @break
    @endswitch
        <div style="width: 400px; height: 400px">
        </div>
    </div>
@endsection
</body>
</html>
