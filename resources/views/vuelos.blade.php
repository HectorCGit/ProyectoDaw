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

                @if(!$ida->isEmpty())
                    @foreach ($ida as $i)
                        <div id="divGeneral">
                            <div class="divGen">
                                @if(($i->num_seats - $i->num_passengers)>=$billetes )
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
                                            <td>Asientos disponibles: {{ ($i->num_seats - $i->num_passengers) }}</td>

                                        </tr>
                                        <tr>
                                            <td>Fecha y hora: {{ $i->departing}}</td>
                                        </tr>

                                    </table>
                                @else
                                    <h2>NO HAY VUELOS DE IDA DISPONIBLES CON ASIENTOS DISPONIBLES EN ESTA FECHA. PRUEBE
                                        CON OTRA FECHA </h2>
                                @endif
                            </div>
                            <div class="w-30 h-50 p-3">
                                @auth
                                    <form action="{{route('comprar')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="idFlight" value="{{$i->id_flight}}">
                                        <input type="hidden" name="company" value="{{$i->company}}">
                                        <input type="hidden" name="origin" value="{{$i->origin}}">
                                        <input type="hidden" name="destination" value="{{$i->destination}}">
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
                                    <button><a href="{{route('login')}}" style="text-decoration: none; color: white">
                                            Agregar </a></button>
                                @endauth

                            </div>
                        </div>

                    @endforeach

                @else
                    <h2>NO HAY VUELOS DE IDA DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
                @endif
            </div>
        </div>

        <div>
            <div class="formu">

                @if($vuelta!="sin vuelta")
                    @if(!$vuelta->isEmpty())
                        <h1>Vuelos de vuelta</h1>
                        @foreach ($vuelta as $v)
                            <div id="divGeneral">
                                <div class="divGen">
                                    @if(($v->num_seats - $v->num_passengers)>=$billetes )
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
                                            <tr>
                                                <td>
                                                    <label>Precio</label>
                                                    <select name="precioVuelta" id="precioVuelta">
                                                        <option value="{{$i->economic_price}}">
                                                            Económico: {{$i->economic_price}}</option>
                                                        <option value="{{$i->business_price}}">
                                                            Business: {{$i->business_price}}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    @else
                                        <h2>NO HAY VUELOS DE VUELTA DISPONIBLES CON ASIENTOS DISPONIBLES EN ESTA FECHA.
                                            PRUEBE CON OTRA FECHA </h2>
                                    @endif
                                </div>
                                <div class="w-30 h-50 p-3">
                                    @auth
                                        <form>
                                            <input type="hidden" name="company" value="{{$i->company}}">
                                            <input type="hidden" name="origin" value="{{$i->origin}}">
                                            <input type="hidden" name="destination" value="{{$i->destination}}">
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
                @endif

            </div>
        </div>
            <form action="" style="display: none">
                <input type="submit" value="siguiente">
            </form>
    </div>
@endsection


</body>
</html>
