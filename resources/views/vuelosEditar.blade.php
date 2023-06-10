<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @vite(['resources/css/billetesCompany.css'])

    <script>
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
<body>
@extends('layouts.app')
@section('content')
    <div class='container p-3'>
        <h1 align="center">Vuelo</h1>
        <form action="{{ route('vuelosActualizar') }}" method="post"
              onsubmit="return validacionDestino()">
            @csrf
            <div class="formu table-responsive">
                <div class="alert alert-danger m-3" id="error" style="display: none">
                    <div>
                        Destino y origen no deben coincidir
                    </div>
                </div>
                <table class="tablaFormu">
                    <tr>
                        <td><label>Origen </label></td>
                        <td>
                            <input list="origen" name="origen" placeholder="origen" class="form-control"
                                   id="campoOrigen" required value="{{$flight[0]->origin}}"/>
                            <datalist id="origen">
                                @foreach ($cities as $city)
                                    <option
                                        value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                                @endforeach
                            </datalist>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Destino </label></td>
                        <td>
                            <input list="destino" name="destino" placeholder="destino"
                                   class="form-control"
                                   id="campoDestino" required value="{{$flight[0]->destination}}"/>
                            <datalist id="destino">
                                @foreach ($cities as $city)
                                    <option
                                        value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                                @endforeach
                            </datalist>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Fecha de vuelo </label></td>
                        <td>
                            <input type="datetime-local" class="form-control" name="fecha"
                                   min="<?=date('Y-m-d');?>"
                                   required value="{{$flight[0]->departing}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Duracion</label></td>
                        <td>
                            Horas: <input type="number" class="form-control" id="horas" name="horas"
                                          maxlength="2" min="0"
                                          value="{{substr($flight[0]->flight_hours,0,1)}}">
                            Minutos: <input type="number" class="form-control" id="minutos"
                                            name="minutos" maxlength="2" min="0"
                                            value="{{substr($flight[0]->flight_hours,3,2)}}">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Número de pasajeros</label></td>
                        <td>
                            <input type="number" class="form-control" name="numPassengers"
                                   required value="{{$flight[0]->num_passengers}}">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Número de asientos</label></td>
                        <td>
                            <input type="number" class="form-control" min="1" name="numSeats"
                                   required value="{{$flight[0]->num_seats}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Precio económico </label></td>
                        <td>
                            <input type="number" class="form-control" name="economic" maxlength="5"
                                   value="{{$flight[0]->economic_price}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Precio business</label></td>
                        <td>
                            <input type="number" class="form-control" name="business" maxlength="5"
                                   value="{{$flight[0]->business_price}}">
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td>
                            <input type="hidden" name="idFlight" value="{{$flight[0]->id_flight}}">
                            <input type="hidden" name="idPrice" value="{{$flight[0]->id_price}}">
                            <input type="submit" value="Editar">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
    <div id="footer"></div>
@endsection

</body>
</html>

