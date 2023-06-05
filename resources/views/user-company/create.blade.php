@extends('layouts.app')
@vite(['resources/css/admin.css'])

@section('template_title')
    {{ __('Crear') }} User Company
@endsection

@section('content')
    <section class="content container-fluid ">
        <div class="row m-3">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} User Company</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-companies.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('user-company.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="width: 400px; height: 300px"></div>

@endsection
