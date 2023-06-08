<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserPassenger;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserPassengerController
 * @package App\Http\Controllers
 */
class UserPassengerController extends Controller
{
    /**
     *
     *
     * @return ApplicationAlias|Factory|View|Application
     */
    public function index()
    {
        $userPassengers = UserPassenger::paginate();

        return view('user-passenger.index', compact('userPassengers'))
            ->with('i', (request()->input('page', 1) - 1) * $userPassengers->perPage());
    }

    /**
     * Crear
     *
     * @return Application|ApplicationAlias|Factory|View
     */
    public function create(): ApplicationAlias|Factory|View|Application
    {
        $userPassenger = new UserPassenger();
        return view('user-passenger.create', compact('userPassenger'));
    }

    /**
     * Guardar
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate(UserPassenger::$rules);
        $user=User::create([
            'name' => request('name') . " " . request('surname'),
            'email' => request('email'),
            'password' =>Hash::make($request['password']),
        ]);
        $user->save();
        $user->assignRole('passenger');
        $userPassenger =  UserPassenger::create([
            'id_users' => $user->id,
            'name' => request('name'),
            'surname' => request('surname'),
            'telephone' => request('telephone'),
            'dni' => request('dni'),
            'points' => request('points'),
        ]);

        return redirect()->route('user-passengers.index')
            ->with('success', 'UserPassenger creado correctamente');
    }

    /**
     * Mostrar
     *
     * @param  int $id
     * @return Application|ApplicationAlias|Factory|View
     */
    public function show($id)
    {
        $userPassenger = UserPassenger::find($id);

        return view('user-passenger.show', compact('userPassenger'));
    }

    /**
     *Editar
     *
     * @param  int $id
     * @return Application|ApplicationAlias|Factory|View
     */
    public function edit($id)
    {
        $userPassenger = UserPassenger::find($id);

        return view('user-passenger.edit', compact('userPassenger'));
    }

    /**
     * Actualizar
     *
     * @param  \Illuminate\Http\Request $request
     * @param  UserPassenger $userPassenger
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UserPassenger $userPassenger)
    {
        request()->validate(UserPassenger::$rules);

        $userPassenger->update($request->all());
        User::query()->where('id','=',$userPassenger->id_users)->update([
            'name' =>$request['name'],
            'email' =>$request['email'],
            'password' =>Hash::make($request['password']),

        ]);

        return redirect()->route('user-passengers.index')
            ->with('success', 'UserPassenger actualizado correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($idUsers): \Illuminate\Http\RedirectResponse
    {
        Message::query()->where('id_users','=',$idUsers)->delete();
        $queryIdPassenger=UserPassenger::query()->select('id_passenger')->where('id_users','=',$idUsers)->get();
        $idPassenger=$queryIdPassenger[0]['id_passenger'];
        Discount::query()->where('id_passenger','=',$idPassenger)->delete();
        Ticket::query()->where('id_passenger','=',$idPassenger)->delete();
        UserPassenger::query()->where('id_users','=',$idUsers)->delete();
        User::find($idUsers)->delete();


        return redirect()->route('user-passengers.index')
            ->with('success', 'UserPassenger borrado correctamente');
    }
}
