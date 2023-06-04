<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class="container m-3">
        @if($tipo==='crear')
            <div class="alert alert-success m-3">
            <h1>CREADO CON EXITO</h1>
            </div>
        @else
            <div class="alert alert-success m-3">
            <h1>ELIMINADO CON EXITO</h1>
            </div>
        @endif
        <div style="width: 400px; height: 400px">
        </div>
    </div>
@endsection
</body>
</html>
