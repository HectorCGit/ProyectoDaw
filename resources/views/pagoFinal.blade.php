<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Estilos -->
    @vite(['resources/css/pago.css'])

</head>
<body class="antialiased">

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert-success m-3">
            <h2>Compra realizada con éxito</h2>
            <h3>Has ganado: {{$puntosGanados}} puntos para la ruleta</h3><br>
            <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver a la página principal</a><br>
            <a class="text-decoration-none" href="{{route('ruleta')}}">Jugar a la ruleta</a>
        </div>
        <div style="width: 400px; height: 500px">
        </div>
    </div>
@endsection
</body>
</html>
