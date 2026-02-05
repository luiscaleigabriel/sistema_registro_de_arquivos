<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Aluno;
use App\Jobs\SendWelcomeEmail;

class AuthController extends Controller
{
    /**
     * Mostrar formulário de login
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Processar login
     */
    public function login(Request $request)
    {
        // Validação
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('senha'));
        }

        // Tentar autenticação
        $credentials = [
            'email' => $request->email,
            'password' => $request->senha, // Laravel espera 'password'
            'ativo' => true
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Registrar login
            $user = Auth::user();
            activity()
                ->causedBy($user)
                ->log('Login realizado');

            // Redirecionar conforme nível de acesso
            return $this->redirectToDashboard($user);
        }

        return back()
            ->withErrors([
                'email' => 'Credenciais inválidas!.',
            ])
            ->withInput($request->except('senha'));
    }

    /**
     * Mostrar formulário de registro
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.registro');
    }

    /**
     * Processar registro de aluno
     */
    public function register(Request $request)
    {
        // Validação
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'bi' => 'required|string|max:20|unique:users,bi',
            'data_nasc' => 'required|date|before:-16 years',
            'morada' => 'required|string|max:255',
            'telefone' => 'required|string|min:9|max:16',
            'curso' => 'required|string|max:100',
            'senha' => 'required|string|min:8|confirmed',
            'termos' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except(['senha', 'senha_confirmation']));
        }

        // Iniciar transação
        DB::beginTransaction();

        try {
            // Criar usuário
            $usuario = User::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'bi' => $request->bi,
                'data_nasc' => $request->data_nasc,
                'morada' => $request->morada,
                'telefone' => $request->telefone,
                'nivel_acesso' => 'aluno',
                'ativo' => true,
                'email_verificado_em' => now(),
            ]);

            // Criar aluno
            $aluno = Aluno::create([
                'usuario_id' => $usuario->id,
                'numero_aluno' => User::gerarNumeroAluno(),
                'curso' => $request->curso,
                'ano_letivo' => date('Y') . '/' . (date('Y') + 1),
                'status' => 'ativo',
                'data_inscricao' => now(),
            ]);

            // Criar processo automático para o aluno
            $numeroProcesso = 'PROC/' . date('Y') . '/' . str_pad($aluno->id, 6, '0', STR_PAD_LEFT);
            $aluno->update(['numero_processo' => $numeroProcesso]);

            // Enviar email de boas-vindas em background
            SendWelcomeEmail::dispatch($usuario, $aluno);

            // Commit transação
            DB::commit();

            // Autenticar automaticamente
            Auth::login($usuario);

            return redirect()->route('aluno.dashboard')
                ->with('success', 'Conta criada com sucesso! Bem-vindo ao sistema.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Erro ao criar conta. Tente novamente mais tarde.'])
                ->withInput($request->except(['senha', 'senha_confirmation']));
        }
    }

    /**
     * Processar logout
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Logout realizado com sucesso.');
    }

    /**
     * Redirecionar para dashboard conforme nível de acesso
     */
    private function redirectToDashboard($user)
    {
        switch ($user->nivel_acesso) {
            case 'aluno':
                return redirect()->route('aluno.dashboard');
            case 'secretario':
                return redirect()->route('secretario.dashboard');
            case 'administrador':
                return redirect()->route('admin.dashboard');
            default:
                return redirect()->route('home');
        }
    }

    /**
     * Verificar email
     */
    public function verifyEmail($id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals($hash, sha1($user->email))) {
            abort(403);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->email_verificado_em = now();
            $user->save();

            return redirect()->route('login')
                ->with('success', 'Email verificado com sucesso! Faça login para continuar.');
        }

        return redirect()->route('login')
            ->with('info', 'Email já verificado anteriormente.');
    }

    /**
     * Mostrar formulário para recuperar senha
     */
    public function showPasswordRequest()
    {
        return view('auth.password-request');
    }

    /**
     * Enviar link para recuperar senha
     */
    public function sendPasswordReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Gerar token e enviar email (implementar depois)
            return back()->with('success', 'Link de recuperação enviado para seu email.');
        }

        return back()->withErrors(['email' => 'Email não encontrado.']);
    }
}
