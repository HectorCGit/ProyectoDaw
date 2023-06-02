@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} User Company
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} User Company</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-companies.update', $userCompany->id_company) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('user-company.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
