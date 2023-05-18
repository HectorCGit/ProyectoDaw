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
                <div id="divGeneral">
                    {{-- Buscador Principal --}}
                    <form>
                        <div class="formu">
                            <table class="tablaFormu">
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
                                        <input type="submit" value="Consultar Disponibilidad" class="buscar">
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </form>

                {{-- Carrusel de fotos  --}}
                    <div id="fotosCarousel" class="carousel slide " data-bs-ride="carousel">
                        <!-- Indicators/dots -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#fotosCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#fotosCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#fotosCarousel" data-bs-slide-to="2"></button>
                        </div>
                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://www.felicesvacaciones.es/blog/pics/2014/12/secret-retreats-discoveries-thailand-phuket-2.webp" alt="Playa de Thailandia" class="d-block w-100" style=" height: 70vh">
                            </div>
                            <div class="carousel-item">
                                <img src="https://elviajerofeliz.com/wp-content/uploads/2019/11/Qu%C3%A9-ver-en-Liubliana-Castillo-.jpg" alt="Castillo de Liubliana" class="d-block w-100" style="height: 70vh">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MXx8fGVufDB8fHx8&w=1000&q=80" alt="Vuelo en avión" class="d-block w-100" style="height: 70vh">
                            </div>
                        </div>
                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#fotosCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#fotosCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            @endsection

    @endauth

    </body>
</html>
