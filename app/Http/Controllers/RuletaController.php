<?php

namespace App\Http\Controllers;


use App\Models\Discount;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\UserPassenger;
use Illuminate\Support\Facades\Auth;

class RuletaController extends Controller
{
    public function mostrarRuleta()
    {
        $idUsuario = Auth::id();
        $puntos = UserPassenger::query()->select('id_users', 'points')->where('id_users', '=', $idUsuario)->get();
        return view('ruleta', compact('puntos'));
    }

    public function generarPremio()
    {
        $queryIdPassenger = UserPassenger::query()->select('id_passenger','name','surname')->where('id_users', '=', Auth::id())->get();
        $idPassenger = $queryIdPassenger[0]['id_passenger'];
        UserPassenger::query()->where('id_passenger', '=', $idPassenger)->update(['points' => request('puntos')]);
        switch (request('premio')) {
            case 'DESC 20%':
                Discount::query()->insert(['percentage' => 0.80, 'id_passenger' => $idPassenger]);
                $premio="20%";
                break;
            case 'DESC 15%':
                $premio="15%";
                Discount::query()->insert(['percentage' => 0.85, 'id_passenger' => $idPassenger]);
                break;
            case 'SIN PREMIO':
                    $premio="nada";
                break;
            case 'BILLETE':
                $randomFlight = Flight::query()->
                select('id_flight', 'num_passengers', 'num_seats', 'num_check_in', 'departing', 'economic_price', 'business_price')
                    ->leftJoin("flights_price", 'flights_price.id_price', '=', 'flights.id_price')
                    ->whereRaw('num_seats - num_passengers > 0')
                    ->inRandomOrder()->limit(1)->get();
                Ticket::query()->insert(['id_flight' => $randomFlight[0]['id_flight'], 'id_passenger' => $idPassenger,
                    'num_suitcases' => 2, 'ticket_name_passenger' => $queryIdPassenger[0]['name'], 'ticket_surname_passenger' => $queryIdPassenger[0]['surname'],
                    'price' => $randomFlight[0]['business_price'], 'active' => 1]);
                $premio="billete";
                break;
            case 'PUNTOS':
                $queryPuntosActuales=UserPassenger::query()->select('points')->where('id_passenger','=',$idPassenger)->get();
                $puntosActuales = $queryPuntosActuales[0]['points'];
                UserPassenger::query()->where('id_passenger','=',$idPassenger)->update(['points'=>$puntosActuales+500]);
                $premio="puntos";
                break;
        }

        return view('premio',compact('premio'));
    }
}
