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
            <div class="form-control text-center tabla">
                <a class="text-decoration-none text-black" href="{{route('user-passengers.index')}}">Usuarios pasajeros</a>
            </div>
            <div class="form-control text-center tabla">
                <a class=" text-decoration-none text-black" href="{{route('user-companies.index')}}">Usuarios compañias</a>
            </div>
            <div class="form-control text-center tabla">
                <a class=" text-decoration-none text-black" href="{{route('foro')}}">Foro</a>
            </div>
        </div>
        {{--HAY QUE ARREGLAR LA PAGINACION AL ELIMINAR (OTRA VEZ PASA LO MISMO)--}}
    </div>
    <div style="width: 400px; height: 500px">
    </div>
@endsection
</body>
</html>
