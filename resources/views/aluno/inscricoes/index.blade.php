@extends('layouts.system')

@section('title', 'Minhas Inscrições')

@section('page-title', 'Minhas Inscrições')

@section('sidebar-menu')
@include('aluno.partials.menu')
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-2">Minhas Inscrições</h3>
                        <p class="text-muted mb-0">Gerencie suas inscrições acadêmicas</p>
                    </div>
                    <a href="{{ route('aluno.nova-inscricao') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Nova Inscrição
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        @php
            $stats = [
                'pendente' => $inscricoes->where('status', 'pendente')->count(),
                'submetida' => $inscricoes->where('status', 'submetida')->count(),
                'em_analise' => $inscricoes->where('status', 'em_analise')->count(),
                'aprovada' => $inscricoes->where('status', 'aprovada')->count(),
            ];
        @endphp

        <div class="col-md-3 col-6 mb-3">
            <div class="dashboard-card text-center">
                <h3 class="stat-number text-warning">{{ $stats['pendente'] }}</h3>
                <p class="stat-label">Pendentes</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="dashboard-card text-center">
                <h3 class="stat-number text-info">{{ $stats['submetida'] }}</h3>
                <p class="stat-label">Submetidas</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="dashboard-card text-center">
                <h3 class="stat-number text-warning">{{ $stats['em_analise'] }}</h3>
                <p class="stat-label">Em Análise</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="dashboard-card text-center">
                <h3 class="stat-number text-success">{{ $stats['aprovada'] }}</h3>
                <p class="stat-label">Aprovadas</p>
            </div>
        </div>
    </div>

    <!-- Inscricoes Table -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Processo</th>
                                <th>Nota Teste</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inscricoes as $inscricao)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($inscricao->data_inscricao)) }}</td>
                                <td>{{ $inscricao->tipoInscricaoFormatado }}</td>
                                <td>
                                    @if($inscricao->processo)
                                    <a href="{{ route('aluno.processo.view', $inscricao->processo->id) }}"
                                       class="text-decoration-none">
                                        {{ $inscricao->processo->num_processo }}
                                    </a>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($inscricao->nota_teste)
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold me-2">{{ $inscricao->notaTesteFormatada }}</span>
                                        @php
                                            $testeClass = $inscricao->resultado_teste === 'aprovado' ? 'badge-success' :
                                                         ($inscricao->resultado_teste === 'reprovado' ? 'badge-danger' : 'badge-warning');
                                        @endphp
                                        <span class="status-badge {{ $testeClass }} small">
                                            {{ $inscricao->resultadoTesteFormatado }}
                                        </span>
                                    </div>
                                    @else
                                    <span class="text-muted">Não realizado</span>
                                    @endif
                                </td>
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
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('aluno.inscricao.view', $inscricao->id) }}"
                                           class="btn btn-sm btn-outline-primary" title="Ver Detalhes">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if($inscricao->status === 'pendente' && $inscricao->podeSubmeter)
                                        <form action="{{ route('aluno.inscricao.validar', $inscricao->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success"
                                                    title="Validar e Enviar">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="bi bi-file-earmark-x display-4 text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Nenhuma inscrição encontrada.</p>
                                    <a href="{{ route('aluno.nova-inscricao') }}" class="btn btn-primary mt-3">
                                        Fazer Primeira Inscrição
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($inscricoes->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $inscricoes->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
