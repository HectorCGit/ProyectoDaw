@extends('layouts.app')
@vite(['resources/css/admin.css'])

@section('template_title')
    {{ __('Crear') }} User Passenger
@endsection

@section('content')
    <section class="content container-fluid p-4">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} User Passenger</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-passengers.store') }}"  role="form" enctype="multipart/form-data">
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
