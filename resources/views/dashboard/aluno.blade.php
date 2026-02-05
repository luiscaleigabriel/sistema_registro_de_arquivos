@extends('layouts.system')

@section('title', 'Dashboard - Aluno')

@section('page-title', 'Dashboard do Aluno')

@section('sidebar-menu')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('aluno.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('aluno.processos') }}">
                <i class="bi bi-folder"></i>
                <span>Meus Processos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('aluno.inscricoes') }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Minhas Inscrições</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('aluno.documentos') }}">
                <i class="bi bi-file-earmark-pdf"></i>
                <span>Meus Documentos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('aluno.perfil') }}">
                <i class="bi bi-person"></i>
                <span>Meu Perfil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('aluno.nova-inscricao') }}">
                <i class="bi bi-plus-circle"></i>
                <span>Nova Inscrição</span>
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
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-2">Bem-vindo, {{ $aluno->usuario->nome }}!</h3>
                            <p class="text-muted mb-0">
                                Número: {{ $aluno->numero_aluno }} |
                                Curso: {{ $aluno->curso }} |
                                Ano: {{ $aluno->ano_letivo }}
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('aluno.nova-inscricao') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Nova Inscrição
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="dashboard-card">
                    <div class="card-icon icon-primary">
                        <i class="bi bi-folder fs-4"></i>
                    </div>
                    <h3 class="stat-number">{{ $total_processos }}</h3>
                    <p class="stat-label">Processos</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card">
                    <div class="card-icon icon-success">
                        <i class="bi bi-file-earmark-text fs-4"></i>
                    </div>
                    <h3 class="stat-number">{{ $total_inscricoes }}</h3>
                    <p class="stat-label">Inscrições</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card">
                    <div class="card-icon icon-warning">
                        <i class="bi bi-file-earmark-pdf fs-4"></i>
                    </div>
                    <h3 class="stat-number">{{ $total_documentos }}</h3>
                    <p class="stat-label">Documentos</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card">
                    <div class="card-icon icon-info">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <h3 class="stat-number">{{ $processos_abertos }}</h3>
                    <p class="stat-label">Processos Abertos</p>
                </div>
            </div>
        </div>

        <!-- Recent Processes -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Últimos Processos</h5>
                        <a href="{{ route('aluno.processos') }}" class="btn btn-sm btn-outline-primary">
                            Ver Todos
                        </a>
                    </div>

                    @if ($ultimos_processos->count() > 0)
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>Nº Processo</th>
                                        <th>Tipo</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimos_processos as $processo)
                                        <tr>
                                            <td>{{ $processo->num_processo }}</td>
                                            <td>{{ $processo->tipoFormatado }}</td>
                                            <td>{{ date('d/m/Y', strtotime($processo->data_abertura)) }}</td>
                                            <td>
                                                @php
                                                    $statusClass =
                                                        [
                                                            'aberto' => 'badge-info',
                                                            'em_analise' => 'badge-warning',
                                                            'aprovado' => 'badge-success',
                                                            'rejeitado' => 'badge-danger',
                                                            'arquivado' => 'badge-secondary',
                                                        ][$processo->status] ?? 'badge-secondary';
                                                @endphp
                                                <span class="status-badge {{ $statusClass }}">
                                                    {{ $processo->statusFormatado }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('aluno.processo.view', $processo->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-folder-x display-4 text-muted mb-3"></i>
                            <p class="text-muted mb-0">Nenhum processo encontrado.</p>
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
                        <h5 class="mb-0">Últimas Inscrições</h5>
                        <a href="{{ route('aluno.inscricoes') }}" class="btn btn-sm btn-outline-primary">
                            Ver Todas
                        </a>
                    </div>

                    @if ($ultimas_inscricoes->count() > 0)
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Tipo</th>
                                        <th>Nota</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimas_inscricoes as $inscricao)
                                        <tr>
                                            <td>{{ date('d/m/Y', strtotime($inscricao->data_inscricao)) }}</td>
                                            <td>{{ $inscricao->tipoInscricaoFormatado }}</td>
                                            <td>
                                                @if ($inscricao->nota_teste)
                                                    <span class="fw-bold">{{ $inscricao->notaTesteFormatada }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass =
                                                        [
                                                            'pendente' => 'badge-warning',
                                                            'submetida' => 'badge-info',
                                                            'em_analise' => 'badge-warning',
                                                            'aprovada' => 'badge-success',
                                                            'rejeitada' => 'badge-danger',
                                                        ][$inscricao->status] ?? 'badge-secondary';
                                                @endphp
                                                <span class="status-badge {{ $statusClass }}">
                                                    {{ $inscricao->statusFormatado }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('aluno.inscricao.view', $inscricao->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-file-earmark-x display-4 text-muted mb-3"></i>
                            <p class="text-muted mb-0">Nenhuma inscrição encontrada.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
