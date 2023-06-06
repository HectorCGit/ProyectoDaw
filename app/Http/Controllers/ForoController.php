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
        return redirect()->route('foro');
    }

    public function mostrarMensajes()
    {
        if(session('contador')===0){
            $idTema = session('idTema');
        }else{
            $idTema = request('idTema');
        }
        $temaElegido=Topic::query()->select()->where('id_topic','=',$idTema)->get();
        $mensajes = Message::query()->select('users.name','content','id_message')->
        join('users','id_users','=','id')->
        where('id_topic', '=', $idTema)->paginate(10);
        return view('tema', compact('mensajes','temaElegido'));
    }

    public function crearMensajes()
    {
        Message::query()->insert(['id_users' => Auth::id(), 'id_topic' => request('idTema'), 'content' => request('contenido')]);
        $idTema=request('idTema');
        $contador=0;
        return redirect()->route('mostrarMensajes')->with(['idTema' => $idTema,'contador'=>$contador]);
    }
}

?>
