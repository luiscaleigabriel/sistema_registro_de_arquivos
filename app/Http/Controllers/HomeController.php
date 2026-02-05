<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Mostrar página inicial
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Mostrar página sobre
     */
    public function sobre()
    {
        return view('sobre');
    }

    /**
     * Mostrar página de contacto
     */
    public function contacto()
    {
        return view('contacto');
    }

    /**
     * Processar formulário de contacto
     */
    public function contactoSubmit(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'assunto' => 'required|string|max:255',
            'mensagem' => 'required|string'
        ]);

        // envio de email
        // Mail::to('contacto@instituto.edu.ao')->send(new ContactMessage($request->all()));

        return response()->json([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso!'
        ]);
    }
}
