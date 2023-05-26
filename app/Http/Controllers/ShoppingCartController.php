<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Doctrine\DBAL\Types\IntegerType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\String_;
use Ramsey\Uuid\Type\Integer;

class ShoppingCartController extends Controller
{
    public function mostrarCarrito()
    {
        $id = Auth::id();
        $billetes = Ticket::query()
            ->select('id_ticket','tickets.id_flight', 'user_company.name as company', 'origin.name as origin', 'destination.name as destination', 'flight_hours', 'price', 'num_suitcases', 'departing', 'ticket_name_passenger', 'ticket_surname_passenger', 'num_suitcases', 'check_in')
            ->leftJoin('flights', 'tickets.id_flight', '=', 'flights.id_flight')
            ->leftJoin("cities as origin", "flights.id_origin_city", "=", 'origin.id_city')
            ->leftJoin("cities as destination", "flights.id_destination_city", "=", 'destination.id_city')
            ->leftJoin("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->where(['id_passenger' => $id, 'active' => 1])
            ->get();

        return view('carrito', compact('billetes'));
    }

    public function cancelarBillete()
    {
        $idTicket = request('idTicket');
        Ticket::query()->find($idTicket)->delete();
                     return back();
    }
}
