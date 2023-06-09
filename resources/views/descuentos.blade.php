<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    <!-- Styles -->
    @vite(['resources/css/carrito.css'])

</head>
<body class="min-vh-100 position-relative pb-xxl-5">

@extends('layouts.app')
@section('content')
    <div class="container ">
        <div>
            <div class="formu">
                @if($descuentos->isEmpty())
                    <div class="alert alert-success m-3">
                        <h1>No tiene ningún descuento actualmente</h1>
                    </div>
                @else
                    @foreach($descuentos as $d)
                        <table class="table table-responsive m-3 bg-success bg-opacity-50 text-black">
                            <tr>
                                <td colspan="2">Descuento del {{$d->percentage*100}}% </td>
                            </tr>

                        </table>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div id="footer" ></div>
@endsection
</body>
</html>
