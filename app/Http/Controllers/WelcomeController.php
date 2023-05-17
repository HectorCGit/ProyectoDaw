<?php


namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;

class WelcomeController extends Controller
{
    public function mostrarUbicaciones(){
        $cities=City::query()->select('cities.name as city','countries.name as country')
            ->join('countries','cities.id_country','=','countries.id_country')
            ->get();
        return view('welcome', compact('cities'));
    }
}
