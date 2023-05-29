<?php
namespace App\Http\Controllers;


use App\Models\UserPassenger;
use Illuminate\Support\Facades\Auth;

class RuletaController extends Controller
{
public function mostrarRuleta(){
    $idUsuario=Auth::id();
    $puntos=UserPassenger::query()->select('id_users','points')->where('id_users','=',$idUsuario)->get();
    return view('ruleta',compact('puntos'));
}
public function generarPremio(){

}
}
