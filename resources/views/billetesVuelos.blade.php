<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @vite(['resources/css/billetesCompany.css'])
    <script type="text/javascript" defer>
        function confirmacion(){
            if(confirm('¿Está seguro que desea eliminar el billete?')===true){
                return true;
            }else{
                return false;
            }
        }
    </script>
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class='container'>
        <div class="formu">
            @if($tickets->isEmpty())
                <div class="alert alert-success m-3">
                    <h1>No hay billetes comprados en este vuelo</h1>
                </div>
            @else
                @foreach($tickets as $ticket)
                    @csrf
                    <table class="table tablaFormu m-3">
                        <tr>
                            <td>
                                <label>Nº Billete</label>
                            </td>
                            <td>
                                {{$ticket->id_ticket}}
                            </td>
                        </tr>
                            <tr>
                            <td>
                                <label>Nº Vuelo </label>
                            </td>
                            <td>
                                {{$ticket->id_flight}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Descuento</label>
                            </td>
                            <td>
                                @if($ticket->id_discount!=null)
                                    {{$ticket->id_discount}}
                                @else
                                    <h5>NINGUNO</h5>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Check-in</label>
                            </td>
                            <td>
                                @if($ticket->check_in===1)
                                    <h5>Check_In Realizado</h5>
                                @else
                                    <h5>Check_In Pendiente</h5>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nº Maletas</label>
                            </td>
                            <td>
                                {{$ticket->num_suitcases}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Fecha</label>
                            </td>
                            <td>{{substr($ticket->departing,0,10)}}</td>
                        </tr>
                        <tr>
                            <td>
                                <label>Hora</label>
                            </td>
                            <td>{{substr($ticket->departing,11,5)}}</td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nombre</label>
                            </td>
                            <td>{{$ticket->ticket_name_passenger}}</td>
                        </tr>
                        <tr>
                            <td>
                                <label>Apellidos</label>
                            </td>
                            <td>{{$ticket->ticket_surname_passenger}}</td>
                        </tr>
                        <tr>
                            <td>
                                <label>Precio</label>
                            </td>
                            <td>{{$ticket->price}}</td>
                        </tr>
                        <tr>
                            <td>
                                <label>Origen</label>
                            </td>
                            <td>{{$ticket->origin}}-{{$ticket->countryOrigin}}</td>
                        </tr>
                        <tr>
                            <td>
                                <label>Destino</label>
                            </td>
                            <td>{{$ticket->destination}}-{{$ticket->countryDestination}}</td>
                        </tr>
                        <tr>
                            <td><label>Aeropuerto de salida:</label></td>
                            <td>{{$ticket->originAirport}}</td>
                        </tr>
                        <tr>
                            <td><label>Aeropuerto de llegada:</label></td>
                            <td>{{$ticket->destinationAirport}}</td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nº Check in</label>
                            </td>
                            <td>{{$ticket->num_check_in}}</td>
                        </tr>
                        <tr>
                            <td>
                                <label>Duración Vuelo</label>
                            </td>
                            <td>{{$ticket->flight_hours}}</td>
                        </tr>
                        <tr>
                            <td>
                                <form action="{{ route('eliminarBillete')}}" method="post" onsubmit="return confirmacion()">
                                    @csrf
                                    <input type="hidden" name="idBillete" value="{{$ticket->id_ticket}}">
                                    <input type="submit"
                                           class=" btn bg-danger text-white font-bold py-2 px-4 rounded"
                                           value="ELIMINAR">
                                </form>
                            </td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>
    </div>
    <div style="width: 400px; height: 400px">
    </div>
@endsection
</body>
</html>
