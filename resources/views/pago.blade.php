<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Estilos -->
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
            if (year.value === '' || isNaN(year.value) || parseInt(year.value) < (new Date().getFullYear()) || parseInt(year.value) > 2099) {
                alert('Año no válido');
                return false;
            }
            if (cvv.value === '' || isNaN(cvv.value) || parseInt(cvv.value) > 1000) {
                alert('cvv no válido');
                return false;
            }
            return true;
        }

        function seleccionarDescuento() {
            let descuento = document.getElementById('descuento');
            let divDescuento = document.getElementById('divDescuento');
            divDescuento.innerHTML = '';
            descuento=descuento.options[descuento.selectedIndex];
            if (descuento.value !== 0) {
                let input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'descuento');
                input.setAttribute('required','required');
                input.value = descuento.value;
                divDescuento.appendChild(input);
            }
        }
    </script>
</head>
<body class="antialiased">

@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="formu m-4">
            <div id="divGeneral">
                <table class="tablaFormu">
                    <tr>
                        <td><h5>{{$ida[0]->company}}</h5></td>
                    </tr>
                    <tr>
                        <td>{{$ida[0]->origin}} - {{$ida[0]->destination}}</td>
                    </tr>
                    <tr>
                        <td>Precio por billete: {{$ida[0]->price}}€</td>
                    </tr>
                    <tr>
                        <td>{{$ida[0]->flight_hours}}</td>
                    </tr>
                    <tr>
                        <td>Fecha y hora: {{substr($ida[0]->departing,0,16)}}</td>
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
                            <td>{{$vuelta[0]->origin}} - {{$vuelta[0]->destination}}</td>
                        </tr>
                        <tr>
                            <td>Precio por billete: {{$vuelta[0]->price}}€</td>
                        </tr>
                        <tr>
                            <td>{{$vuelta[0]->flight_hours}}</td>
                        </tr>
                        <tr>
                            <td>Fecha y hora: {{substr($vuelta[0]->departing,0,16)}}</td>
                        </tr>
                        <tr>
                            <td>PRECIO VUELTA: {{($vuelta[0]->price)*$numBilletes }}€</td>
                        </tr>

                    </table>
                @endif
            </div>
        </div>
        <div>
            @if($idVueloVuelta!=null)
                    <?php $total = (($ida[0]->price) * $numBilletes + ($vuelta[0]->price) * $numBilletes); ?>
                <h2>TOTAL {{ (($ida[0]->price)*$numBilletes +($vuelta[0]->price)*$numBilletes) }}€</h2>
            @else
                    <?php $total = ($ida[0]->price) * $numBilletes; ?>
                <h2>TOTAL {{ ($ida[0]->price)*$numBilletes }}€</h2>

            @endif
        </div>
        @if($descuentos!=null)
            <div>
                <table class="table">
                    <tr>
                        <th>DESCUENTOS</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="descuento" id="descuento" class="select" onchange="seleccionarDescuento()" >
                                <option value="0">NINGUN DESCUENTO</option>
                                @foreach($descuentos as $desc)
                                    @if($desc->percentage==0.85)
                                        <option value="{{$desc->id_discount}}"> Descuento del 15% </option>
                                    @else
                                        <option value="{{$desc->id_discount}}"> Descuento del 20% </option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        <!-- Formulario Validación Tarjeta de Crédito -->
        <div class="">
            <div class="col-75">
                <div class="pagoContainer">
                    <form action="{{route('pagoFinal')}}" method="post" autocomplete="off"
                          onsubmit="return validar()">
                        @csrf
                        <div class="col-50">
                            <h3>Pago</h3>
                            <label>Titular de la tarjeta </label>
                            <input type="text" name="titular" id="titular" placeholder="Juan Pérez">
                            <label>Numero de tarjeta (Sólo VISA aceptada)</label>
                            <input type="text" id="numeroTarjeta" name="numeroTarjeta" maxlength="16"
                                   placeholder="4444333322221111">
                            <label>Mes de caducidad</label><br>
                            <select id="expmonth" name="expmonth" class="select">
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
                                    <label>Año de caducidad</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="2024" maxlength="4">
                                </div>
                                <div class="col-50">
                                    <label>CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="352" maxlength="3">
                                </div>
                            </div>
                            <input type="hidden" value="{{$idVueloIda}}" name="idVueloIda">
                            <input type="hidden" value="{{$total}}" name="total">
                            <div id="divDescuento"></div>
                            @if($idVueloVuelta!=null)
                                <input type="hidden" value="{{$idVueloVuelta}}" name="idVueloVuelta">
                            @endif
                            <input type="submit" value="Finalizar pago" class="btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
    </div>
@endsection
</body>
</html>
