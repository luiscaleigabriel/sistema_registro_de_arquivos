<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Processo;
use App\Models\Inscricao;
use App\Models\Documento;

class DashboardController extends Controller
{
    /**
     * Dashboard geral (redireciona conforme nível)
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        switch ($user->nivel_acesso) {
            case 'aluno':
                return redirect()->route('aluno.dashboard');
            case 'secretario':
                return redirect()->route('secretario.dashboard');
            case 'administrador':
                return redirect()->route('admin.dashboard');
            default:
                return redirect()->route('home')->with('error', 'Nível de acesso não reconhecido.');
        }
    }

    /**
     * Dashboard do Aluno
     */
    public function alunoDashboard()
    {
        $user = Auth::user();
        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->route('login')->with('error', 'Perfil de aluno não encontrado.');
        }

        // Estatísticas do aluno
        $processos = Processo::where('aluno_id', $aluno->id)->get();
        $inscricoes = Inscricao::where('aluno_id', $aluno->id)->get();
        $documentos = Documento::whereHas('processo', function($query) use ($aluno) {
            $query->where('aluno_id', $aluno->id);
        })->get();

        $dados = [
            'total_processos' => $processos->count(),
            'processos_abertos' => $processos->where('status', 'aberto')->count(),
            'processos_aprovados' => $processos->where('status', 'aprovado')->count(),
            'total_inscricoes' => $inscricoes->count(),
            'inscricoes_ativas' => $inscricoes->where('status', 'aprovada')->count(),
            'total_documentos' => $documentos->count(),
            'documentos_pendentes' => $documentos->where('status', 'pendente')->count(),
            'ultimos_processos' => $processos->take(5),
            'ultimas_inscricoes' => $inscricoes->take(5),
            'aluno' => $aluno
        ];

        return view('dashboard.aluno', $dados);
    }

    /**
     * Dashboard do Secretário
     */
    public function secretarioDashboard()
    {
        $user = Auth::user();

        // Estatísticas para secretário
        $processos_pendentes = Processo::where('status', 'aberto')->orWhere('status', 'em_analise')->count();
        $inscricoes_pendentes = Inscricao::where('status', 'pendente')->orWhere('status', 'em_analise')->count();
        $documentos_pendentes = Documento::where('status', 'pendente')->count();
        $total_alunos = Aluno::where('status', 'ativo')->count();

        // Processos recentes para análise
        $processos_recentes = Processo::with('aluno.usuario')
            ->whereIn('status', ['aberto', 'em_analise'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Inscrições recentes
        $inscricoes_recentes = Inscricao::with('aluno.usuario')
            ->whereIn('status', ['pendente', 'em_analise'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $dados = [
            'processos_pendentes' => $processos_pendentes,
            'inscricoes_pendentes' => $inscricoes_pendentes,
            'documentos_pendentes' => $documentos_pendentes,
            'total_alunos' => $total_alunos,
            'processos_recentes' => $processos_recentes,
            'inscricoes_recentes' => $inscricoes_recentes,
            'user' => $user
        ];

        return view('dashboard.secretario', $dados);
    }

    /**
     * Dashboard do Administrador
     */
    public function adminDashboard()
    {
        $user = Auth::user();

        // Estatísticas gerais
        $total_usuarios = User::count();
        $total_alunos = Aluno::count();
        $total_secretarios = User::where('nivel_acesso', 'secretario')->count();
        $total_administradores = User::where('nivel_acesso', 'administrador')->count();

        $total_processos = Processo::count();
        $processos_ativos = Processo::whereIn('status', ['aberto', 'em_analise'])->count();
        $processos_arquivados = Processo::where('status', 'arquivado')->count();

        $total_inscricoes = Inscricao::count();
        $inscricoes_aprovadas = Inscricao::where('status', 'aprovada')->count();

        $total_documentos = Documento::count();
        $documentos_validados = Documento::where('status', 'validado')->count();

        // Últimas atividades
        $ultimos_usuarios = User::with(['aluno', 'secretario', 'administrador'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $ultimos_processos = Processo::with('aluno.usuario')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $dados = [
            'total_usuarios' => $total_usuarios,
            'total_alunos' => $total_alunos,
            'total_secretarios' => $total_secretarios,
            'total_administradores' => $total_administradores,
            'total_processos' => $total_processos,
            'processos_ativos' => $processos_ativos,
            'processos_arquivados' => $processos_arquivados,
            'total_inscricoes' => $total_inscricoes,
            'inscricoes_aprovadas' => $inscricoes_aprovadas,
            'total_documentos' => $total_documentos,
            'documentos_validados' => $documentos_validados,
            'ultimos_usuarios' => $ultimos_usuarios,
            'ultimos_processos' => $ultimos_processos,
            'user' => $user
        ];

        return view('dashboard.admin', $dados);
    }
}
