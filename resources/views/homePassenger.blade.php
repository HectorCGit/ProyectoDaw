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
            console.log(destino.value);
            let error = document.getElementById("error");
            if (origen.value === destino.value) {
                error.style.display = "block";
                return false;
            } else {
                error.style.display = "none";
                return true;
            }
        }

        let arrayImagenes = ['https://101lugaresincreibles.com/wp-content/uploads/2013/12/vuelos-baratos-ofertas-consejos.jpg',
            'https://www.turijobs.com/blog/wp-content/uploads/2018/12/curso-auxiliar-vuelo-alicante3-1024x675.png',
            'https://estaticos.esmadrid.com/cdn/farfuture/cWEgd6nsFZn5_x7RaedKMR9rkPA7ZC3zVuc90k6gXwA/mtime:1646729215/sites/default/files/styles/content_type_full/public/editorial/estaciones.jpg?itok=8J6mUZg3',
            'https://imagenes.20minutos.es/files/image_990_v3/uploads/imagenes/2021/10/25/imagen-de-archivo-de-una-azafata-en-un-avion.jpeg',
            'https://media.traveler.es/photos/6362868d644e40e8ad7267f7/16:9/w_2560%2Cc_limit/Singapore_shawnanggg--S15r4VsQhY-unsplash.jpg',
            'https://media.revistagq.com/photos/619cf9cdf654c19d66ebdde7/16:9/pass/GettyImages-1327520504.jpg',
            'https://viajes.nationalgeographic.com.es/medio/2021/08/26/altea-alicante_0d28875a_1000x667.jpg',
            'https://ep01.epimg.net/elviajero/imagenes/2016/10/06/album/1475753380_398682_1564140964_noticia_normal.jpg',
            'https://media.revistagq.com/photos/5db0697490f9460008ed9a19/16:9/w_2560%2Cc_limit/GettyImages-912417636.jpg',
            'https://viajes.nationalgeographic.com.es/medio/2019/08/17/ferrocarril-de-la-selva-negra-cerca-de-hornberg_a3a08035_800x800.jpg',
            'https://ichef.bbci.co.uk/news/640/cpsprodpb/DA84/production/_103004955_gettyimages-607461000.jpg',
            'https://gacetadelturismo.com/wp-content/uploads/sites/8/2022/10/Turismo-730x412.jpg']

        function imagenAleatoria() {
            let randomNum1, randomNum2, randomNum3, randomNum4;
            randomNum1 = Math.floor(Math.random() * arrayImagenes.length);
            randomNum2 = Math.floor(Math.random() * arrayImagenes.length);
            randomNum3 = Math.floor(Math.random() * arrayImagenes.length);
            randomNum4 = Math.floor(Math.random() * arrayImagenes.length);
            while (randomNum1 === randomNum2 || randomNum1 === randomNum3 || randomNum1 === randomNum4) {
                randomNum1 = Math.floor(Math.random() * arrayImagenes.length);
            }
            while (randomNum1 === randomNum2 || randomNum2 === randomNum3 || randomNum2 === randomNum4) {
                randomNum2 = Math.floor(Math.random() * arrayImagenes.length);
            }
            while (randomNum1 === randomNum3 || randomNum2 === randomNum3 || randomNum3 === randomNum4) {
                randomNum3 = Math.floor(Math.random() * arrayImagenes.length);
            }
            while (randomNum4 === randomNum1 || randomNum4 === randomNum2 || randomNum3 === randomNum4) {
                randomNum4 = Math.floor(Math.random() * arrayImagenes.length);
            }
            document.getElementById("img1").src = arrayImagenes[randomNum1];
            document.getElementById("img2").src = arrayImagenes[randomNum2];
            document.getElementById("img3").src = arrayImagenes[randomNum3];
            document.getElementById("img4").src = arrayImagenes[randomNum4];
        }
    </script>
</head>
<body onload="imagenAleatoria()">

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
                            <input type="date" name="ida" id="ida" required>
                        </td>
                        <td id="campoVuelta"><label>Fecha de vuelta </label>
                            <input type="date" name="vuelta" id="vuelta">
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
                        src="https://www.felicesvacaciones.es/blog/pics/2014/12/secret-retreats-discoveries-thailand-phuket-2.webp"
                        alt="Playa de Thailandia" class="d-block w-100" style=" height: 70vh">
                </div>
                <div class="carousel-item">
                    <img
                        src="https://elviajerofeliz.com/wp-content/uploads/2019/11/Qu%C3%A9-ver-en-Liubliana-Castillo-.jpg"
                        alt="Castillo de Liubliana" class="d-block w-100" style="height: 70vh">
                </div>
                <div class="carousel-item">
                    <img
                        src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MXx8fGVufDB8fHx8&w=1000&q=80"
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
                    <div class="w-50 h-50 bordeImagenAleatoria"><img id="img1" class="w-100 h-100" src=""
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
