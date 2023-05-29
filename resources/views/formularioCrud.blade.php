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
    <div class='container'>
        <form method="post" action="{{route('guardarVuelo')}}">
            @csrf
            <table>

                <tr>
                    <td>
                        <label>Origen </label>
                        <input list="origen" name="origen" placeholder="origen" id="campoOrigen" required/>
                        <datalist id="origen">
                            @foreach ($cities as $city)
                                <option value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                            @endforeach
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Destino </label>
                        <input list="destino" name="destino" placeholder="destino" id="campoDestino" required/>
                        <datalist id="destino">
                            @foreach ($cities as $city)
                                <option value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                            @endforeach
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Nº Asientos </label>
                        <input type="number" id="asientos" name="asientos" placeholder="200" maxlength="3">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Fecha y hora de salida</label>
                        <input type="datetime-local" id="fecha" name="fecha">
                    </td>
                </tr>
                <tr>

                    <td>
                        <label>Duracion</label>
                        Horas: <input type="number" id="horas" name="horas" placeholder="3" maxlength="2">
                        Minutos: <input type="number" id="minutos" name="minutos" placeholder="30" maxlength="2">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Precio económico </label>
                        <input type="number" id="economico" name="economico" placeholder="200" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Precio business</label>
                        <input type="number" id="business" name="business" placeholder="300" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Crear"></td>
                </tr>
            </table>
        </form>
    </div>
@endsection
</body>

</html>
