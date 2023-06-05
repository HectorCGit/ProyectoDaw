<?php


namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Discount;
use App\Models\Flight;
use Illuminate\Support\Facades\Auth;

class HomePassengerController extends Controller
{
    /**
     * Devuelve la lista de origenes y destinos y los vuelos aleatorios que se muestran en la página principal
     *
     */
    public function listarVuelosAleatorios()
    {

        $cities = City::query()->select('cities.name as city', 'countries.name as country')
            ->join('countries', 'cities.id_country', '=', 'countries.id_country')
            ->get();

        $randomFlights = Flight::query()->
        select('id_flight', 'user_company.name as company', 'num_passengers', 'num_seats', 'num_check_in', 'departing', 'origin.name as origin', 'destination.name as destination','destination.photo as photo', 'economic_price', 'business_price')
            ->leftJoin("cities as origin", "id_origin_city", "=", 'origin.id_city')
            ->leftJoin("cities as destination", "id_destination_city", "=", 'destination.id_city')
            ->leftJoin("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->leftJoin("flights_price", 'flights_price.id_price', '=', 'flights.id_price')
            ->whereRaw('num_seats - num_passengers > 0')
            ->inRandomOrder()->limit(4)->get();

        return view('homePassenger', compact('cities'), compact('randomFlights'));
    }

    /**
     * Devuelve los resultados de la busqueda de vuelos, tanto ida como vuelta
     *
     */
    public function getVuelosIda()
    {
        $fechaVuelta = request('vuelta');
        $numBilletes = request('numBilletes');
        $contador = 0;
        $ida = Flight::query()->select('id_flight', 'user_company.name as company', 'num_passengers', 'num_seats', 'num_check_in', 'departing', 'origin.name as origin', 'destination.name as destination', 'economic_price', 'business_price')
            ->join("cities as origin", "id_origin_city", "=", 'origin.id_city')
            ->join("cities as destination", "id_destination_city", "=", 'destination.id_city')
            ->join("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->join("flights_price", 'flights_price.id_price', '=', 'flights.id_price')
            ->where(['origin.name' => request('origen'), 'destination.name' => request('destino')])
            ->whereDate('departing', '=', request('ida'))
            ->get();
        return view('vuelosIda', compact('ida'), compact('fechaVuelta', 'numBilletes', 'contador'));
    }

    public function getVuelosVuelta()
    {
        $numBilletes = request('numBilletes');
        $fechaVuelta = request('fechaVuelta');
        $origen = request('origen');
        $destino = request('destino');
        $idVueloIda = request('idVueloIda');
        $contador = 0;
        if (request('fechaVuelta') != null) {
            $vuelta = Flight::query()->select('id_flight', 'user_company.name as company', 'num_passengers', 'num_seats', 'num_check_in', 'departing', 'origin.name as origin', 'destination.name as destination', 'economic_price', 'business_price')
                ->join("cities as origin", "id_origin_city", "=", 'origin.id_city')
                ->join("cities as destination", "id_destination_city", "=", 'destination.id_city')
                ->join("user_company", 'user_company.id_company', '=', 'flights.id_company')
                ->join("flights_price", 'flights_price.id_price', '=', 'flights.id_price')
                ->where(['destination.name' => $destino, 'origin.name' => $origen])
                ->whereDate('departing', '=', $fechaVuelta)
                ->get();
            return view('vuelosVuelta', compact('vuelta'), compact('numBilletes', 'contador', 'idVueloIda'));
        } else {
            $contador = 1;
            return view('rellenoBilleteDatos', compact('numBilletes', 'idVueloIda', 'contador'));
        }
    }


}
