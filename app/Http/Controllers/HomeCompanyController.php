<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Flight;
use App\Models\FlightsPrice;
use App\Models\Ticket;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCompanyController extends Controller
{
    /**
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function mostrarHomeCompany()
    {
        $queryIdCompany = UserCompany::query()->select('id_company')->where('id_users', '=', Auth::id())->get();
        $idCompany = $queryIdCompany[0]['id_company'];
        $companyFlights = Flight::query()->select('id_flight', 'user_company.name as company', 'num_passengers', 'num_seats', 'num_check_in', 'departing', 'origin.name as origin','origin.airport as originAirport', 'destination.name as destination','destination.airport as destinationAirport','countryOrigin.name as countryOrigin','countryDestination.name as countryDestination', 'economic_price', 'business_price')
            ->join("cities as origin", "id_origin_city", "=", 'origin.id_city')
            ->join("cities as destination", "id_destination_city", "=", 'destination.id_city')
            ->join('countries as countryOrigin', 'origin.id_country', '=', 'countryOrigin.id_country')
            ->join('countries as countryDestination', 'destination.id_country', '=', 'countryDestination.id_country')
            ->join("user_company", 'user_company.id_company', '=', 'flights.id_company')
            ->join("flights_price", 'flights_price.id_price', '=', 'flights.id_price')
            ->where('flights.id_company', '=', $idCompany)->orderBy('departing')->paginate(10);

        return view('homeCompany', compact('companyFlights'));
    }


    public function crearVuelo()
    {
        $cities = City::query()->select('cities.name as city', 'countries.name as country')
            ->join('countries', 'cities.id_country', '=', 'countries.id_country')
            ->get();
        return view('formularioCrud', compact('cities'));
    }

    public function guardarVuelo()
    {
        $queryIdOriginCity = City::query()->select('id_city')->where('name', '=', request('origen'))->get();
        $idOriginCity = $queryIdOriginCity[0]['id_city'];
        $queryIdDestinationCity = City::query()->select('id_city')->where('name', '=', request('destino'))->get();
        $idDestinationCity = $queryIdDestinationCity[0]['id_city'];
        FlightsPrice::query()->insert(['economic_price' => request('economico'), 'business_price' => request('business')]);
        $queryIdPrice = FlightsPrice::query()->select('id_price')->where(['economic_price' => request('economico'), 'business_price' => request('business')])->get();
        $idPrice = $queryIdPrice[0]['id_price'];
        $queryIdCompany = UserCompany::query()->select('id_company')->where('id_users', '=', Auth::id())->get();
        $idCompany = $queryIdCompany[0]['id_company'];
        $flight = Flight::create([
            'id_company' => $idCompany,
            'num_passengers' => 0,
            'num_seats' => request('asientos'),
            'num_check_in' => 0,
            'departing' => request('fecha'),
            'id_origin_city' => $idOriginCity,
            'id_destination_city' => $idDestinationCity,
            'flight_hours' => (request('horas') . "h " . request('minutos') . "min"),
            'id_price' => $idPrice,
        ]);

        $flight->save();
        $tipo = 'crear';
        return view('creado', compact('tipo'));
    }

    public function eliminarVuelo()
    {
        $idFlight = request('idFlight');
        Flight::query()->find($idFlight)->delete();
        $tipo = 'eliminar';
        return view('creado', compact('tipo'));
    }

    public function verBilletes()
    {
        $tickets = Ticket::query()
            ->select('id_ticket', 'tickets.id_flight', 'id_discount', 'check_in', 'num_suitcases', 'departing','ticket_name_passenger', 'ticket_surname_passenger', 'price','num_check_in','origin.name as origin', 'origin.airport as originAirport','destination.name as destination','destination.airport as destinationAirport','countryOrigin.name as countryOrigin','countryDestination.name as countryDestination','flight_hours')
            ->leftJoin('flights','flights.id_flight','=','tickets.id_flight')
            ->leftJoin("cities as origin", "id_origin_city", "=", 'origin.id_city')
            ->leftJoin("cities as destination", "id_destination_city", "=", 'destination.id_city')
            ->leftJoin('countries as countryOrigin', 'origin.id_country', '=', 'countryOrigin.id_country')
            ->leftJoin('countries as countryDestination', 'destination.id_country', '=', 'countryDestination.id_country')
            ->where(['tickets.id_flight' => request('idFlight'),'active'=>1])
            ->get();
        return view('billetesVuelos', compact('tickets'));
    }

    public function eliminarBillete(){
        $idBillete = request('idBillete');
        Ticket::query()->find($idBillete)->delete();
        $tipo = 'eliminar';
        return view('creado', compact('tipo'));
    }
}
