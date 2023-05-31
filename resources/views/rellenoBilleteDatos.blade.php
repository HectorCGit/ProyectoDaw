<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/formularioIda.css'])
    <script type="text/javascript" defer>
        function validar() {
            let nombres = document.getElementsByClassName('nombre');
            let apellidos = document.getElementsByClassName('apellidos');
            for (let i = 0; i < nombres.length; i++) {
                if (nombres[i].value === '' || !isNaN(nombres[i].value)) {
                    alert('Debes rellenar correctamente el nombre del pasajero ' + (i + 1));
                    return false;
                }
            }
            for (let i = 0; i < apellidos.length; i++) {
                if (apellidos[i].value === '' || !isNaN(apellidos[i].value)) {
                    alert('Debes rellenar correctamente el apellido del pasajero ' + (i + 1));
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body class="antialiased">

@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="post" autocomplete="off" action='{{route('nombresBilletes')}}' onsubmit="return validar()">
            @csrf
            <table>
                @for($i=1;$i<=$numBilletes;$i++)
                    <tr>
                        <td><h5>Datos del pasajero {{$i}}</h5></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" name="nombre[]" class="nombre"></td>
                    </tr>
                    <tr>
                        <td>Apellidos</td>
                        <td><input type="text" name="apellidos[]" class="apellidos"></td>
                    </tr>
                @endfor
                @if($contador==0)
                    <tr>
                        <td><input type="hidden" name="idVueloIda" value="{{$idVueloIda}}"></td>
                        <td><input type="hidden" name="idVueloVuelta" value="{{$idVueloVuelta}}"></td>
                        <td><input type="hidden" name="numBilletes" value="{{$numBilletes}}"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Siguiente"></td>
                    </tr>
                @else
                    <tr>
                        <td><input type="hidden" name="idVueloIda" value="{{$idVueloIda}}"></td>
                        <td><input type="hidden" name="numBilletes" value="{{$numBilletes}}"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Siguiente"></td>
                    </tr>
                @endif
            </table>
        </form>
        <div style="width: 400px; height: 400px">
        </div>
    </div>
@endsection
</body>
</html>
