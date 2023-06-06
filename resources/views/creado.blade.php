<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @vite(['resources/css/billetesCompany.css'])

</head>
<body>
@extends('layouts.app')
@section('content')
    <div class="container">
        @if($tipo==='crear')
            <div class="alert alert-success m-3">
            <h1>Creado con éxito</h1>
                <a class="text-decoration-none" href="{{route('homeCompany')}}">Volver a la página principal</a><br>
            </div>
        @else
            <div class="alert alert-danger m-3">
            <h1>Eliminado con éxito</h1>
            </div>
        @endif

    </div>
    <div id="footer"></div>
@endsection
</body>
</html>
