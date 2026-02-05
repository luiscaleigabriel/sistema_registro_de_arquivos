@extends('layouts.system')

@section('title', 'Dashboard - Administrador')

@section('page-title', 'Dashboard do Administrador')

@section('sidebar-menu')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.usuarios') }}">
            <i class="bi bi-people"></i>
            <span>Usuários</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.processos') }}">
            <i class="bi bi-folder"></i>
            <span>Processos</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.inscricoes') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Inscrições</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.relatorios') }}">
            <i class="bi bi-graph-up"></i>
            <span>Relatórios</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.configuracoes') }}">
            <i class="bi bi-gear"></i>
            <span>Configurações</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.auditoria') }}">
            <i class="bi bi-shield-check"></i>
            <span>Auditoria</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-card">
                <h3 class="mb-3">Bem-vindo, {{ $user->nome }}!</h3>
                <p class="text-muted mb-0">
                    Você está no painel de administração do sistema. Aqui pode gerenciar usuários,
                    visualizar estatísticas e configurar o sistema.
                </p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="dashboard-card">
                <div class="card-icon icon-primary">
                    <i class="bi bi-people fs-4"></i>
                </div>
                <h3 class="stat-number">{{ $total_usuarios }}</h3>
                <p class="stat-label">Total Usuários</p>
                <div class="small text-muted">
                    {{ $total_alunos }} alunos, {{ $total_secretarios }} secretários, {{ $total_administradores }} admins
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="dashboard-card">
                <div class="card-icon icon-info">
                    <i class="bi bi-folder fs-4"></i>
                </div>
                <h3 class="stat-number">{{ $total_processos }}</h3>
                <p class="stat-label">Processos</p>
                <div class="small text-muted">
                    {{ $processos_ativos }} ativos, {{ $processos_arquivados }} arquivados
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="dashboard-card">
                <div class="card-icon icon-success">
                    <i class="bi bi-file-earmark-text fs-4"></i>
                </div>
                <h3 class="stat-number">{{ $total_inscricoes }}</h3>
                <p class="stat-label">Inscrições</p>
                <div class="small text-muted">
                    {{ $inscricoes_aprovadas }} aprovadas
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="dashboard-card">
                <div class="card-icon icon-warning">
                    <i class="bi bi-file-earmark-pdf fs-4"></i>
                </div>
                <h3 class="stat-number">{{ $total_documentos }}</h3>
                <p class="stat-label">Documentos</p>
                <div class="small text-muted">
                    {{ $documentos_validados }} validados
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users and Processes -->
    <div class="row">
        <!-- Recent Users -->
        <div class="col-md-6 mb-4">
            <div class="dashboard-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Últimos Usuários</h5>
                    <a href="{{ route('admin.usuarios') }}" class="btn btn-sm btn-outline-primary">
                        Ver Todos
                    </a>
                </div>

                @if($ultimos_usuarios->count() > 0)
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimos_usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->nome }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @php
                                        $roleClass = [
                                            'aluno' => 'badge-info',
                                            'secretario' => 'badge-warning',
                                            'administrador' => 'badge-success'
                                        ][$usuario->nivel_acesso] ?? 'badge-secondary';
                                    @endphp
                                    <span class="status-badge {{ $roleClass }}">
                                        {{ ucfirst($usuario->nivel_acesso) }}
                                    </span>
                                </td>
                                <td>{{ date('d/m/Y', strtotime($usuario->created_at)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <p class="text-muted mb-0">Nenhum usuário encontrado.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Processes -->
        <div class="col-md-6 mb-4">
            <div class="dashboard-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Últimos Processos</h5>
                    <a href="{{ route('admin.processos') }}" class="btn btn-sm btn-outline-primary">
                        Ver Todos
                    </a>
                </div>

                @if($ultimos_processos->count() > 0)
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Processo</th>
                                <th>Aluno</th>
                                <th>Status</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimos_processos as $processo)
                            <tr>
                                <td>{{ $processo->num_processo }}</td>
                                <td>{{ $processo->aluno->usuario->nome }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'aberto' => 'badge-info',
                                            'em_analise' => 'badge-warning',
                                            'aprovado' => 'badge-success',
                                            'rejeitado' => 'badge-danger',
                                            'arquivado' => 'badge-secondary'
                                        ][$processo->status] ?? 'badge-secondary';
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $processo->statusFormatado }}
                                    </span>
                                </td>
                                <td>{{ date('d/m/Y', strtotime($processo->created_at)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <p class="text-muted mb-0">Nenhum processo encontrado.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <h5 class="mb-4">Ações Rápidas</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.usuarios.novo') }}" class="btn btn-primary w-100">
                            <i class="bi bi-person-plus me-2"></i>Novo Usuário
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.relatorios') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-graph-up me-2"></i>Relatórios
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.configuracoes') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-gear me-2"></i>Configurações
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.backup') }}" class="btn btn-outline-success w-100">
                            <i class="bi bi-database me-2"></i>Backup
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
