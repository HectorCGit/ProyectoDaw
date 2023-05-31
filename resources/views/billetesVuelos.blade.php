<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/formularioIda.css'])

</head>
<body>
@extends('layouts.app')
@section('content')
    <div class='container'>
        <div class="formu">
        @foreach($tickets as $ticket)
            @csrf
            <table class="tablaFormu">
                <tr>
                    <td>
                        <label>Nº Ticket</label>
                    </td>
                    <td>
                        {{$ticket->id_ticket}}
                    </td>
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

                    <td>
                        <label>Check-in</label>
                    </td>
                    <td>
                        @if($ticket->check_in===1)
                            <h5>DISPONIBLE</h5>
                        @endif
                        <h5>NO DISPONIBLE</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Nº Maletas</label>
                    </td>
                    <td>
                        {{$ticket->num_suitcases}}
                    </td>

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

                    <td>
                        <label>Precio</label>
                    </td>
                    <td>{{$ticket->price}}</td>
                </tr>
                <tr>
                    <td>
                        <label>Nº Check in</label>
                    </td>
                    <td>{{$ticket->num_check_in}}</td>
                    <td>
                        <label>Origen</label>
                    </td>
                    <td>{{$ticket->origin}}</td>
                </tr>
                <tr>
                    <td>
                        <label>Destino</label>
                    </td>
                    <td>{{$ticket->destination}}</td>

                    <td>
                        <label>Duración Vuelo</label>
                    </td>
                    <td>{{$ticket->flight_hours}}</td>
                </tr>
                <tr>
                    <td>
                        <form action="{{ route('eliminarBillete')}}" method="post">
                            @csrf
                            <input type="hidden" name="idBillete" value="{{$ticket->id_ticket}}">
                            <input type="submit"
                                   class="bg-danger hover:bg-blue text-white font-bold py-2 px-4 rounded"
                                   value="ELIMINAR">
                        </form>
                    </td>
                </tr>
            </table>
            @endforeach
        </div>

    </div>
@endsection
</body>
</html>
