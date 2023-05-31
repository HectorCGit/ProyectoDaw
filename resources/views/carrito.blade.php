<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/formularioIda.css'])

</head>
<body class="min-vh-100 position-relative pb-xxl-5">

@extends('layouts.app')
@section('content')
    <div class="container">
        <div id="divGeneral">
            <div class="formu">
                <div id="divGeneral">
                    <table class="tablaFormu">
                        @if($billetes->isEmpty())
                            <h1>NO HAY NADA EN EL CARRITO</h1>
                        @else
                            @foreach($billetes as $b)
                                <tr>
                                    <td><h5 style="visibility: hidden">{{$b->id_ticket}}</h5></td>
                                </tr>
                                <tr>
                                    <td>{{$b->origin}} - {{$b->destination}}</td>
                                </tr>
                                <tr>
                                    <td>{{$b->flight_hours}}</td>
                                </tr>
                                <tr>
                                    <td>Fecha y hora: {{$b->departing}}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Nombre {{$b->ticket_name_passenger}}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Apellidos {{$b->ticket_surname_passenger}}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>{{$b->check_in}}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <form action="{{route('cancelarBillete')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="idTicket" value="{{$b->id_ticket}}">
                                            <input type="submit" value="Cancelar vuelo">
                                        </form>
                                    </td>
                                </tr>
                                <td>----------------------------------------</td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </div>
            </div>
        </div>
        <div style="width: 400px; height: 400px">
        </div>
    </div>
@endsection
</body>
</html>
