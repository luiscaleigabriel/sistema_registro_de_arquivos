@extends('layouts.system')

@section('title', 'Dashboard - Secretário')

@section('page-title', 'Dashboard do Secretário')

@section('sidebar-menu')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('secretario.dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('secretario.processos') }}">
            <i class="bi bi-folder"></i>
            <span>Processos</span>
            @if($processos_pendentes > 0)
            <span class="badge bg-danger float-end">{{ $processos_pendentes }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('secretario.inscricoes') }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Inscrições</span>
            @if($inscricoes_pendentes > 0)
            <span class="badge bg-danger float-end">{{ $inscricoes_pendentes }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('secretario.documentos') }}">
            <i class="bi bi-file-earmark-pdf"></i>
            <span>Documentos</span>
            @if($documentos_pendentes > 0)
            <span class="badge bg-danger float-end">{{ $documentos_pendentes }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('secretario.alunos') }}">
            <i class="bi bi-people"></i>
            <span>Alunos</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('secretario.relatorios') }}">
            <i class="bi bi-graph-up"></i>
            <span>Relatórios</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('secretario.configuracoes') }}">
            <i class="bi bi-gear"></i>
            <span>Configurações</span>
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
                    Você tem <strong>{{ $processos_pendentes }}</strong> processos pendentes,
                    <strong>{{ $inscricoes_pendentes }}</strong> inscrições para analisar e
                    <strong>{{ $documentos_pendentes }}</strong> documentos para validar.
                </p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="dashboard-card">
                <div class="card-icon icon-warning">
                    <i class="bi bi-folder fs-4"></i>
                </div>
                <h3 class="stat-number">{{ $processos_pendentes }}</h3>
                <p class="stat-label">Processos Pendentes</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="dashboard-card">
                <div class="card-icon icon-info">
                    <i class="bi bi-file-earmark-text fs-4"></i>
                </div>
                <h3 class="stat-number">{{ $inscricoes_pendentes }}</h3>
                <p class="stat-label">Inscrições Pendentes</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="dashboard-card">
                <div class="card-icon icon-danger">
                    <i class="bi bi-file-earmark-pdf fs-4"></i>
                </div>
                <h3 class="stat-number">{{ $documentos_pendentes }}</h3>
                <p class="stat-label">Documentos Pendentes</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="dashboard-card">
                <div class="card-icon icon-success">
                    <i class="bi bi-people fs-4"></i>
                </div>
                <h3 class="stat-number">{{ $total_alunos }}</h3>
                <p class="stat-label">Alunos Ativos</p>
            </div>
        </div>
    </div>

    <!-- Recent Processes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Processos para Análise</h5>
                    <a href="{{ route('secretario.processos') }}" class="btn btn-sm btn-outline-primary">
                        Ver Todos
                    </a>
                </div>

                @if($processos_recentes->count() > 0)
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Nº Processo</th>
                                <th>Aluno</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($processos_recentes as $processo)
                            <tr>
                                <td>{{ $processo->num_processo }}</td>
                                <td>{{ $processo->aluno->usuario->nome }}</td>
                                <td>{{ $processo->tipoFormatado }}</td>
                                <td>{{ date('d/m/Y', strtotime($processo->data_abertura)) }}</td>
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
                                <td>
                                    <a href="{{ route('secretario.processo.analisar', $processo->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-search"></i> Analisar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="bi bi-check-circle display-4 text-success mb-3"></i>
                    <p class="text-muted mb-0">Todos os processos estão analisados!</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Inscriptions -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Inscrições para Avaliar</h5>
                    <a href="{{ route('secretario.inscricoes') }}" class="btn btn-sm btn-outline-primary">
                        Ver Todas
                    </a>
                </div>

                @if($inscricoes_recentes->count() > 0)
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Aluno</th>
                                <th>Tipo</th>
                                <th>Nota Teste</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inscricoes_recentes as $inscricao)
                            <tr>
                                <td>{{ $inscricao->aluno->usuario->nome }}</td>
                                <td>{{ $inscricao->tipoInscricaoFormatado }}</td>
                                <td>
                                    @if($inscricao->nota_teste)
                                        <span class="fw-bold">{{ $inscricao->notaTesteFormatada }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y', strtotime($inscricao->data_inscricao)) }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pendente' => 'badge-warning',
                                            'submetida' => 'badge-info',
                                            'em_analise' => 'badge-warning',
                                            'aprovada' => 'badge-success',
                                            'rejeitada' => 'badge-danger'
                                        ][$inscricao->status] ?? 'badge-secondary';
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $inscricao->statusFormatado }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('secretario.inscricao.avaliar', $inscricao->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-clipboard-check"></i> Avaliar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="bi bi-check-circle display-4 text-success mb-3"></i>
                    <p class="text-muted mb-0">Todas as inscrições estão avaliadas!</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
