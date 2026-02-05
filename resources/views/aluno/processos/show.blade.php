@extends('layouts.system')

@section('title', 'Detalhes do Processo')

@section('page-title', 'Detalhes do Processo')

@section('sidebar-menu')
@include('aluno.partials.menu')
@endsection

@section('content')
<div class="container-fluid">
    <!-- Process Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h3 class="mb-2">Processo: {{ $processo->num_processo }}</h3>
                        <div class="d-flex flex-wrap gap-2 mb-2">
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
                            <span class="badge bg-light text-dark border">
                                {{ $processo->tipoFormatado }}
                            </span>
                            @if($processo->taxa_processo > 0)
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-cash-coin me-1"></i>{{ $processo->taxaProcessoFormatada }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('aluno.processos') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Voltar
                    </a>
                </div>

                <!-- Process Info -->
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Informações do Processo</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Data Abertura:</th>
                                <td>{{ date('d/m/Y', strtotime($processo->data_abertura)) }}</td>
                            </tr>
                            <tr>
                                <th>Aluno:</th>
                                <td>{{ $processo->aluno->usuario->nome }}</td>
                            </tr>
                            <tr>
                                <th>Número Aluno:</th>
                                <td>{{ $processo->aluno->numero_aluno }}</td>
                            </tr>
                            <tr>
                                <th>Curso:</th>
                                <td>{{ $processo->aluno->curso }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Andamento</h5>
                        <table class="table table-borderless">
                            @if($processo->analisado_por)
                            <tr>
                                <th width="150">Analisado por:</th>
                                <td>{{ $processo->analista->nome ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Data Análise:</th>
                                <td>{{ $processo->data_analise ? date('d/m/Y', strtotime($processo->data_analise)) : 'N/A' }}</td>
                            </tr>
                            @endif
                            @if($processo->data_arquivamento)
                            <tr>
                                <th>Arquivado em:</th>
                                <td>{{ date('d/m/Y', strtotime($processo->data_arquivamento)) }}</td>
                            </tr>
                            <tr>
                                <th>Local:</th>
                                <td>{{ $processo->local_arquivamento ?? 'N/A' }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <!-- Description -->
                @if($processo->descricao)
                <div class="mt-4">
                    <h5 class="mb-2">Descrição</h5>
                    <div class="border rounded p-3 bg-light">
                        {{ $processo->descricao }}
                    </div>
                </div>
                @endif

                <!-- Analysis Observations -->
                @if($processo->observacoes_analise)
                <div class="mt-4">
                    <h5 class="mb-2">Observações da Análise</h5>
                    <div class="border rounded p-3 bg-light">
                        {{ $processo->observacoes_analise }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Documents Section -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Documentos do Processo</h5>
                    @if($processo->status === 'aberto')
                    <a href="{{ route('aluno.documentos.create') }}?processo_id={{ $processo->id }}"
                       class="btn btn-primary btn-sm">
                        <i class="bi bi-upload me-1"></i>Enviar Documento
                    </a>
                    @endif
                </div>

                @if($processo->documentos->count() > 0)
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Nome do Arquivo</th>
                                <th>Data Envio</th>
                                <th>Status</th>
                                <th>Tamanho</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($processo->documentos as $documento)
                            <tr>
                                <td>{{ $documento->tipoFormatado }}</td>
                                <td>{{ $documento->nome_arquivo }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($documento->data_envio)) }}</td>
                                <td>
                                    @php
                                        $docStatusClass = [
                                            'pendente' => 'badge-warning',
                                            'validado' => 'badge-success',
                                            'rejeitado' => 'badge-danger'
                                        ][$documento->status] ?? 'badge-secondary';
                                    @endphp
                                    <span class="status-badge {{ $docStatusClass }}">
                                        {{ $documento->statusFormatado }}
                                    </span>
                                </td>
                                <td>{{ $documento->tamanhoFormatado }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('aluno.documento.download', $documento->id) }}"
                                           class="btn btn-sm btn-outline-primary" title="Download">
                                            <i class="bi bi-download"></i>
                                        </a>
                                        @if($documento->status === 'pendente')
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                title="Excluir" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $documento->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        @endif
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $documento->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Excluir Documento</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem certeza que deseja excluir o documento <strong>{{ $documento->nome_arquivo }}</strong>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('aluno.documento.destroy', $documento->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="bi bi-file-earmark-x display-4 text-muted mb-3"></i>
                    <p class="text-muted mb-0">Nenhum documento enviado para este processo.</p>
                    @if($processo->status === 'aberto')
                    <a href="{{ route('aluno.documentos.create') }}?processo_id={{ $processo->id }}"
                       class="btn btn-primary mt-3">
                        <i class="bi bi-upload me-2"></i>Enviar Primeiro Documento
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
