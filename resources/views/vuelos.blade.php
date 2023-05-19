<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/formularioPrincipal.css'])
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

        @if(!$flights->isEmpty())
                @foreach ($flights as $flight)
                    <table class="tablaFormu">
                        <tr>
                            <td>Compañia: {{ $flight->company}}</td>
                        </tr>
                        <tr>
                            <td>Ciudad de orígen: {{ $flight->origin}}</td>
                        </tr>
                        <tr>
                            <td>Ciudad de destino: {{ $flight->destination}}</td>
                        </tr>
                        <tr>
                            <td>Asientos disponibles: {{ ($flight->num_seats - $flight->num_passengers) }}</td>
                        </tr>
                        <tr>
                            <td>Fecha y hora: {{ $flight->departing}}</td>
                        </tr>
                    </table>
                @endforeach
        @else
            <h2>NO HAY VUELOS DISPONIBLES EN ESTA FECHA. PRUEBE CON OTRA FECHA </h2>
        @endif


        </div>
    @endsection

@endauth

</body>
</html>
