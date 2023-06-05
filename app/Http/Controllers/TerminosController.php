<?php

namespace App\Http\Controllers;




class TerminosController extends Controller
{

    public function terminosyCondiciones(){
        return view('terminosyCondiciones');
    }
    public function privacidad(){
        return view('privacidad');
    }
    public function info(){
        return view('informacion');
    }
}
