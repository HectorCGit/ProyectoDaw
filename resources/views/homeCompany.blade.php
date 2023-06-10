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
    <div class="container mt-4">
        <div>
            <div class=" m-3">
                <a href="{{ route('crearVuelo') }}"
                   class="text-bg-success hover:bg-blue text-white font-bold py-2 px-4 rounded text-decoration-none">CREAR</a>
                @if(!$companyFlights->isEmpty())
                    @foreach ($companyFlights as $flights)

                            <div class="divGen">
                                <table class="table tablaFormu m-3 ">
                                    <tr>
                                        <td colspan="6"><h5>{{ $flights->company}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><h3>{{$flights->countryOrigin}}-{{$flights->origin}}</h3></td>
                                        <td colspan="3"><h3>{{$flights->countryDestination}}-{{$flights->destination}}</h3></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>{{$flights->originAirport}}</strong></td>
                                        <td colspan="3"><strong>{{ $flights->destinationAirport}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Numéro de vuelo: <strong>{{ $flights->id_flight}}</strong></td>
                                    </tr>

                                    <tr>
                                        <td colspan="6">Personas que han realizado el check-in <strong>{{$flights->num_check_in}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Asientos
                                            disponibles: <strong>{{$flights->num_seats - $flights->num_passengers}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Fecha y hora: {{ substr($flights->departing->format('d-m-Y H:i:s'),0,16)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <form action="{{ route('verBilletes')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="idFlight" value="{{$flights->id_flight}}">
                                                <input type="submit"
                                                       class="bg-warning hover:bg-blue text-white font-bold py-2 px-4 rounded"
                                                       value="BILLETES">
                                            </form>
                                        </td>
                                        <td colspan="2">
                                            <form action="{{ route('editarVuelo')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="idFlight" value="{{$flights->id_flight}}">
                                                <input type="submit"
                                                       class="bg-dark hover:bg-blue text-white font-bold py-2 px-4 rounded"
                                                       value="EDITAR">
                                            </form>
                                        </td>
                                        <td colspan="2">
                                            <form action="{{ route('eliminarVuelo')}}" method="post" onsubmit="return confirmacion()">
                                                @csrf
                                                <input type="hidden" name="idFlight" value="{{$flights->id_flight}}">
                                                <input type="submit"
                                                       class="bg-danger hover:bg-blue text-white font-bold py-2 px-4 rounded"
                                                       value="ELIMINAR">
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                    @endforeach
                @else
                    <div class="alert alert-success m-3">
                    <h2>NO HAY VUELOS</h2>
                    </div>
                @endif
            </div>
        </div>
        <div class="pagination">{{$companyFlights->links()}}</div>
        <div id="footer">
        </div>
    </div>

@endsection

</body>
</html>

