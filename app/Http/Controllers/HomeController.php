<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function accederHome()
    {
        if (Auth::user()) {
            if (Auth::user()->hasAnyRole('company')) {
                return redirect()->route('homeCompany');
            }
            if (Auth::user()->hasAnyRole('passenger')) {
                return redirect()->route('homePassenger');
            } else {
                return redirect()->route('homeAdmin');
            }
        } else {
            return redirect()->route('homePassenger');
        }
    }

}
