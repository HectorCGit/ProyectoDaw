<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeroweb</title>
    @vite(['resources/css/formularioIda.css'])
    <script type="text/javascript" defer>
        function crear(){

        }
    </script>
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class='container'>
        <table>
            <tr><td>{{$temaElegido[0]->content}}</td></tr>
        </table>
        <div class="formu">
            @foreach($mensajes as $mensaje)
                <form action="{{route('crearMensajes')}}" method="post">
                    <table>
                        <tr>
                            <td>{{$mensaje->name}}</td>
                        </tr>
                        <tr>
                            <td>
                                {{$mensaje->content}}
                            </td>
                        </tr>
                    </table>
                </form>
            @endforeach
            @auth
                <form action="{{route('crearMensajes')}}" method="post" autocomplete="off">
                    @csrf
                    <input type="hidden" name="idTema" value="{{$temaElegido[0]->id_topic}}">
                    <table>
                        <tr>
                            <td><input type="text" name="contenido"></td>
                            <td><input type="submit" value="responder"></td>
                        </tr>
                    </table>
                </form>
                @endauth
        </div>

    </div>
    <div>{{$mensajes->links()}}</div>
@endsection
</body>
</html>
