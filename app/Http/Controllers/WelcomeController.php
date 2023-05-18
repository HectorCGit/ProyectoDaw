<?php


namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Flight;

class WelcomeController extends Controller
{
    public function mostrarUbicaciones(){
        $cities=City::query()->select('cities.name as city','countries.name as country')
            ->join('countries','cities.id_country','=','countries.id_country')
            ->get();
        return view('welcome', compact('cities'));
    }

    public function getVuelos(){
            $flights= Flight::query()->select('id_flight','user_company.id_company','num_passenger','num_seat','check_in','dateAndTime','origin.name','destination.name')
                ->join("cities as origin","id_origin_city","=",'origin.id_city')
                ->join("cities as destination","id_destination_city","=",'destination.id_city')
                ->join("user_company",'user_company.id_company','=','flights.id_company')
                ->where(['origin.name'=>request('origen'),'destination.name'=>request('destino')])
                ->get();
            return view('vuelos',compact('flights'));
    }
}
