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
    @if($tipo==='crear')
        <h1>CREADO CON EXITO</h1>
    @else
        <h1>ELIMINADO CON EXITO</h1>
    @endif
@endsection
</body>
</html>
