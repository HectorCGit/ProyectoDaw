<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aeroweb</title>
    @vite(['resources/css/foro.css'])
    <script type="text/javascript" defer>
        function crearTema() {
            let formularioTemas = document.getElementById('formularioTemas');
            let input = document.createElement('input');
            let submit = document.createElement('input');
            let table =document.createElement('table');
            let tr1=document.createElement('tr');
            let td1=document.createElement('td');
            let tr2=document.createElement('tr');
            let td2=document.createElement('td');
            formularioTemas.innerHTML = "";
            table.setAttribute('class','table');
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'tema');
            input.setAttribute('minlength','1');
            input.setAttribute('class','form-control');
            submit.setAttribute('type', 'submit');
            submit.setAttribute('value','Añadir');
            td1.appendChild(input);
            td2.appendChild(submit);
            tr1.appendChild(td1);
            tr2.appendChild(td2);
            table.appendChild(tr1);
            table.appendChild(tr2);
            formularioTemas.appendChild(table);
        }
    </script>
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="custom-table">
            <div class="formu">
                @auth
                    <a class="botonCrear" onclick="crearTema()">Crear nueva pregunta</a><br><br>
                    <form method="post" action="{{route('crearTemas')}}">
                        @csrf
                        {{--
                        PROBLEMA AL CREAR TEMAS LA PAGINACIOIN NO VA
                        EL TEMA NO PUEDE SER EN BLANCO
                        AL HACER OTRA VEZ CLICK DEBE DESPLEGARSE
                        --}}
                        <div id="formularioTemas"></div>
                    </form>
                @endauth
            </div>
            <div class="divTable">
                <table class="table">
                    @foreach($temas as $tema)
                        <tr>
                            <td>{{$tema->content}}</td>
                            <td>
                                <form action="{{route('mostrarMensajes')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="idTema" value="{{$tema->id_topic}}">
                                    <button type="submit" class="botonVer">Ver Tema</button>
                                </form>
                            </td>
                            @auth
                                @if( Auth::user()->hasRole('admin'))
                                    <td>
                                        <form action="{{ route('eliminarTemas')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idTema" value="{{$tema->id_topic}}">
                                            <button type="submit" class="botonBorrar">Eliminar</button>
                                        </form>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="pagination">
        {{$temas->links()}}
    </div>
    <div style="width: 400px; height: 200px">
    </div>
@endsection
</body>
</html>
