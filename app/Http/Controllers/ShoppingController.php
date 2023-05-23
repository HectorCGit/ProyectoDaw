<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{

    /**
     * Agregar billete
     *
     */
    public function comprarBilletes()
    {
        //insert ida
        $id = Auth::id();
        DB::insert('Insert into tickets (id_flight,id_passenger,num_suitcases,price)
        values (' . request('idFlight') . ',' . $id . ',2,' . request('precioIda') . ') ');


    }

    /**
     * Devuelve la lista de billetes para comprar
     *
     */
    public function mostrarBilletes()
    {

        $tickets = Ticket::query();

        return view('carrito');
    }

}
