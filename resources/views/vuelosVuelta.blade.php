<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/formularioIda.css'])


</head>
<body class="min-vh-100 position-relative pb-xxl-5">

@extends('layouts.app')
@section('content')
    <div>
        <div class="formu">
            <h1>Vuelos de vuelta</h1>
            @if($contador==0)
                @if(!$vuelta->isEmpty())
                    @foreach ($vuelta as $v)
                        <div id="divGeneral">
                            <div class="divGen">
                                @if(($v->num_seats - $v->num_passengers)>=$numBilletes )
                                    <table class="tablaFormu">
                                        <tr>
                                            <td><h5>{{$v->company}}</h5></td>
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
                                            <td>Fecha y hora: {{ $v->departing}}</td>
                                        </tr>

                                    </table>
                                @else
                                    <h2>NO HAY VUELOS DE VUELTA DISPONIBLES CON ASIENTOS DISPONIBLES EN ESTA FECHA.
                                        PRUEBE CON OTRA FECHA </h2>
                                @endif
                            </div>
                            <div class="w-30 h-50 p-3">
                                @auth
                                    <form action="{{route('getBilletesVuelta')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="idFlight" value="{{$v->id_flight}}">
                                        <input type="hidden" name="numBilletes" value="{{$numBilletes}}">
                                        <input type="hidden" name="idVueloIda" value="{{$idVueloIda}}">
                                        <label>Precio</label>
                                        <select name="precioIda" id="precioIda">
                                            <option value="{{$v->economic_price}}">
                                                Económico: {{$v->economic_price}}</option>
                                            <option value="{{$v->business_price}}">
                                                Business: {{$v->business_price}}</option>
                                        </select><br><br>
                                        <input type="submit" value="Agregar">
                                    </form>
                                @else
                                    <button><a href="{{route('login')}}"
                                               style="text-decoration: none; color: white"> Agregar </a></button>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2>NO HAY VUELOS DE VUELTA DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
                @endif
            @else
                @if($numBilletes>1)
                    <h2>Billetes de vuelta seleccionados con ÉXITO</h2>
                @else
                    <h2>Billete de vuelta seleccionado con ÉXITO</h2>
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
        <form method="post" action={{route('getBilletesDatos')}}>
            @csrf
            <input type="hidden" name="idVueloIda" value="{{$idVueloIda}}">
            <input type="hidden" name="idVueloVuelta" value="{{$billete[0]->id_flight}}">
            <input type="hidden" name="numBilletes" value="{{$numBilletes}}">
            <input type="submit" value="siguiente">
        </form>
    </div>
    @endif
@endsection


</body>
</html>
