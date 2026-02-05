@extends('layouts.system')

@section('title', 'Meus Processos')

@section('page-title', 'Meus Processos')

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
                        <h3 class="mb-2">Meus Processos</h3>
                        <p class="text-muted mb-0">Gerencie seus processos acadêmicos</p>
                    </div>
                    <a href="{{ route('aluno.processos.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Novo Processo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        @php
            $stats = [
                'aberto' => $processos->where('status', 'aberto')->count(),
                'em_analise' => $processos->where('status', 'em_analise')->count(),
                'aprovado' => $processos->where('status', 'aprovado')->count(),
                'arquivado' => $processos->where('status', 'arquivado')->count(),
            ];
        @endphp

        <div class="col-md-3 col-6 mb-3">
            <div class="dashboard-card text-center">
                <h3 class="stat-number text-info">{{ $stats['aberto'] }}</h3>
                <p class="stat-label">Abertos</p>
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
                <h3 class="stat-number text-success">{{ $stats['aprovado'] }}</h3>
                <p class="stat-label">Aprovados</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="dashboard-card text-center">
                <h3 class="stat-number text-secondary">{{ $stats['arquivado'] }}</h3>
                <p class="stat-label">Arquivados</p>
            </div>
        </div>
    </div>

    <!-- Processos Table -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Nº Processo</th>
                                <th>Tipo</th>
                                <th>Data Abertura</th>
                                <th>Status</th>
                                <th>Taxa</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($processos as $processo)
                            <tr>
                                <td>
                                    <strong>{{ $processo->num_processo }}</strong>
                                    @if($processo->descricao)
                                    <br><small class="text-muted">{{ Str::limit($processo->descricao, 40) }}</small>
                                    @endif
                                </td>
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
                                    @if($processo->taxa_processo > 0)
                                        <span class="fw-bold">{{ $processo->taxaProcessoFormatada }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('aluno.processo.view', $processo->id) }}"
                                           class="btn btn-sm btn-outline-primary" title="Ver Detalhes">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if($processo->status === 'aberto')
                                        <a href="#" class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="bi bi-folder-x display-4 text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Nenhum processo encontrado.</p>
                                    <a href="{{ route('aluno.processos.create') }}" class="btn btn-primary mt-3">
                                        Criar Primeiro Processo
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($processos->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $processos->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
