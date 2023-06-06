<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/misBilletes.css'])

</head>
<body class="min-vh-100 position-relative pb-xxl-5">

@extends('layouts.app')
@section('content')
    <div class="container ">
        <div>
            <div class="formu">
                @if($billetes->isEmpty())
                    <div class="alert alert-success m-3">
                        <h1>No tiene ningún billete actualmente</h1>
                    </div>
                @else
                    @foreach($billetes as $b)
                        <table class="tablaFormu">
                            <tr>
                                <td colspan="2"><h5>{{$b->origin}} ({{$b->countryOrigin}}) - {{$b->destination}} ({{$b->countryDestination}})</h5></td>
                            </tr>
                            <tr>
                                <td colspan="2">{{$b->flight_hours}}</td>
                            </tr>
                            <tr>
                                <td>{{$b->company}}</td>
                                <td>Número de vuelo: {{$b->id_flight}}</td>
                            </tr>
                            <tr>
                                <td>Fecha y hora:</td>
                                <td>{{substr($b->departing,0,16)}}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Nombre:</td>
                                <td>{{$b->ticket_name_passenger}}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Apellidos:</td>
                                <td>{{$b->ticket_surname_passenger}}</td>
                            </tr>
                            <tr>
                                <td>Aeropuerto de salida:</td>
                                <td>{{$b->originAirport}}</td>
                            </tr>
                            <tr>
                                <td>Aeropuerto de llegada:</td>
                                <td>{{$b->destinationAirport}}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td colspan="2">Puede llevar {{$b->num_suitcases}} maletas. Equipaje de mano y de bodega</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <form action="{{route('cancelarBillete')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="idTicket" value="{{$b->id_ticket}}">
                                        <input type="submit" value="Cancelar vuelo">
                                    </form>
                                </td>
                            </tr>

                        </table>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="pagination">{{$billetes->links()}}</div>
    </div>
    <div id="footer" style="width: 400px; height: 200px"></div>
@endsection
</body>
</html>
