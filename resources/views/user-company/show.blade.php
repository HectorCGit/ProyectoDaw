@extends('layouts.app')

@section('template_title')
    {{ $userCompany->name ?? "{{ __('Show') User Company" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} User Company</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('user-companies.index') }}"> {{ __('Back') }}</a>
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
@endsection
