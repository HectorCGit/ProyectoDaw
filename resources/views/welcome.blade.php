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

        <script>
            function async datos(){
              const response= await  axios.post('/',document.querySelector('#paises').value);

            }
        </script>
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
                {{-- Buscadores --}}
                <div class="text-center items-center">
                    <form>
                        <table style="border:1px black solid">
                            <tr>
                                <th>Origen</th>
                                <br>
                            </tr>
                            <tr>
                                <td>
                                    <label>Paises</label>
                                    <input list="paises" name="paises" id="paises"  onfocusout="datos()" >
                                    <datalist>
                                        @foreach ($countries as $country)
                                            <option value={{$country->name}}>
                                        @endforeach
                                    </datalist>
                                </td>
                                <br>
                                <td>
                                    <label>Ciudades</label>
                                    <input list="ciudades" name="ciudades" />
                                    <datalist id="ciudades">
                                        @foreach ($cities as $city)

                                            <option value={{$city->name}}>
                                        @endforeach
                                    </datalist>
                                </td>
                            </tr>
                            <tr>
                                <th>Destino</th>
                                <br>
                            </tr>
                            <tr>
                                <td>
                                    <label>Paises</label>
                                    <input list="paises" name="paises" />
                                    <datalist id="paises">
                                        @foreach ($countries as $country)
                                            <option value={{$country->name}}>
                                        @endforeach
                                    </datalist>
                                </td>
                                <br>
                                <td>
                                    <label>Ciudades</label>
                                    <input list="ciudades" name="ciudades" />
                                    <datalist id="ciudades">
                                        <option value="madrid">
                                        <option value="paris">
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                    </datalist>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                {{-- Carrusel de fotos  --}}
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://www.felicesvacaciones.es/blog/pics/2014/12/secret-retreats-discoveries-thailand-phuket-2.webp" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://elviajerofeliz.com/wp-content/uploads/2019/11/Qu%C3%A9-ver-en-Liubliana-Castillo-.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Third slide">
                        </div>
                    </div>
                </div>
            @endsection
    @endauth

    </body>
</html>
