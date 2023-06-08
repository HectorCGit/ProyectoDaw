<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\FlightsPrice;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserCompanyController
 * @package App\Http\Controllers
 */
class UserCompanyController extends Controller
{
    /**
     *
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $userCompanies = UserCompany::paginate();

        return view('user-company.index', compact('userCompanies'))
            ->with('i', (request()->input('page', 1) - 1) * $userCompanies->perPage());
    }

    /**
     * Crear
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create()
    {
        $userCompany = new UserCompany();
        return view('user-company.create', compact('userCompany'));
    }

    /**
     * Guardar
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate(UserCompany::$rules);
        $user = User::create([
            'name' => request('name') . " " . request('surname'),
            'email' => request('email'),
            'password' => Hash::make($request['password']),
        ]);
        $user->save();
        $user->assignRole('company');
        $userPassenger = UserCompany::create([
            'id_users' => $user->id,
            'name' => request('name'),
            'telephone' => request('telephone'),
        ]);


        return redirect()->route('user-companies.index')
            ->with('success', 'UserCompany creado con éxito');
    }

    /**
     * Mostrar
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function show($id)
    {
        $userCompany = UserCompany::find($id);

        return view('user-company.show', compact('userCompany'));
    }

    /**
     * Editar
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit($id)
    {
        $userCompany = UserCompany::find($id);

        return view('user-company.edit', compact('userCompany'));
    }

    /**
     * Actualizar
     *
     * @param \Illuminate\Http\Request $request
     * @param UserCompany $userCompany
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UserCompany $userCompany)
    {
        request()->validate(UserCompany::$rules);

        $userCompany->update($request->all());
        User::query()->where('id', '=', $userCompany->id_users)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('user-companies.index')
            ->with('success', 'UserCompany actualizado con éxito');
    }

    /**
     * Borrar
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($idUsers)
    {
        Message::query()->where('id_users', '=', $idUsers)->delete();
        $queryIdCompany = UserCompany::query()->select('id_company')->where('id_users', '=', $idUsers)->get();
        $idCompany = $queryIdCompany[0]['id_company'];
        $vuelos = Flight::query()->where('id_company', '=', $idCompany)->get();

        foreach ($vuelos as $vuelo) {
            Ticket::query()->where('id_flight', '=', $vuelo->id_flight)->delete();
        }
        Flight::query()->where('id_company', '=', $idCompany)->delete();
        foreach ($vuelos as $vuelo) {
            FlightsPrice::query()->where('id_price', '=', $vuelo->id_price)->delete();
        }
        UserCompany::query()->where('id_users', '=', $idUsers)->delete();
        User::find($idUsers)->delete();

        return redirect()->route('user-companies.index')
            ->with('success', 'UserCompany borrado con éxito');
    }
}
