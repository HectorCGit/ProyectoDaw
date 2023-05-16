<?php


namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;

class WelcomeController extends Controller
{
    public function mostrarUbicaciones(){
        $countries=Country::query()->select("name")->get();
        return view('welcome', compact('countries'));
    }
    public function mostrarCiudades(){

        $selectedCountry=Country::query()->select('id_country')->where('name','=',request('paises'))->get();

        $cities=City::query()->select('name')->where('id_country','=',$selectedCountry);
        return view('welcome',compact('cities'));
    }
}
