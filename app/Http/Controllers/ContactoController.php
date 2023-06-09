<?php

namespace App\Http\Controllers;




use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function mostrarFormulario(){
        return view('contacto');
    }
    /**
     *
     *Envia un correo al admin con la direccion del usuario
     */
    public function enviarFormulario(){
        Mail::raw(request('mensaje'),function ($message) {
            $message
            ->to('admin@gmail.com')
            ->from(request('email'))
            ->subject('Contacto de '.request('nombre'));
        });
    return view('correoExito');
    }

}
