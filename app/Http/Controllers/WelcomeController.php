<?php


namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Flight;

class WelcomeController extends Controller
{
    public function mostrarUbicaciones()
    {
        $cities = City::query()->select('cities.name as city', 'countries.name as country')
            ->join('countries', 'cities.id_country', '=', 'countries.id_country')
            ->get();

        $randomFlights = Flight::query()->
        select('id_flight', 'user_company.name as company', 'num_passengers', 'num_seats', 'num_check_in', 'departing', 'origin.name as origin', 'destination.name as destination')
            ->leftJoin("cities as origin", "id_origin_city", "=", 'origin.id_city')
            ->leftJoin("cities as destination", "id_destination_city", "=", 'destination.id_city')
            ->leftJoin("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->inRandomOrder()->limit(4)->get();
        return view('welcome', compact('cities'), compact('randomFlights'));
    }

    public function getVuelos()
    {
        $billetes = request('billetes');
        $flights = Flight::query()->select('id_flight', 'user_company.name as company', 'num_passengers', 'num_seats', 'num_check_in', 'departing', 'origin.name as origin', 'destination.name as destination')
            ->join("cities as origin", "id_origin_city", "=", 'origin.id_city')
            ->join("cities as destination", "id_destination_city", "=", 'destination.id_city')
            ->join("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->where(['origin.name' => request('origen'), 'destination.name' => request('destino')])
            ->whereDate('departing', '=', request('ida'))
            ->get();
        return view('vuelos', compact('flights'), compact('billetes'));
    }


}
