<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/billetesCompany.css'])
    <script defer>
        function validacionDestino() {
            let origen = document.getElementById("campoOrigen");
            let destino = document.getElementById("campoDestino");
            let error = document.getElementById("error");
            if (origen.value === destino.value) {
                error.style.display = "block";
                return false;
            } else {
                error.style.display = "none";
                return true;
            }
        }
    </script>
</head>
<body class="antialiased">
@extends('layouts.app')
@section('content')
    <div class='container p-3'>
        <h1 align="center">Vuelo</h1>
        <form autocomplete="off" method="post" action="{{route('guardarVuelo')}}" onsubmit="return validacionDestino()">
            <div class="alert alert-danger m-3" id="error" style="display: none">
                <div >
                    Destino y origen no deben coincidir
                </div>
            </div>
            @csrf
            <table class="table custom-table m-3">
                <tr>
                    <td>
                        <label>Origen </label></td>
                        <td><input list="origen" class="form-control" name="origen" placeholder="origen" id="campoOrigen" required/>
                        <datalist id="origen">
                            @foreach ($cities as $city)
                                <option value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                            @endforeach
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Destino </label></td><td>
                        <input list="destino" class="form-control" name="destino" placeholder="destino" id="campoDestino" required/>
                        <datalist id="destino">
                            @foreach ($cities as $city)
                                <option value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                            @endforeach
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Nº Asientos </label></td>
                    <td>
                        <input type="number"  class="form-control" id="asientos" name="asientos" placeholder="200" maxlength="3" min="1">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Fecha y hora de salida</label></td>
                    <td>
                        <input class="form-control" type="datetime-local" id="fecha" name="fecha" >
                    </td>
                </tr>
                <tr>
                    <td >
                        <label>Duracion</label></td>
                    <td>
                        Horas: <input type="number" class="form-control" id="horas" name="horas" placeholder="3" maxlength="2" min="0">
                        Minutos: <input type="number" class="form-control" id="minutos" name="minutos" placeholder="30" maxlength="2" min="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Precio económico </label></td>
                    <td>
                        <input type="number" id="economico" class="form-control" name="economico" placeholder="200" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Precio business</label></td>
                    <td>
                        <input type="number" id="business" class="form-control" name="business" placeholder="300" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Crear"></td>
                </tr>
            </table>
        </form>

    </div>
    <div id="footer" style="width: 400px; height: 200px"></div>
@endsection
</body>

</html>
