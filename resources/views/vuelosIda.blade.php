<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/formularioIda.css'])

</head>
<body class="antialiased">

@extends('layouts.app')
@section('content')
    <div class="container d-block">
        <div>
            <div class="formu">
                <h1>Vuelos de ida</h1>
                @if($contador==0)
                    @if(!$ida->isEmpty())
                        @foreach ($ida as $i)
                            <div id="divGeneral">
                                <div class="divGen">
                                    @if(($i->num_seats - $i->num_passengers)>=$numBilletes )
                                        <table class="tablaFormu">
                                            <tr>
                                                <td><h5>{{ $i->company}}</h5></td>
                                            </tr>
                                            <tr>
                                                <td>Ciudad de orígen: {{ $i->origin}}</td>

                                            </tr>
                                            <tr>
                                                <td>Ciudad de destino: {{ $i->destination}}</td>
                                            </tr>
                                            <tr>
                                                <td>Asientos
                                                    disponibles: {{ ($i->num_seats - $i->num_passengers) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Fecha y hora: {{ $i->departing}}</td>
                                            </tr>
                                        </table>
                                    @else
                                        <h2>NO HAY VUELOS DE IDA DISPONIBLES CON ASIENTOS DISPONIBLES EN ESTA FECHA.
                                            PRUEBE CON OTRA FECHA </h2>
                                    @endif
                                </div>
                                <div class="w-30 h-50 p-3">
                                    @auth
                                        <form action="{{route('getBilletesIda')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="idFlight" value="{{$i->id_flight}}">
                                            <input type="hidden" name="fechaVuelta" value="{{$fechaVuelta}}">
                                            <input type="hidden" name="numBilletes" value="{{$numBilletes}}">
                                            <label>Precio</label>
                                            <select name="precioIda" id="precioIda">
                                                <option value="{{$i->economic_price}}">
                                                    Económico: {{$i->economic_price}}</option>
                                                <option value="{{$i->business_price}}">
                                                    Business: {{$i->business_price}}</option>
                                            </select><br><br>
                                            <input type="submit" value="Agregar">
                                        </form>
                                    @else
                                        <button><a href="{{route('login')}}"
                                                   style="text-decoration: none; color: white">Agregar </a></button>
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h2>NO HAY VUELOS DE IDA DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
                    @endif
                @else
                    @if($numBilletes>1)
                        <h2>Billetes de ida seleccionados con ÉXITO</h2>
                    @else
                        <h2>Billete de ida seleccionado con ÉXITO</h2>
                    @endif
                    <div class="formu">
                        <div id="divGeneral">
                            <table class="tablaFormu">
                                <tr>
                                    <td><h5>{{$billete[0]->company}}</h5></td>
                                </tr>
                                <tr>
                                    <td>Ciudad de orígen: {{$billete[0]->origin}}</td>
                                </tr>
                                <tr>
                                    <td>Ciudad de destino: {{$billete[0]->destination}}</td>
                                </tr>
                                @if($numBilletes>1)
                                    <tr>
                                        <td>{{$numBilletes}} billetes seleccionados</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$numBilletes}} billete seleccionado</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Precio por billete: {{$billete[0]->price}}</td>
                                </tr>
                                <tr>
                                    <td>{{$billete[0]->flight_hours}}</td>
                                </tr>
                                <tr>
                                    <td>Fecha y hora: {{$billete[0]->departing}}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
            </div>
        </div>
        <form method="post" action={{route('getVuelosVuelta')}}>
            @csrf
            <input type="hidden" name="fechaVuelta" value="{{$fechaVuelta}}">
            <input type="hidden" name="origen" value="{{$billete[0]->destination}}">
            <input type="hidden" name="destino" value="{{$billete[0]->origin}}">
            <input type="hidden" name="numBilletes" value="{{$numBilletes}}">
            <input type="hidden" name="idVueloIda" value="{{$billete[0]->id_flight}}">
            <input type="submit" value="siguiente">
        </form>
        <div style="width: 400px; height: 400px">
        </div>
    </div>
    @endif
@endsection
</body>
</html>
