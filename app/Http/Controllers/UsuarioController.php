<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Aluno;

class UsuarioController extends Controller
{
    /**
     * Mostrar perfil do aluno
     */
    public function perfil()
    {
        $user = Auth::user();
        $aluno = $user->aluno;

        return view('aluno.perfil.index', compact('user', 'aluno'));
    }

    /**
     * Atualizar perfil do aluno
     */
    public function updatePerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nome' => 'required|string|max:100',
            'telefone' => 'required|string|max:20',
            'morada' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'senha_atual' => 'nullable|string',
            'nova_senha' => 'nullable|string|min:8|confirmed'
        ]);

        // Verificar senha atual se estiver alterando
        if ($request->filled('nova_senha')) {
            if (!Hash::check($request->senha_atual, $user->senha)) {
                return redirect()->back()->withErrors(['senha_atual' => 'Senha atual incorreta.']);
            }

            $user->senha = Hash::make($request->nova_senha);
        }

        // Atualizar dados do usuário
        $user->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'morada' => $request->morada
        ]);

        return redirect()->route('aluno.perfil')
            ->with('success', 'Perfil atualizado com sucesso!');
    }
}
