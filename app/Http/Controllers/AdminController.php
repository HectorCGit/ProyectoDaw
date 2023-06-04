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
        $temas = Topic::query()->select()->paginate(5);
        return view('foro',compact('temas'));
    }
    function eliminarMensajes(){
        Message::query()->find(request('idMensaje'))->delete();
        $temas = Topic::query()->select()->paginate(5);
        return view('foro',compact('temas'));
    }

}
