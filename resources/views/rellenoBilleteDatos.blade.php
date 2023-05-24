<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/formularioIda.css'])

    <script type="text/javascript" defer>

        function creacionElementoNombre(i) {

            let tr = document.getElementById('nuevoCampo');
            let td = document.createElement('td');
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'nombreCampo'.i);
            input.setAttribute('value', document.getElementById('nombre').value);
            td.appendChild(input);
            tr.appendChild(td);


        }

        function creacionElementoApellido(i) {
            let tr = document.getElementById('nuevoCampo');
            let td = document.createElement('td');
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'nombreCampo'.i);
            input.setAttribute('value', document.getElementById('nombre').value);
            td.appendChild(input);
            tr.appendChild(td);
        }
    </script>


</head>
<body class="antialiased">

@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="post" action=''>
            <table>
                @for($i=1;$i<=$numBilletes;$i++)
                    <tr>
                        <td><h5>Datos del pasajero {{$i}}</h5></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" name="nombre" id="nombre" onblur="creacionElementoNombre({{$i}})"></td>
                    </tr>
                    <tr>
                        <td>Apellidos</td>
                        <td><input type="text" name="apellidos" onblur="creacionElementoApellido({{$i}})"></td>
                    </tr>
                @endfor
                <tr id="nuevoCampo">
                    <td><input type="hidden" name="idVueloIda" value="{{$idVueloIda}}"></td>
                    <td><input type="hidden" name="idVueloVuelto" value="{{$idVueloVuelta}}"></td>
                </tr>
                <tr>
                    <td><input type="submit"></td>
                </tr>
            </table>


        </form>

    </div>
@endsection
</body>
</html>
