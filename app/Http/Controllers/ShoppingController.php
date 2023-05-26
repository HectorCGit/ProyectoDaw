<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Doctrine\DBAL\Types\IntegerType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\String_;
use Ramsey\Uuid\Type\Integer;

class ShoppingController extends Controller
{
    public function conseguirBillete($idFlight, $id)
    {
        return Ticket::query()
            ->select('tickets.id_flight', 'user_company.name as company', 'origin.name as origin', 'destination.name as destination', 'flight_hours', 'price', 'num_suitcases', 'departing')
            ->leftJoin('flights', 'tickets.id_flight', '=', 'flights.id_flight')
            ->leftJoin("cities as origin", "flights.id_origin_city", "=", 'origin.id_city')
            ->leftJoin("cities as destination", "flights.id_destination_city", "=", 'destination.id_city')
            ->leftJoin("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->distinct()
            ->where(['tickets.id_flight' => $idFlight, 'id_passenger' => $id, 'active' => 0])
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
        $id = Auth::id();

        for ($i = 0; $i < $numBilletes; $i++) {
            DB::insert('INSERT INTO tickets (id_flight,id_passenger,num_suitcases,price) values(' . request('idFlight') . ',' . $id . ',2,' . request('precioIda') . ') ');
        }
        $contador = 1;
        $billete = $this->conseguirBillete($idFlight, $id);
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
        $id = Auth::id();

        for ($i = 0; $i < $numBilletes; $i++) {
            DB::insert('INSERT INTO tickets (id_flight,id_passenger,num_suitcases,price) values(' . request('idFlight') . ',' . $id . ',2,' . request('precioIda') . ') ');
        }
        $contador = 1;
        $billete = $this->conseguirBillete($idFlight, $id);
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
        $id = Auth::id();
        $pasajerosIda = Ticket::query()->select('id_ticket', 'id_flight', 'ticket_name_passenger', 'ticket_surname_passenger')
            ->where(['id_flight' => request('idVueloIda'), 'active' => 0, 'id_passenger' => $id])->get();

        for ($i = 0; $i < $numBilletes; $i++) {
            $pasajerosIda[$i]->update(['ticket_name_passenger' => $nombres[$i]]);
            $pasajerosIda[$i]->update(['ticket_surname_passenger' => $apellidos[$i]]);

        }
        if ($idVueloVuelta != null) {
            $pasajerosVuelta = Ticket::query()->select('id_ticket', 'id_flight', 'ticket_name_passenger', 'ticket_surname_passenger')
                ->where(['id_flight' => $idVueloVuelta, 'active' => 0, 'id_passenger' => $id])->get();

            for ($i = 0; $i < $numBilletes; $i++) {
                $pasajerosVuelta[$i]->update(['ticket_name_passenger' => $nombres[$i]]);
                $pasajerosVuelta[$i]->update(['ticket_surname_passenger' => $apellidos[$i]]);
            }
        }
        $ida = $this->conseguirBillete(request('idVueloIda'), $id);
        $vuelta = $this->conseguirBillete($idVueloVuelta, $id);
        return view('pago', compact('ida', 'vuelta', 'numBilletes', 'idVueloIda', 'idVueloVuelta'));

    }

    public function pagarFinal()
    {
        $idVueloIda = request('idVueloIda');
        $idVueloVuelta = request('idVueloVuelta');
        $id = Auth::id();
        $queryIda = Ticket::query()->select('id_ticket')
            ->where(['id_flight' => $idVueloIda, 'active' => 0, 'id_passenger' => $id])
            ->get();
        $queryVuelta = Ticket::query()->select('id_ticket')
            ->where(['id_flight' => $idVueloVuelta ,'active' => 0, 'id_passenger' => $id])
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
