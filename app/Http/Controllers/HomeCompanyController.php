<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return
     */
    public function mostrarHomeCompany()
    {
        /*$user=Auth::user();
        if($user->type === 'passenger'){
            return view('passenger.home');
        }elseif ($user->type === 'company'){
            return view('company.home');
        }*/
        return view('homeCompany');
    }
}
