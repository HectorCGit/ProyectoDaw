<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @vite(['resources/css/formularioIda.css'])
</head>
<body>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="formu">
                <a href="{{ route('crearVuelo') }}"
                   class="text-bg-success hover:bg-blue text-white font-bold py-2 px-4 rounded">CREAR</a>
                @if(!$companyFlights->isEmpty())
                    @foreach ($companyFlights as $flights)
                        <div id="divGeneral">
                            <div class="divGen">
                                <table class="tablaFormu">
                                    <tr>
                                        <td><h5>{{ $flights->company}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td><h1>{{ $flights->origin}}-{{ $flights->destination}}</h1></td>

                                    </tr>

                                    <tr>
                                        <td>Asientos
                                            disponibles: {{ ($flights->num_seats - $flights->num_passengers) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha y hora: {{ $flights->departing}}</td>

                                        <td>
                                            <form action="{{ route('eliminarVuelo')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="idFlight" value="{{$flights->id_flight}}">
                                                <input type="submit" class="bg-danger hover:bg-blue text-white font-bold py-2 px-4 rounded"
                                                value="BORRAR">
                                            </form>
                                        </td>
                                        <td><form action="{{ route('verBilletes')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="idFlight" value="{{$flights->id_flight}}">
                                                <input type="submit" class="bg-warning hover:bg-blue text-white font-bold py-2 px-4 rounded"
                                                       value="BILLETES">
                                            </form>
                                        </td>

                                    </tr>

                                </table>
                            </div>

                        </div>
                    @endforeach

                @else
                    <h2>NO HAY VUELOS</h2>
                @endif
            </div>
        </div>

    </div>

    <div>{{$companyFlights->links()}}</div>
@endsection

</body>
</html>

