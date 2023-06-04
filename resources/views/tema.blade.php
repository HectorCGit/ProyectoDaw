<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @vite(['resources/css/foro.css'])
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class='container'>
        <div class="custom-table">
            <table class="table bg-white">
                <tr>
                    <td><h4>{{$temaElegido[0]->content}}</h4></td>
                </tr>
            </table>
            <div class="formu">
                @foreach($mensajes as $mensaje)
                    <form action="{{route('mostrarMensajes')}}" method="post">
                        <table class="tablaFormu ">
                            <tr>
                                <td class="usuario">{{$mensaje->name}}</td>
                            </tr>
                            <tr>
                                <td class="mensaje">{{$mensaje->content}}</td>
                            </tr>
                        </table>
                    </form>
                    <div>
                        @if( Auth::user()->hasRole('admin'))
                            <form action="{{ route('eliminarMensajes') }}" method="POST">
                                <table>
                                    @csrf
                                    <tr>
                                        <td><input type="hidden" name="idMensaje" value="{{$mensaje->id_message}}"></td>
                                        <td><input type="hidden" name="temaElegido" value="{{$temaElegido}}"></td>
                                        <td><input type="submit" id="botonBorrarTema" value="Eliminar"></td>
                                    </tr>
                                </table>
                            </form>
                        @endif
                    </div>
                @endforeach
                @auth
                    <form action="{{route('crearMensajes')}}" method="post" autocomplete="off">
                        @csrf
                        <table>
                            <tr>
                                <td><input type="hidden" name="idTema" value="{{$temaElegido[0]->id_topic}}"></td>
                                <td><input class="form-control" type="text" name="contenido"></td>
                                <td><input type="submit" value="Responder"></td>
                            </tr>
                        </table>
                    </form>
                @endauth
            </div>
            <div>{{$mensajes->links()}}</div>
        </div>
    </div>
    <div style="width: 400px; height: 400px">
    </div>
@endsection
</body>
</html>
