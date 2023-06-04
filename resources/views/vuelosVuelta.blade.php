<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Estilos -->
    @vite(['resources/css/formularioIdaVuelta.css'])
</head>
<body class="min-vh-100 position-relative pb-xxl-5">

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="m-3">
            @if($contador==0)
                @if(!$vuelta->isEmpty())
                    <h1>Vuelos de vuelta</h1>
                    @foreach ($vuelta as $v)
                        <div id="divGeneral">
                            <div class="divGen">
                                @if(($v->num_seats - $v->num_passengers)>=$numBilletes )
                                    <table class="tablaFormu">
                                        <tr>
                                            <td><h4>{{$v->company}}</h4></td>
                                        </tr>
                                        <tr>
                                            <td>Ciudad de orígen: {{ $v->origin}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ciudad de destino: {{ $v->destination}}</td>
                                        </tr>
                                        <tr>
                                            <td>Asientos
                                                disponibles: {{ ($v->num_seats - $v->num_passengers) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Fecha y hora: {{ substr($v->departing,0,16)}}</td>
                                        </tr>

                                    </table>
                                @else
                                    <div class="alert alert-primary m-3">
                                        <h2>No hay vuelos de vuelta disponibles con asientos disponibles con asientos
                                            disponibles en esta fecha.
                                            Pruebe con otra fechas</h2>
                                        <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver</a>
                                    </div>
                                @endif
                            </div>
                            <div class="divGen">
                                <table class="tablaFormu">
                                    @auth
                                        <form action="{{route('getBilletesVuelta')}}" method="post">
                                            @csrf
                                            <tr>
                                                <td><input type="hidden" name="idFlight" value="{{$v->id_flight}}"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" name="numBilletes" value="{{$numBilletes}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" name="idVueloIda" value="{{$idVueloIda}}"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Precio</label></td>
                                                <td><select name="precioIda" id="precioIda" class="select">
                                                        <option value="{{$v->economic_price}}">
                                                            Economic Class: {{$v->economic_price}}€</option>
                                                        <option value="{{$v->business_price}}">
                                                            Business Class: {{$v->business_price}}€</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="submit" value="Agregar"></td>
                                            </tr>
                                        </form>
                                    @else
                                        <button><a href="{{route('login')}}"> Agregar </a></button>
                                    @endauth
                                </table>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-primary m-3">
                        <h2>No hay vuelos de vuelta disponibles de en esta fecha. Pruebe con otra fecha </h2>
                        <a class="text-decoration-none" href="{{route('homePassenger')}}">Volver</a>
                    </div>
                @endif
            @else
                @if($numBilletes>1)
                    <h3>Billetes de vuelta seleccionados con ÉXITO</h3>
                @else
                    <h3>Billete de vuelta seleccionado con ÉXITO</h3>
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
        <form method="post" action={{route('getBilletesDatos')}}>
            <table>
                @csrf
                <tr>
                    <td>
                        <input type="hidden" name="idVueloIda" value="{{$idVueloIda}}">
                        <input type="hidden" name="idVueloVuelta" value="{{$billete[0]->id_flight}}">
                        <input type="hidden" name="numBilletes" value="{{$numBilletes}}">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="siguiente">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    @endif
    <div id="footer"></div>
@endsection


</body>
</html>
