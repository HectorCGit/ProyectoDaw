@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} User Passenger
@endsection

@section('content')
    <section class="content container-fluid">
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
@endsection
