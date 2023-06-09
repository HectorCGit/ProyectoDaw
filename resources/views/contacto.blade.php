<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aeroweb</title>
    @vite(['resources/css/contacto.css'])

</head>
<body>
@extends('layouts.app')
@section('content')
<div class="container mt-4 contacto">
    <h1>Contacta con nosotros</h1>

    <form method="POST" action="{{ route('enviarContacto') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>

        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe lo que quieras"></textarea>
        </div>

        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
</div>
<div id="footer"></div>
@endsection
</body>
</html>
