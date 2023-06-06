<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/formularioPrincipal.css'])
    @vite(['resources/css/vuelosAleatorios.css'])

    <script type="text/javascript" defer>
        function mostrarVuelta() {
            let checkbox = document.getElementById('idayvuelta');
            let textoVuelta = document.getElementById("titulovuelta");
            let campoVuelta = document.getElementById("campoVuelta");
            let inputVuelta = document.getElementById("vuelta");
            if (checkbox.checked === true) {

                campoVuelta.style.display="table-cell";

                textoVuelta.style.display = "table-cell";

                inputVuelta.setAttribute("required", "");
                inputVuelta.required = true;

            } else {
                campoVuelta.style.display = "none";
                textoVuelta.style.display = "none";
                inputVuelta.removeAttribute("required");

            }
        }
        function validacionDestino() {
            let origen = document.getElementById("campoOrigen");
            let destino = document.getElementById("campoDestino");
            let error = document.getElementById("error");
            if (origen.value === destino.value) {
                error.style.display = "block";
                return false;
            } else {
                error.style.display = "none";
                return true;
            }
        }
    </script>
</head>
<body>

@extends('layouts.app')
@section('content')
    <div id="divGeneral">
        {{-- Buscador Principal --}}
        <form action="{{ route('getVuelosIda') }}" method="post" autocomplete="off"
              onsubmit="return validacionDestino()">
            @csrf
            <div class="formu table-responsive">
                <div id="error">
                    Destino y origen no deben coincidir
                </div>
                <table class="tablaFormu">
                    <thead>
                    <tr>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Fecha de ida</th>
                        <th id="titulovuelta">Fecha de vuelta</th>
                        <th colspan="4">Billetes</th>
                    </tr>
                    </thead>
                    <tr>
                        <td><label>Origen </label>
                            <input list="origen" name="origen" placeholder="origen" id="campoOrigen" required/>
                            <datalist id="origen">
                                @foreach ($cities as $city)
                                    <option value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                                @endforeach
                            </datalist>
                        </td>
                        <td><label>Destino </label>
                            <input list="destino" name="destino" placeholder="destino" id="campoDestino" required/>
                            <datalist id="destino">
                                @foreach ($cities as $city)
                                    <option value={{ $city->city}}>{{ $city->city.' ('.$city->country.')'}}</option>
                                @endforeach
                            </datalist>
                        </td>
                        <td id="campoIda"><label>Fecha de ida </label>
                            <input type="date" name="ida" id="ida"  min="<?=date('Y-m-d');?>" required>
                        </td>
                        <td id="campoVuelta"><label>Fecha de vuelta </label>
                            <input type="date" name="vuelta" id="vuelta"  min="<?=date('Y-m-d');?>">
                        </td>
                        <td ><label>Billetes</label>
                            <input type="number" min="1" name="numBilletes" id="numBilletes" required>
                        </td>
                        <td>
                            <label for="idayvuelta" class="idayvuelta">Ida y vuelta</label>
                            <input type="checkbox" name="idayvuelta" id="idayvuelta" onclick="mostrarVuelta()">
                        </td>
                        <td>
                            <input type="submit" value="Consultar Disponibilidad">
                        </td>
                    </tr>

                </table>

            </div>
        </form>

        {{-- Carrusel de fotos  --}}
        <div id="fotosCarousel" class="carousel slide pb-5" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#fotosCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#fotosCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#fotosCarousel" data-bs-slide-to="2"></button>
            </div>
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        src="{{Vite::asset('public/carrusel/carrusel1.jpg')}}"
                        alt="Playa de Thailandia" class="d-block w-100" style=" height: 70vh">
                </div>
                <div class="carousel-item">
                    <img
                        src="{{Vite::asset('public/carrusel/carrusel2.jpg')}}"
                        alt="Castillo de Liubliana" class="d-block w-100" style="height: 70vh">
                </div>
                <div class="carousel-item">
                    <img
                        src="{{Vite::asset('public/carrusel/carrusel3.jpeg')}}"
                        alt="Vuelo en avión" class="d-block w-100" style="height: 70vh">
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

    <div class="container ">
        @foreach($randomFlights as $randomF)
            <div class=" d-block ">
                <div class="d-flex justify-content-center pb-4">
                    <div class="w-50 h-50 bordeImagenAleatoria"><img id="img1" class="w-100 h-100" src="{{Vite::asset($randomF->photo)}}"
                                                                     alt="img de Viaje"></div>
                    <div class="w-50 h-50 divVueloAleatorio">
                        <a class="enlaceVueloAleatorio" href="">
                            <table class="tablaVuelosAleatorios">
                                <tr>
                                    <th><h2>{{$randomF->company}}</h2></th>
                                </tr>
                                <tr>
                                    <th>Origen-Destino</th>
                                    <td><h5>{{$randomF->origin}} - {{$randomF->destination}}</h5></td>
                                </tr>
                                <tr>
                                    <th>Fecha</th>
                                    <td>{{substr($randomF->departing,0,10)}}</td>
                                </tr>
                                <tr>
                                    <th>Hora</th>
                                    <td>{{substr($randomF->departing,11,5)}}</td>
                                </tr>
                                <tr>
                                    <th>Economic Class</th>
                                    <td>{{$randomF->economic_price}}€</td>
                                </tr>
                                <tr>
                                    <th>Business Class</th>
                                    <td>{{$randomF->business_price}}€</td>
                                </tr>
                            </table>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
    </div>
    <div style="width: 400px; height: 100px"></div>
@endsection
</body>
</html>
