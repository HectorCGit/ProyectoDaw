<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Estilos -->
    @vite(['resources/css/formularioIdaVuelta.css'])
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="m-3">
            @if($contador==0)
                @if(!$ida->isEmpty())
                    <h1>Vuelos de ida</h1>
                    @foreach ($ida as $i)
                        <div id="divGeneral">
                            <div class="divGen">
                                @if(($i->num_seats - $i->num_passengers)>=$numBilletes )
                                    <table class="tablaFormu">
                                        <tr>
                                            <td><h4>{{ $i->company}}</h4></td>
                                        </tr>
                                        <tr>
                                            <td>Ciudad de orígen: <h5>{{ $i->origin}}</h5></td>

                                        </tr>
                                        <tr>
                                            <td>Ciudad de destino: <h5>{{ $i->destination}}</h5></td>
                                        </tr>
                                        <tr>
                                            <td>Asientos
                                                disponibles: <h5>{{ ($i->num_seats - $i->num_passengers) }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fecha y hora: <h5>{{substr($i->departing,0,16)}}</h5></td>
                                        </tr>
                                    </table>
                                @else
                                    <div class="alert alert-primary m-3">
                                        <h2>No hay vuelos de ida disponibles con asientos disponibles con asientos
                                            disponibles en esta fecha.
                                            Pruebe con otra fechas</h2>
                                        <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver</a>
                                    </div>
                                @endif
                            </div>
                            <div class="divGen">
                                <table class="tablaFormu ">
                                    @auth
                                        <form action="{{route('getBilletesIda')}}" method="post">
                                            @csrf
                                            <tr>
                                                <td><input type="hidden" name="idFlight" value="{{$i->id_flight}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" name="fechaVuelta"
                                                           value="{{$fechaVuelta}}"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" name="numBilletes"
                                                           value="{{$numBilletes}}"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Precio</label></td>
                                                <td>
                                                    <select name="precioIda" id="precioIda" class="select">
                                                        <option value="{{$i->economic_price}}">
                                                            Economic Class: {{$i->economic_price}}€</option>
                                                        <option value="{{$i->business_price}}">
                                                            Business Class: {{$i->business_price}}€</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="submit"  value="Agregar"></td>
                                            </tr>
                                        </form>
                                    @else
                                        <button><a class="bg-black text-white text-decoration-none" href="{{route('login')}}">Agregar </a></button>
                                    @endauth
                                </table>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-primary m-3">
                        <h2>No hay vuelos de ida disponibles de en esta fecha. Pruebe con otra fecha </h2>
                        <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver</a>
                    </div>
                @endif
            @else
                @if($numBilletes>1)
                    <h3>Billetes de ida seleccionados con ÉXITO</h3>
                @else
                    <h3>Billete de ida seleccionado con ÉXITO</h3>
                @endif
                <div class="formu">
                    <div id="divGeneral">
                        <table class="tablaFormu">
                            <tr>
                                <td><h5>{{$billete[0]->company}}</h5></td>
                            </tr>
                            <tr>
                                <td>{{$billete[0]->origin}} - {{$billete[0]->destination}}</td>
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
                                <td>Precio por billete: {{$billete[0]->price}}€</td>
                            </tr>
                            <tr>
                                <td>{{$billete[0]->flight_hours}}</td>
                            </tr>
                            <tr>
                                <td>Fecha y hora: {{substr($billete[0]->departing,0,16)}}</td>
                            </tr>

                        </table>
                    </div>
                </div>
        </div>
        <form method="post" action={{route('getVuelosVuelta')}}>
            <table>
                @csrf
                <tr>
                    <td>
                        <input type="hidden" name="fechaVuelta" value="{{$fechaVuelta}}">
                        <input type="hidden" name="origen" value="{{$billete[0]->destination}}">
                        <input type="hidden" name="destino" value="{{$billete[0]->origin}}">
                        <input type="hidden" name="numBilletes" value="{{$numBilletes}}">
                        <input type="hidden" name="idVueloIda" value="{{$billete[0]->id_flight}}">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="siguiente"></td>
                </tr>
            </table>
        </form>
    </div>
    @endif
    <div id="footer"></div>
@endsection
</body>
</html>
