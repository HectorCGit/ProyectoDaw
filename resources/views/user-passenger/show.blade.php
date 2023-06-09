@extends('layouts.app')
@vite(['resources/css/admin.css'])

@section('template_title')
    {{ $userPassenger->name ?? "{{ __('Mostrar') User Passenger" }}
@endsection

@section('content')
    <section class="content container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} User Passenger</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('user-passengers.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Id Passenger:</strong>
                            {{ $userPassenger->id_passenger }}
                        </div>
                        <div class="form-group">
                            <strong>Id Users:</strong>
                            {{ $userPassenger->id_users }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $userPassenger->name }}
                        </div>
                        <div class="form-group">
                            <strong>Surname:</strong>
                            {{ $userPassenger->surname }}
                        </div>
                        <div class="form-group">
                            <strong>Telephone:</strong>
                            {{ $userPassenger->telephone }}
                        </div>
                        <div class="form-group">
                            <strong>Dni:</strong>
                            {{ $userPassenger->dni }}
                        </div>
                        <div class="form-group">
                            <strong>Points:</strong>
                            {{ $userPassenger->points }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="width: 400px; height: 300px"></div>

@endsection
