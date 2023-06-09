<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\UserPassenger;
use Doctrine\DBAL\Types\IntegerType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\String_;
use Ramsey\Uuid\Type\Integer;

class ShoppingCartController extends Controller
{
    public function mostrarBilletesPassenger()
    {
        $queryIdPassenger = UserPassenger::query()->select('id_passenger')->where('id_users', '=', Auth::id())->get();
        $idPassenger = $queryIdPassenger[0]['id_passenger'];
        $billetes = Ticket::query()
            ->select('id_ticket','tickets.id_flight', 'user_company.name as company', 'origin.name as origin', 'origin.airport as originAirport','destination.name as destination','destination.airport as destinationAirport','countryOrigin.name as countryOrigin','countryDestination.name as countryDestination', 'flight_hours', 'num_suitcases', 'departing', 'ticket_name_passenger', 'ticket_surname_passenger')
            ->leftJoin('flights', 'tickets.id_flight', '=', 'flights.id_flight')
            ->leftJoin("cities as origin", "flights.id_origin_city", "=", 'origin.id_city')
            ->leftJoin("cities as destination", "flights.id_destination_city", "=", 'destination.id_city')
            ->leftJoin('countries as countryOrigin', 'origin.id_country', '=', 'countryOrigin.id_country')
            ->leftJoin('countries as countryDestination', 'destination.id_country', '=', 'countryDestination.id_country')
            ->leftJoin("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->where(['id_passenger' => $idPassenger, 'active' => 1])
            ->paginate(4);
        return view('carrito', compact('billetes'));
    }

    public function cancelarBillete()
    {
        $idTicket = request('idTicket');
        Ticket::query()->find($idTicket)->delete();
        return back();
    }

    public function mostrarDescuentos(){
        $queryIdPassenger = UserPassenger::query()->select('id_passenger')->where('id_users', '=', Auth::id())->get();
        $idPassenger = $queryIdPassenger[0]['id_passenger'];
        $descuentos=Discount::query()->select('id_discount','percentage')->where('id_passenger','=',$idPassenger)->get();
        return view('descuentos',compact('descuentos'));
    }
}
