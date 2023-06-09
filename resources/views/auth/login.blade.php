<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aeroweb</title>
    @vite(['resources/css/auth.css'])
    <script defer>
        function mostrarClave() {
            let clave = document.getElementById("password");
            if (clave.type === "password") {
                clave.type = "text";
            } else {
                clave.type = "password";
            }
        }
    </script>
</head>
<body>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">{{ __('Iniciar sesión') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Dirección email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Estas credenciales no concuerdan con nuestros registros</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Contraseña incorrecta</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" name="mostrarPassword" id="password"
                                                   type="checkbox" onclick="mostrarClave()">
                                            <label class="form-check-label" for="mostrarPassword">
                                                {{ __('Mostrar Contraseña') }}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Recuérdame') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn">
                                            {{ __('Iniciar sesión') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 400px; height: 400px">
        </div>
    </div>
@endsection
</body>
</html>

