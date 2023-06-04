<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/misBilletes.css'])

</head>
<body class="min-vh-100 position-relative pb-xxl-5">

@extends('layouts.app')
@section('content')
    <div class="container ">
        <div>
            <div class="formu">
                @if($billetes->isEmpty())
                    <h1>NO HAY NADA EN EL CARRITO</h1>
                @else
                    @foreach($billetes as $b)
                        <table class="tablaFormu">
                            <tr style="visibility: hidden">
                                <td>{{$b->id_ticket}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><h5>{{$b->origin}} - {{$b->destination}}</h5></td>
                            </tr>
                            <tr>
                                <td colspan="2">{{$b->flight_hours}}</td>
                            </tr>
                            <tr>
                                <td>Fecha y hora: </td>
                                <td>{{substr($b->departing,0,16)}}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Nombre: </td>
                                <td>{{$b->ticket_name_passenger}}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Apellidos: </td>
                                <td>{{$b->ticket_surname_passenger}}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>{{$b->check_in}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <form action="{{route('cancelarBillete')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="idTicket" value="{{$b->id_ticket}}">
                                        <input type="submit" value="Cancelar vuelo">
                                    </form>
                                </td>
                            </tr>

                        </table>
                    @endforeach
                @endif


            </div>
        </div>
    </div>
    <div style="width: 400px; height: 400px"></div>

@endsection
</body>
</html>
