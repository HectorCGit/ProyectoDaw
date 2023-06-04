<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController
{
    private string $redirectTo;
    public function accederHome()
    {
        if (Auth::user()) {
            if (Auth::user()->hasAnyRole('company')) {
                return $this->redirectTo = route('homeCompany');
            }
            if (Auth::user()->hasAnyRole('passenger')) {
                return $this->redirectTo = route('homePassenger');
            } else {
                return $this->redirectTo = route('homeAdmin');
            }
        } else {
            return $this->redirectTo = route('/');
        }
    }

}
