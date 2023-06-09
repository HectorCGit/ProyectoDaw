@vite(['resources/css/auth.css'])

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-3">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Verifique su correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un link de verificación se ha enviado a su dirección de correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, por favor revise su correo electrónico.') }}
                    {{ __('Si no lo recibe.') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn bg-white btn-link p-0 m-0 align-baseline">{{ __('Pinche aquí para recibir otro') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div style="width: 400px; height: 400px">
    </div>
</div>
@endsection
