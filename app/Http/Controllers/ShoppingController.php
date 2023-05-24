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
    public function conseguirbillete($idFlight,$id)
    {
        return Ticket::query()->select('tickets.id_flight','user_company.name as company', 'origin.name as origin','destination.name as destination', 'flight_hours', 'price', 'num_suitcases', 'departing')
            ->leftJoin('flights', 'tickets.id_flight', '=', 'flights.id_flight')
            ->leftJoin("cities as origin", "flights.id_origin_city", "=", 'origin.id_city')
            ->leftJoin("cities as destination", "flights.id_destination_city", "=", 'destination.id_city')
            ->leftJoin("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->distinct()
            ->where(['tickets.id_flight'=>$idFlight,'id_passenger'=>$id,'active'=>0])
            ->get();
    }
    /**
     * Agregar billete
     *
     */
    public function insertarBilleteIda()
    {
        $fechaVuelta = request('fechaVuelta');
        $idFlight= request('idFlight');
        $numBilletes =request('numBilletes');
        $id = Auth::id();
        $num=substr($numBilletes,0,2);
        $num=(int) $num;
        for ($i=0;$i<$num;$i++) {
            DB::insert('INSERT INTO tickets (id_flight,id_passenger,num_suitcases,price) values(' . request('idFlight') . ',' . $id . ',2,' . request('precioIda') . ') ');
        }
        $contador = 1;
        $billete = $this->conseguirbillete($idFlight,$id);
        return view('vuelosIda', compact('contador', 'numBilletes', 'fechaVuelta'), compact('billete'));

    }

    /**
     * Devuelve la lista de billetes para comprar
     *
     */
    public function insertarBilleteVuelta()
    {
        $idFlight= request('idFlight');
        $numBilletes =request('numBilletes');
        $idVueloIda=request('idVueloIda');
        $id = Auth::id();
        $num=substr($numBilletes,0,2);
        $num=(int) $num;
        for ($i=0;$i<$num;$i++) {
            DB::insert('INSERT INTO tickets (id_flight,id_passenger,num_suitcases,price) values(' . request('idFlight') . ',' . $id . ',2,' . request('precioIda') . ') ');
        }
        $contador = 1;
        $billete = $this->conseguirbillete($idFlight,$id);
        return view('vuelosVuelta', compact('contador', 'numBilletes','idVueloIda'), compact('billete'));

    }

    public function insertarDatosBillete(){
        $idVueloIda=request('idVueloIda');
        $idVueloVuelta= request('idVueloVuelta');
        $numBilletes=request('numBilletes');
        return view('rellenoBilleteDatos',compact('numBilletes','idVueloIda','idVueloVuelta'));

    }

}
