<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @vite(['resources/css/admin.css'])

</head>
<body>
@extends('layouts.app')
@section('content')
    <div class='container'>
        <div class="table m-3 ">
            <div><h1>Bienvenido {{Auth::user()->name}}</h1>
                <p>Gestionar:</p></div>
            <a class="text-decoration-none text-black" href="{{route('user-passengers.index')}}">
                <div class="form-control text-center tabla">Pasajeros</div>
            </a>
            <a class=" text-decoration-none text-black" href="{{route('user-companies.index')}}">
                <div class="form-control text-center tabla">Compañias
                </div>
            </a>
            <a class=" text-decoration-none text-black" href="{{route('foro')}}">
                <div class="form-control text-center tabla">Foro</div>
            </a>
        </div>
    </div>
    <div style="width: 400px; height: 200px">
    </div>
@endsection
</body>
</html>
