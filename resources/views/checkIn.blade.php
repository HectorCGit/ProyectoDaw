<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @vite(['resources/css/checkIn.css'])
    <script type="text/javascript" defer>
        function confirmar() {
            if (confirm('¿Seguro que desea realizar ahora el check in? Solo tendrá validez si lo realiza 2 horas antes de la hora de embarque') === true) {
                return true;
            } else {
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
                    <h1>No hay billetes comprados actualmente</h1>
                </div>
            @else
                @foreach($tickets as $ticket)
                    <table class="tablaFormu table">
                        <tr>
                            <td>
                                <label>Nº Billete</label>
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
                                    <h5>Check_In Realizado</h5>
                                @else
                                    <h5>Check_In Pendiente</h5>
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Fecha</label>
                            </td>
                            <td>{{substr($ticket->departing,0,10)}}</td>

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
                            <td>
                                <label>Apellidos</label>
                            </td>
                            <td>{{$ticket->ticket_surname_passenger}}</td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <td colspan="4"><h4>{{$ticket->origin}} - {{$ticket->destination}}</h4></td>
                        </tr>
                        @if($ticket->check_in!=1)
                            <tr>
                                <td colspan="4">
                                    <form action="{{ route('checkIn')}}" method="post" onsubmit=" return confirmar()">
                                        @csrf
                                        <input type="hidden" name="idBillete" value="{{$ticket->id_ticket}}">
                                        <input type="submit"
                                               class="bg-danger hover:bg-blue text-white font-bold py-2 px-4 rounded"
                                               value="CheckIn">
                                    </form>
                                </td>
                            </tr>
                        @endif
                    </table>
                @endforeach
            @endif
        </div>
        <div class="pagination">{{$tickets->links()}}</div>
    </div>
    <div id="footer"></div>

@endsection
</body>
</html>

