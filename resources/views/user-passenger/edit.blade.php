@extends('layouts.app')

@section('template_title')
    {{ __('Actualizar') }} User Passenger
@endsection
@vite(['resources/css/admin.css'])

@section('content')
    <section class="content container-fluid p-4">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} User Passenger</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-passengers.update', $userPassenger->id_passenger) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('user-passenger.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="width: 400px; height: 300px"></div>

@endsection
