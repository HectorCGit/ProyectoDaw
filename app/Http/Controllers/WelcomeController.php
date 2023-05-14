<?php


namespace App\Http\Controllers;

use App\Models\Country;

class WelcomeController extends Controller
{
    public function mostrarUbicaciones(){
        $countries=Country::query()->select("name")->get();
        return view('welcome', compact('countries'));
    }
}
