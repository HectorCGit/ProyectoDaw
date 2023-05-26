<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->


</head>
<body class="antialiased">

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="formu">
            <div id="divGeneral">
                <h2>COMPRA REALIZADA CON EXITO</h2>
                <a href="{{route('inicio')}}">Volver a la página principal</a>
                <a href="{{route('carrito')}}">Ver mis billetes</a>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
