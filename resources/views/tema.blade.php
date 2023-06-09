<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @auth
        @if(Auth::user()->hasRole('admin'))
            @vite(['resources/css/admin.css'])
        @else
            @vite(['resources/css/foro.css'])
        @endif
    @else
        @vite(['resources/css/foro.css'])
    @endauth
    <script defer>
        function validar() {
            let mensaje = document.getElementById('mensaje');
            if (!/^\S+$/.test(mensaje.value)) {
                return false;
            }
        }

        function confirmacion() {
            if (confirm('¿Seguro que desea  eliminar este mensaje?') === true) {
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
                                <td class="usuario"><strong>{{$mensaje->name}}</strong></td>
                            </tr>
                            <tr>
                                <td class="mensaje">{{$mensaje->content}}</td>
                            </tr>
                        </table>
                        <hr>
                    </form>
                @auth
                    <div>
                        @if( Auth::user()->hasRole('admin'))
                            <form action="{{ route('eliminarMensajes') }}" method="POST"
                                  onsubmit="return confirmacion()">
                                <table>
                                    @csrf
                                    <tr>
                                        <td><input type="hidden" name="idMensaje" value="{{$mensaje->id_message}}"></td>
                                        <td><input type="hidden" name="idTema" value="{{$temaElegido[0]->id_topic}}">
                                        </td>
                                        <td><input type="submit" id="botonBorrarTema" value="Eliminar"></td>
                                    </tr>
                                </table>
                            </form>
                        @endif
                    </div>
                    @endauth
                @endforeach

            </div>
            <div>{{ $mensajes->appends(['idTema' => $temaElegido[0]->id_topic])->links() }}</div>
        </div>
        @auth
            <div class="custom-table">
                <div class="formu ">
                    <div class="formularioTemas">
                        <form action="{{route('crearMensajes')}}" method="post" autocomplete="off"
                              onsubmit="return validar()">
                            @csrf
                            <table class="table ">
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" name="contenido" id="mensaje">
                                        <input type="hidden" name="idTema" value="{{$temaElegido[0]->id_topic}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="submit" value="Responder"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </div>
    <div style="width: 400px; height: 400px">
    </div>
@endsection
</body>
</html>
