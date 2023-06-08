<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\Topic;

class AdminController extends Controller
{

    function mostrarHomeAdmin(){
        return view('homeAdmin');
    }
    function eliminarTemas()
    {
        Message::query()->where('id_topic','=',request('idTema'))->delete();
        Topic::query()->find(request('idTema'))->delete();
        return redirect()->route('foro');

    }
    function eliminarMensajes(){
        Message::query()->find(request('idMensaje'))->delete();
        $idTema=request('idTema');
        $contador=0;
        return redirect()->route('mostrarMensajes')->with(['idTema' => $idTema,'contador'=>$contador]);
    }

}
