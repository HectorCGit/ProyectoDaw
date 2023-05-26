<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/formularioIda.css'])
    @vite(['resources/css/pago.css'])

    <script type="text/javascript" defer>
        function validar() {
            let titular = document.getElementById('titular');
            let numTarj = document.getElementById('numeroTarjeta');
            let year = document.getElementById('expyear');
            let cvv = document.getElementById('cvv');
            if (titular.value === '') {
                alert('Debes rellenar tu nombre');
                return false;
            }
            if (!((numTarj.value).match('^4[0-9]{12}(?:[0-9]{3})?$'))) {
                alert('Número de tarjeta no válido');
                return false;
            }
            if (year.value === '' || isNaN(year.value) || parseInt(year.value) < (new Date().getFullYear()) || parseInt(year.value) >2099) {
                alert('Año no válido');
                return false;
            }
            if (cvv.value === '' || isNaN(cvv.value) || parseInt(cvv.value) > 1000) {
                alert('cvv no válido');
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="antialiased">

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="formu">
            <div id="divGeneral">
                <table class="tablaFormu">
                    <tr>
                        <td><h5>{{$ida[0]->company}}</h5></td>
                    </tr>
                    <tr>
                        <td>Ciudad de orígen: {{$ida[0]->origin}}</td>
                    </tr>
                    <tr>
                        <td>Ciudad de destino: {{$ida[0]->destination}}</td>
                    </tr>
                    <tr>
                        <td>Precio por billete: {{$ida[0]->price}}€</td>
                    </tr>
                    <tr>
                        <td>{{$ida[0]->flight_hours}}</td>
                    </tr>
                    <tr>
                        <td>Fecha y hora: {{$ida[0]->departing}}</td>
                    </tr>
                    <tr>
                        <td>PRECIO IDA: {{($ida[0]->price)*$numBilletes }}€</td>
                    </tr>

                </table>
                @if($idVueloVuelta!=null)
                    <table class="tablaFormu">
                        <tr>
                            <td><h5>{{$vuelta[0]->company}}</h5></td>
                        </tr>
                        <tr>
                            <td>Ciudad de orígen: {{$vuelta[0]->origin}}</td>
                        </tr>
                        <tr>
                            <td>Ciudad de destino: {{$vuelta[0]->destination}}</td>
                        </tr>
                        <tr>
                            <td>Precio por billete: {{$vuelta[0]->price}}€</td>
                        </tr>
                        <tr>
                            <td>{{$vuelta[0]->flight_hours}}</td>
                        </tr>
                        <tr>
                            <td>Fecha y hora: {{$vuelta[0]->departing}}</td>
                        </tr>
                        <tr>
                            <td>PRECIO VUELTA:{{($vuelta[0]->price)*$numBilletes }}€</td>
                        </tr>

                    </table>
                @endif
            </div>
        </div>
        <div>
            @if($idVueloVuelta!=null)
                <h2>TOTAL {{ (($ida[0]->price)*$numBilletes +($vuelta[0]->price)*$numBilletes) }}€</h2>
            @else
                <h2>TOTAL {{ ($ida[0]->price)*$numBilletes }}€</h2>

            @endif
        </div>

        <!-- Formulario Validación Tarjeta de Crédito -->
        <div class="row">
            <div class="col-75">
                <div class="container">
                    <form action="{{route('pagoFinal')}}" method="post" autocomplete="off"
                          onsubmit="return validar()">
                        @csrf
                        <div class="col-50">
                            <h3>Pago</h3>
                            <label for="cname">Titular de la tarjeta </label>
                            <input type="text" name="titular" id="titular" placeholder="Juan Pérez">
                            <label for="ccnum">Numero de tarjeta (Sólo VISA aceptada)</label>
                            <input type="text" id="numeroTarjeta" name="numeroTarjeta" maxlength="16"
                                   placeholder="4444222233334444">
                            <label for="expmonth">Mes de caducidad</label>
                            <select id="expmonth" name="expmonth">
                                <option>Enero</option>
                                <option>Febrero</option>
                                <option>Marzo</option>
                                <option>Abril</option>
                                <option>Mayo</option>
                                <option>Junio</option>
                                <option>Julio</option>
                                <option>Agosto</option>
                                <option>Septiembre</option>
                                <option>Noviembre</option>
                                <option>Diciembre</option>
                            </select>
                            <div class="row">
                                <div class="col-50">
                                    <label for="expyear">Año de caducidad</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="2024" maxlength="4">
                                </div>
                                <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="352" maxlength="3">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="{{$idVueloIda}}" name="idVueloIda">
                        @if($idVueloVuelta!=null)
                            <input type="hidden" value="{{$idVueloVuelta}}" name="idVueloVuelta">
                        @endif
                        <input type="submit" value="Finalizar pago" class="btn">
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
</body>
</html>
