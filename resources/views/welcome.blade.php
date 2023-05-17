<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aeroweb</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
        </style>
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


                <div style="position:relative">
                    {{-- Buscadores --}}
                    <div class="text-center items-center p-2" style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); z-index:1;">
                        <form>
                            <table style="border:2px white solid" class="w-100 p-2 bg-warning">
                                <tr>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th>Fecha de ida</th>
                                    <th>Fecha de vuelta</th>
                                    <th>Billetes</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input list="origen" name="origen" />
                                        <datalist id="origen">
                                            @foreach ($cities as $city)
                                                <option value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                                            @endforeach
                                        </datalist>
                                    </td>

                                    <td>
                                        <input list="destino" name="destino" />
                                        <datalist id="destino">
                                            @foreach ($cities as $city)
                                                <option value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                                            @endforeach
                                        </datalist>
                                    </td>
                                    <td>
                                        <input type="date">
                                    </td>
                                    <td>
                                        <input type="date">
                                    </td>
                                    <td>
                                        <input type="number">
                                    </td>
                                    <td>
                                        <input type="submit" value="Consultar Disponibilidad">
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>


                {{-- Carrusel de fotos  --}}

                <!-- Carousel -->
                <div id="demo" class="carousel slide " data-bs-ride="carousel">

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://elviajerofeliz.com/wp-content/uploads/2019/11/Qu%C3%A9-ver-en-Liubliana-Castillo-.jpg" alt="Los Angeles" class="d-block w-100" style=" height: 70vh">
                        </div>
                        <div class="carousel-item">
                            <img src="https://img.freepik.com/foto-gratis/pareja-familia-viajando-juntos_1150-7772.jpg" alt="Chicago" class="d-block w-100" style="height: 70vh">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MXx8fGVufDB8fHx8&w=1000&q=80" alt="New York" class="d-block w-100" style="height: 70vh">
                        </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
                </div>

            @endsection
    @endauth

    </body>
</html>
