<?php

namespace App\Http\Controllers;



use App\Models\Flight;
use App\Models\Ticket;
use App\Models\UserPassenger;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{

    public function mostrarBilletesCheckIn(){
        $queryIdPassenger = UserPassenger::query()->select('id_passenger')->where('id_users', '=', Auth::id())->get();
        $idPassenger = $queryIdPassenger[0]['id_passenger'];
        $tickets= Ticket::query()->select()->where('id_passenger','=',$idPassenger)->get();
        return view('checkIn',compact('tickets'));
    }

    public function checkIn(){
        $queryIdVuelo=Ticket::query()->select('id_flight')->where('id_ticket','=',request('idBillete'))->get();
        $idVuelo=$queryIdVuelo[0]['id_flight'];
        $queryNumCheckIn=Flight::query()->select('num_check_in')->where('id_flight','=',$idVuelo)->get();
        $numCheckIn=$queryNumCheckIn[0]['num_check_in'];
        Ticket::query()->where('id_ticket','=',request('idBillete'))->update(['check_in'=>1]);
        Flight::query()->where('id_flight','=',$idVuelo)->update(['num_check_in'=>$numCheckIn+1]);
        return back();
    }
}