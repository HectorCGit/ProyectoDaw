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
@auth
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
            </div>
        @endif
    </div>
@else
    @extends('layouts.app')
    @section('content')
        <div class="formu">
            <h1>Vuelos de ida</h1>

        @if(!$ida->isEmpty())
                @foreach ($ida as $i)
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
                        <h2>NO HAY VUELOS DE IDA DISPONIBLES CON ASIENTOS DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
                    @endif
                @endforeach
        @else
            <h2>NO HAY VUELOS DE IDA DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
        @endif


        </div>

        <div class="formu">
            <h1>Vuelos de vuelta</h1>

            @if(!$vuelta->isEmpty())
                @foreach ($vuelta as $v)
                    @if(($v->num_seats - $v->num_passengers)>=$billetes )
                        <table class="tablaFormu">
                            <tr>
                                <td><h5>{{ $v->company}}</h5></td>
                            </tr>
                            <tr>
                                <td>Ciudad de orígen: {{ $v->origin}}</td>
                            </tr>
                            <tr>
                                <td>Ciudad de destino: {{ $v->destination}}</td>
                            </tr>
                            <tr>
                                <td>Asientos disponibles: {{ ($v->num_seats - $v->num_passengers) }}</td>
                            </tr>
                            <tr>
                                <td>Fecha y hora: {{ $v->departing}}</td>
                            </tr>
                        </table>
                    @else
                        <h2>NO HAY VUELOS DE VUELTA DISPONIBLES CON ASIENTOS DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
                    @endif
                @endforeach
            @else
                <h2>NO HAY VUELOS DE VUELTA DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
            @endif


        </div>
    @endsection

@endauth

</body>
</html>
