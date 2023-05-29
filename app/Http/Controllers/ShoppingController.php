<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use App\Models\UserPassenger;
use Doctrine\DBAL\Types\IntegerType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\String_;
use Ramsey\Uuid\Type\Integer;

class ShoppingController extends Controller
{
    public function conseguirBillete($idFlight, $idPassenger)
    {
        return Ticket::query()
            ->select('tickets.id_flight', 'user_company.name as company', 'origin.name as origin', 'destination.name as destination', 'flight_hours', 'price', 'num_suitcases', 'departing')
            ->leftJoin('flights', 'tickets.id_flight', '=', 'flights.id_flight')
            ->leftJoin("cities as origin", "flights.id_origin_city", "=", 'origin.id_city')
            ->leftJoin("cities as destination", "flights.id_destination_city", "=", 'destination.id_city')
            ->leftJoin("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->distinct()
            ->where(['tickets.id_flight' => $idFlight, 'id_passenger' => $idPassenger, 'active' => 0])
            ->get();
    }

    /**
     * Agregar billete
     *
     */
    public function insertarBilleteIda()
    {
        $fechaVuelta = request('fechaVuelta');
        $idFlight = request('idFlight');
        $numBilletes = request('numBilletes');
        $queryIdPassenger = UserPassenger::query()->select('id_passenger')->where('id_users', '=', Auth::id())->get();
        $idPassenger = $queryIdPassenger[0]['id_passenger'];

        for ($i = 0; $i < $numBilletes; $i++) {
            DB::insert('INSERT INTO tickets (id_flight,id_passenger,num_suitcases,price) values(' . request('idFlight') . ',' . $idPassenger . ',2,' . request('precioIda') . ') ');
        }
        $contador = 1;
        $billete = $this->conseguirBillete($idFlight, $idPassenger);
        return view('vuelosIda', compact('contador', 'numBilletes', 'fechaVuelta'), compact('billete'));

    }

    /**
     * Devuelve la lista de billetes para comprar
     *
     */
    public function insertarBilleteVuelta()
    {
        $idFlight = request('idFlight');
        $numBilletes = request('numBilletes');
        $idVueloIda = request('idVueloIda');
        $queryIdPassenger = UserPassenger::query()->select('id_passenger')->where('id_users', '=', Auth::id())->get();
        $idPassenger = $queryIdPassenger[0]['id_passenger'];

        for ($i = 0; $i < $numBilletes; $i++) {
            DB::insert('INSERT INTO tickets (id_flight,id_passenger,num_suitcases,price) values(' . request('idFlight') . ',' . $idPassenger . ',2,' . request('precioIda') . ') ');
        }
        $contador = 1;
        $billete = $this->conseguirBillete($idFlight, $idPassenger);
        return view('vuelosVuelta', compact('contador', 'numBilletes', 'idVueloIda'), compact('billete'));

    }

    public function insertarDatosBillete()
    {
        $idVueloIda = request('idVueloIda');
        $idVueloVuelta = request('idVueloVuelta');
        $numBilletes = request('numBilletes');
        $contador = 0;
        return view('rellenoBilleteDatos', compact('numBilletes', 'idVueloIda', 'idVueloVuelta', 'contador'));

    }

    public function rellenarNombreBilletes()
    {
        $numBilletes = request('numBilletes');
        $nombres = request('nombre');
        $apellidos = request('apellidos');
        $idVueloVuelta = request('idVueloVuelta');
        $idVueloIda = request('idVueloIda');
        $queryIdPassenger = UserPassenger::query()->select('id_passenger')->where('id_users', '=', Auth::id())->get();
        $idPassenger = $queryIdPassenger[0]['id_passenger'];
        $pasajerosIda = Ticket::query()->select('id_ticket', 'id_flight', 'ticket_name_passenger', 'ticket_surname_passenger')
            ->where(['id_flight' => request('idVueloIda'), 'active' => 0, 'id_passenger' => $idPassenger])->get();

        for ($i = 0; $i < $numBilletes; $i++) {
            $pasajerosIda[$i]->update(['ticket_name_passenger' => $nombres[$i]]);
            $pasajerosIda[$i]->update(['ticket_surname_passenger' => $apellidos[$i]]);

        }
        if ($idVueloVuelta != null) {
            $pasajerosVuelta = Ticket::query()->select('id_ticket', 'id_flight', 'ticket_name_passenger', 'ticket_surname_passenger')
                ->where(['id_flight' => $idVueloVuelta, 'active' => 0, 'id_passenger' => $idPassenger])->get();

            for ($i = 0; $i < $numBilletes; $i++) {
                $pasajerosVuelta[$i]->update(['ticket_name_passenger' => $nombres[$i]]);
                $pasajerosVuelta[$i]->update(['ticket_surname_passenger' => $apellidos[$i]]);
            }
        }
        $ida = $this->conseguirBillete(request('idVueloIda'), $idPassenger);
        $vuelta = $this->conseguirBillete($idVueloVuelta, $idPassenger);
        return view('pago', compact('ida', 'vuelta', 'numBilletes', 'idVueloIda', 'idVueloVuelta'));

    }

    public function pagarFinal()
    {
        $idVueloIda = request('idVueloIda');
        $idVueloVuelta = request('idVueloVuelta');
        $queryIdPassenger = UserPassenger::query()->select('id_passenger')->where('id_users', '=', Auth::id())->get();
        $idPassenger = $queryIdPassenger[0]['id_passenger'];
        $queryIda = Ticket::query()->select('id_ticket')
            ->where(['id_flight' => $idVueloIda, 'active' => 0, 'id_passenger' => $idPassenger])
            ->get();
        $queryVuelta = Ticket::query()->select('id_ticket')
            ->where(['id_flight' => $idVueloVuelta ,'active' => 0, 'id_passenger' => $idPassenger])
            ->get();

        foreach ($queryIda as $q) {
            Ticket::query()->select('id_ticket', 'active')->where('id_ticket', '=', $q->id_ticket)->update(['active' => 1]);
            $numPassengersIda = Flight::query()->select('id_flight', 'num_passengers')->where('id_flight', '=', $idVueloIda)->get();
            $numPassengers = ($numPassengersIda[0]->num_passengers);
            Flight::query()->select('id_flight', 'num_passengers')->where('id_flight', '=', $idVueloIda)->update(['num_passengers' => $numPassengers + 1]);
        }
        foreach ($queryVuelta as $q) {
            Ticket::query()->select('id_ticket', 'active')->where('id_ticket', '=', $q->id_ticket)->update(['active' => 1]);
            $numPassengersIda = Flight::query()->select('id_flight', 'num_passengers')->where('id_flight', '=', $idVueloVuelta)->get();
            $numPassengers = ($numPassengersIda[0]->num_passengers);
            Flight::query()->select('id_flight', 'num_passengers')->where('id_flight', '=', $idVueloVuelta)->update(['num_passengers' => $numPassengers + 1]);
        }
        return view('pagoFinal');
    }


}
