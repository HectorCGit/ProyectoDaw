@extends('layouts.app')
@vite(['resources/css/admin.css'])

@section('template_title')
    {{ $userCompany->name ?? "{{ __('Show') User Company" }}
@endsection

@section('content')
    <section class="content container-fluid p-4">
        <div class="row m-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} User Company</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('user-companies.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Id Company:</strong>
                            {{ $userCompany->id_company }}
                        </div>
                        <div class="form-group">
                            <strong>Id Users:</strong>
                            {{ $userCompany->id_users }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $userCompany->name }}
                        </div>
                        <div class="form-group">
                            <strong>Telephone:</strong>
                            {{ $userCompany->telephone }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="width: 400px; height: 300px"></div>

@endsection
