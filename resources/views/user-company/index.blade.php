@extends('layouts.app')

@section('template_title')
    User Company
@endsection

@section('content')
    <div class="container-fluid m-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('User Company') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('user-companies.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Nº</th>
										<th>Id Company</th>
										<th>Id Users</th>
										<th>Nombre</th>
										<th>Telefono</th>
                                        <th colspan="3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userCompanies as $userCompany)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $userCompany->id_company }}</td>
											<td>{{ $userCompany->id_users }}</td>
											<td>{{ $userCompany->name }}</td>
											<td>{{ $userCompany->telephone }}</td>
                                            <td><a class="btn btn-sm btn-primary " href="{{ route('user-companies.show',$userCompany->id_company) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a></td>
                                            <td><a class="btn btn-sm btn-success" href="{{ route('user-companies.edit',$userCompany->id_company) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a></td>
                                            <td>
                                                <form action="{{ route('user-companies.destroy',$userCompany->id_users) }}" method="POST">
                                                @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $userCompanies->links() !!}
            </div>
        </div>
    </div>
    <div style="width: 400px; height: 300px"></div>

@endsection
