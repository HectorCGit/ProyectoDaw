<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aeroweb</title>
    @vite(['resources/css/formularioIda.css'])
    <script type="text/javascript" defer>
        function crearTema() {
            let formularioTemas = document.getElementById('formularioTemas');
            let input = document.createElement('input');
            let submit = document.createElement('input');
            formularioTemas.innerHTML = "";
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'tema');
            submit.setAttribute('type', 'submit');
            formularioTemas.appendChild(input);
            formularioTemas.appendChild(submit);

        }

    </script>
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class='container'>

        <div class="formu">
            <div class="formu ">
                @auth
                <a style="text-decoration: none" class="bg-warning hover:bg-blue text-black font-bold py-2 px-4 rounded"
                   onclick='crearTema()'>Crear nueva pregunta</a>
                <form method="post" action="{{route('crearTemas')}}">
                    @csrf
                    <div id="formularioTemas"></div>
                </form>

                @endauth
            </div>
            @foreach($temas as $tema)
                <form action="{{route('mostrarMensajes')}}" method="post">
                    @csrf
                    <table>
                        <tr>
                            <td>
                                {{$tema->content}}
                            </td>
                            <td>
                                <input type="hidden" name="idTema" value="{{$tema->id_topic}}">
                                <input type="submit" value="Ver Tema">
                            </td>
                        </tr>
                    </table>
                </form>
            @endforeach
        </div>
    </div>
    <div>{{$temas->links()}}</div>
@endsection
</body>
</html>
