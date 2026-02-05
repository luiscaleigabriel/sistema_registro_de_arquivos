@extends('layouts.system')

@section('title', 'Meus Documentos')

@section('page-title', 'Meus Documentos')

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
                        <h3 class="mb-2">Meus Documentos</h3>
                        <p class="text-muted mb-0">Gerencie todos os seus documentos acadêmicos</p>
                    </div>
                    <a href="{{ route('aluno.documentos.create') }}" class="btn btn-primary">
                        <i class="bi bi-upload me-2"></i>Enviar Documento
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        @php
            $stats = [
                'pendente' => $documentos->where('status', 'pendente')->count(),
                'validado' => $documentos->where('status', 'validado')->count(),
                'rejeitado' => $documentos->where('status', 'rejeitado')->count(),
                'total' => $documentos->count(),
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
                <h3 class="stat-number text-success">{{ $stats['validado'] }}</h3>
                <p class="stat-label">Validados</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="dashboard-card text-center">
                <h3 class="stat-number text-danger">{{ $stats['rejeitado'] }}</h3>
                <p class="stat-label">Rejeitados</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="dashboard-card text-center">
                <h3 class="stat-number text-primary">{{ $stats['total'] }}</h3>
                <p class="stat-label">Total</p>
            </div>
        </div>
    </div>

    <!-- Documents Table -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <!-- Filters -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <select class="form-select" id="filterStatus">
                            <option value="">Todos os Status</option>
                            <option value="pendente">Pendente</option>
                            <option value="validado">Validado</option>
                            <option value="rejeitado">Rejeitado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="filterType">
                            <option value="">Todos os Tipos</option>
                            <option value="bi">Bilhete de Identidade</option>
                            <option value="certificado">Certificado</option>
                            <option value="fotografia">Fotografia</option>
                            <option value="comprovativo">Comprovativo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="searchInput" placeholder="Buscar documento...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table custom-table" id="documentsTable">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Nome do Arquivo</th>
                                <th>Processo/Inscrição</th>
                                <th>Data Envio</th>
                                <th>Status</th>
                                <th>Tamanho</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documentos as $documento)
                            <tr data-status="{{ $documento->status }}" data-type="{{ $documento->tipo }}">
                                <td>{{ $documento->tipoFormatado }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @php
                                            $iconClass = [
                                                'pdf' => 'bi-file-earmark-pdf text-danger',
                                                'jpg' => 'bi-file-earmark-image text-success',
                                                'jpeg' => 'bi-file-earmark-image text-success',
                                                'png' => 'bi-file-earmark-image text-success',
                                                'doc' => 'bi-file-earmark-word text-primary',
                                                'docx' => 'bi-file-earmark-word text-primary'
                                            ][$documento->extensao] ?? 'bi-file-earmark-text';
                                        @endphp
                                        <i class="bi {{ $iconClass }} me-2"></i>
                                        <span>{{ $documento->nome_arquivo }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($documento->processo)
                                    <a href="{{ route('aluno.processo.view', $documento->processo->id) }}"
                                       class="text-decoration-none">
                                        {{ $documento->processo->num_processo }}
                                    </a>
                                    @elseif($documento->inscricao)
                                    <span class="text-muted">Inscrição #{{ $documento->inscricao->id }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y H:i', strtotime($documento->data_envio)) }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pendente' => 'badge-warning',
                                            'validado' => 'badge-success',
                                            'rejeitado' => 'badge-danger'
                                        ][$documento->status] ?? 'badge-secondary';
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $documento->statusFormatado }}
                                    </span>
                                    @if($documento->validado_por && $documento->data_validacao)
                                    <br><small class="text-muted">Validado em: {{ date('d/m/Y', strtotime($documento->data_validacao)) }}</small>
                                    @endif
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
                                                    <p class="text-danger"><small>Esta ação não pode ser desfeita.</small></p>
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
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="bi bi-file-earmark-x display-4 text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Nenhum documento encontrado.</p>
                                    <a href="{{ route('aluno.documentos.create') }}" class="btn btn-primary mt-3">
                                        <i class="bi bi-upload me-2"></i>Enviar Primeiro Documento
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($documentos->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $documentos->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterStatus = document.getElementById('filterStatus');
    const filterType = document.getElementById('filterType');
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#documentsTable tbody tr');

    function filterTable() {
        const statusValue = filterStatus.value;
        const typeValue = filterType.value;
        const searchValue = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const status = row.getAttribute('data-status');
            const type = row.getAttribute('data-type');
            const text = row.textContent.toLowerCase();

            const statusMatch = !statusValue || status === statusValue;
            const typeMatch = !typeValue || type === typeValue;
            const searchMatch = !searchValue || text.includes(searchValue);

            if (statusMatch && typeMatch && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    filterStatus.addEventListener('change', filterTable);
    filterType.addEventListener('change', filterTable);
    searchInput.addEventListener('input', filterTable);
});
</script>
@endsection
