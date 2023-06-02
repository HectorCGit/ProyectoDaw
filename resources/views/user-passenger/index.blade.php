@extends('layouts.app')

@section('template_title')
    User Passenger
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('User Passenger') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('user-passengers.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear') }}
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
                                        <th>No</th>

										<th>Id Pasajero</th>
										<th>Id User</th>
										<th>Nombre</th>
										<th>Apellido</th>
										<th>Telefono</th>
										<th>Dni</th>
										<th>Puntos</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userPassengers as $userPassenger)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $userPassenger->id_passenger }}</td>
											<td>{{ $userPassenger->id_users }}</td>
											<td>{{ $userPassenger->name }}</td>
											<td>{{ $userPassenger->surname }}</td>
											<td>{{ $userPassenger->telephone }}</td>
											<td>{{ $userPassenger->dni }}</td>
											<td>{{ $userPassenger->points }}</td>

                                            <td>
                                                <form action="{{ route('user-passengers.destroy',$userPassenger->id_users) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('user-passengers.show',$userPassenger->id_passenger) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('user-passengers.edit',$userPassenger->id_passenger) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $userPassengers->links() !!}
            </div>
        </div>
    </div>
@endsection
