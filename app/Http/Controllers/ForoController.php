<?php
namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class ForoController extends Controller
{
    public function mostrarTemas()
    {
        $temas = Topic::query()->select()->paginate(5);
        return view('foro', compact('temas'));
    }

    public function crearTemas()
    {
        Topic::query()->insert(['content' => request('tema')]);
        return back();
    }

    public function mostrarMensajes()
    {
        $temaElegido=Topic::query()->select()->where('id_topic','=',request('idTema'))->get();
        $mensajes = Message::query()->select('users.name','content')->
        join('users','id_users','=','id')->
        where('id_topic', '=', request('idTema'))->paginate(10);
        return view('tema', compact('mensajes','temaElegido'));
    }

    public function crearMensajes()
    {
        Message::query()->insert(['id_users' => Auth::id(), 'id_topic' => request('idTema'), 'content' => request('contenido')]);
        return $this->mostrarMensajes();
    }
}

?>
