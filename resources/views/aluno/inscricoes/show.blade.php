{{-- resources/views/aluno/inscricoes/show.blade.php --}}
@extends('layouts.system')

@section('title', 'Detalhes da Inscrição')

@section('page-title', 'Detalhes da Inscrição')

@section('sidebar-menu')
    @include('aluno.partials.menu')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="mb-2">Inscrição #{{ str_pad($inscricao->id, 6, '0', STR_PAD_LEFT) }}</h3>
                            <div class="d-flex flex-wrap gap-2 mb-2">
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
                                    {{ $inscricao->statusFormatado ?? ucfirst($inscricao->status) }}
                                </span>
                                <span class="badge bg-light text-dark border">
                                    {{ $inscricao->tipoInscricaoFormatado ?? ucfirst($inscricao->tipo_inscricao) }}
                                </span>
                                @if ($inscricao->documentos_completos)
                                    <span class="badge bg-success text-white">
                                        <i class="bi bi-check-circle me-1"></i>Documentos Completos
                                    </span>
                                @endif
                                @if ($inscricao->taxa_paga)
                                    <span class="badge bg-success text-white">
                                        <i class="bi bi-currency-dollar me-1"></i>Taxa Paga
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-exclamation-triangle me-1"></i>Taxa Pendente
                                    </span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('aluno.inscricoes') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Voltar
                        </a>
                    </div>

                    <!-- Informações da Inscrição -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">Informações da Inscrição</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Data:</th>
                                    <td>{{ date('d/m/Y H:i', strtotime($inscricao->data_inscricao)) }}</td>
                                </tr>
                                <tr>
                                    <th>Tipo:</th>
                                    <td>{{ $inscricao->tipoInscricaoFormatado ?? ucfirst($inscricao->tipo_inscricao) }}</td>
                                </tr>
                                <tr>
                                    <th>Curso:</th>
                                    <td>{{ $inscricao->aluno->curso ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Ano Letivo:</th>
                                    <td>{{ $inscricao->aluno->ano_letivo ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Processo:</th>
                                    <td>
                                        @if ($inscricao->processo)
                                            <a href="{{ route('aluno.processo.view', $inscricao->processo->id) }}"
                                                class="text-decoration-none">
                                                {{ $inscricao->processo->num_processo ?? 'N/A' }}
                                            </a>
                                        @else
                                            <span class="text-muted">Não vinculado</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Resultados</h5>
                            <table class="table table-borderless">
                                @if ($inscricao->nota_teste)
                                    <tr>
                                        <th width="150">Nota do Teste:</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="fw-bold me-2">{{ number_format($inscricao->nota_teste, 1, ',', '.') }}
                                                    valores</span>
                                                @php
                                                    $testeClass =
                                                        $inscricao->resultado_teste === 'aprovado'
                                                            ? 'badge-success'
                                                            : ($inscricao->resultado_teste === 'reprovado'
                                                                ? 'badge-danger'
                                                                : 'badge-warning');
                                                @endphp
                                                <span class="status-badge {{ $testeClass }}">
                                                    {{ $inscricao->resultado_teste === 'aprovado'
                                                        ? 'Aprovado'
                                                        : ($inscricao->resultado_teste === 'reprovado'
                                                            ? 'Reprovado'
                                                            : 'Pendente') }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Data do Teste:</th>
                                        <td>{{ date('d/m/Y', strtotime($inscricao->data_teste)) }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>Teste:</th>
                                        <td>
                                            <span class="text-muted">Aguardando teste</span>
                                            @if ($inscricao->status === 'aprovada')
                                                <a href="#" class="btn btn-sm btn-outline-primary ms-2"
                                                    data-bs-toggle="modal" data-bs-target="#testeModal">
                                                    <i class="bi bi-pencil me-1"></i>Fazer Teste
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @if ($inscricao->data_avaliacao)
                                    <tr>
                                        <th>Avaliado por:</th>
                                        <td>{{ $inscricao->avaliador->nome ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Data Avaliação:</th>
                                        <td>{{ date('d/m/Y', strtotime($inscricao->data_avaliacao)) }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <!-- Observações -->
                    @if ($inscricao->observacoes)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">Observações</h5>
                                <div class="border rounded p-3 bg-light">
                                    {{ $inscricao->observacoes }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Ações -->
                    @if ($inscricao->status === 'pendente')
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-info-circle me-2"></i>
                                            <strong>Pronto para enviar?</strong> Verifique se todos os documentos estão
                                            anexados.
                                        </div>
                                        @if ($inscricao->documentos->count() > 0)
                                            <form action="{{ route('aluno.inscricao.validar', $inscricao->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-check-circle me-2"></i>Validar e Enviar para Análise
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#adicionarDocumentoModal">
                                                <i class="bi bi-plus-circle me-2"></i>Adicionar Documentos
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Documentos -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Documentos da Inscrição</h5>
                        @if ($inscricao->status === 'pendente')
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#adicionarDocumentoModal">
                                <i class="bi bi-plus-circle me-1"></i>Adicionar Documento
                            </button>
                        @endif
                    </div>

                    @if ($inscricao->documentos && $inscricao->documentos->count() > 0)
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
                                    @foreach ($inscricao->documentos as $documento)
                                        <tr>
                                            <td>
                                                @php
                                                    $tipos = [
                                                        'bi' => 'Bilhete de Identidade',
                                                        'certificado' => 'Certificado',
                                                        'fotografia' => 'Fotografia 3x4',
                                                        'comprovativo' => 'Comprovativo',
                                                        'declaracao' => 'Declaração',
                                                        'outro' => 'Outro',
                                                    ];
                                                @endphp
                                                {{ $tipos[$documento->tipo] ?? ucfirst($documento->tipo) }}
                                            </td>
                                            <td>{{ $documento->nome_arquivo }}</td>
                                            <td>{{ date('d/m/Y H:i', strtotime($documento->data_envio)) }}</td>
                                            <td>
                                                @php
                                                    $docStatusClass =
                                                        [
                                                            'pendente' => 'badge-warning',
                                                            'validado' => 'badge-success',
                                                            'rejeitado' => 'badge-danger',
                                                        ][$documento->status] ?? 'badge-secondary';
                                                @endphp
                                                <span class="status-badge {{ $docStatusClass }}">
                                                    {{ ucfirst($documento->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $tamanhoKB = $documento->tamanho ?? 0;
                                                    if ($tamanhoKB < 1024) {
                                                        $tamanhoFormatado = $tamanhoKB . ' KB';
                                                    } else {
                                                        $tamanhoFormatado =
                                                            number_format($tamanhoKB / 1024, 1, ',', '.') . ' MB';
                                                    }
                                                @endphp
                                                {{ $tamanhoFormatado }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    @if (Storage::exists($documento->caminho_arquivo))
                                                        <a href="{{ Storage::url($documento->caminho_arquivo) }}"
                                                            target="_blank" class="btn btn-sm btn-outline-primary"
                                                            title="Visualizar">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ Storage::url($documento->caminho_arquivo) }}"
                                                            download="{{ $documento->nome_arquivo }}"
                                                            class="btn btn-sm btn-outline-secondary" title="Download">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @endif
                                                    @if ($inscricao->status === 'pendente' && $documento->status === 'pendente')
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            title="Excluir" data-bs-toggle="modal"
                                                            data-bs-target="#deleteDocumentoModal{{ $documento->id }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>

                                                <!-- Delete Document Modal -->
                                                <div class="modal fade" id="deleteDocumentoModal{{ $documento->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Excluir Documento</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Tem certeza que deseja excluir o documento
                                                                    <strong>{{ $documento->nome_arquivo }}</strong>?</p>
                                                                <p class="text-danger"><small>Esta ação não pode ser
                                                                        desfeita.</small></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <form
                                                                    action="{{ route('aluno.documento.destroy', $documento->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Excluir</button>
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
                            <p class="text-muted mb-0">Nenhum documento enviado para esta inscrição.</p>
                            @if ($inscricao->status === 'pendente')
                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                                    data-bs-target="#adicionarDocumentoModal">
                                    <i class="bi bi-plus-circle me-2"></i>Adicionar Primeiro Documento
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Histórico de Status -->
        <div class="row">
            <div class="col-12">
                <div class="dashboard-card">
                    <h5 class="mb-4">Histórico da Inscrição</h5>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6>Inscrição Criada</h6>
                                <p class="text-muted mb-1">{{ date('d/m/Y H:i', strtotime($inscricao->data_inscricao)) }}
                                </p>
                                <p>Inscrição iniciada no sistema.</p>
                            </div>
                        </div>

                        @if ($inscricao->documentos && $inscricao->documentos->count() > 0)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6>Documentos Enviados</h6>
                                    <p class="text-muted mb-1">
                                        {{ $inscricao->documentos->first()->data_envio ? date('d/m/Y H:i', strtotime($inscricao->documentos->first()->data_envio)) : 'Data não disponível' }}
                                    </p>
                                    <p>{{ $inscricao->documentos->count() }} documento(s) anexado(s).</p>
                                </div>
                            </div>
                        @endif

                        @if ($inscricao->status === 'submetida' || $inscricao->status === 'em_analise')
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6>Enviada para Análise</h6>
                                    <p class="text-muted mb-1">Em análise</p>
                                    <p>Aguardando avaliação da secretaria.</p>
                                </div>
                            </div>
                        @endif

                        @if ($inscricao->data_avaliacao)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6>Avaliada</h6>
                                    <p class="text-muted mb-1">
                                        {{ date('d/m/Y H:i', strtotime($inscricao->data_avaliacao)) }}</p>
                                    <p>Avaliado por: {{ $inscricao->avaliador->nome ?? 'N/A' }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($inscricao->nota_teste)
                            <div class="timeline-item">
                                <div
                                    class="timeline-marker {{ $inscricao->resultado_teste === 'aprovado' ? 'bg-success' : 'bg-danger' }}">
                                </div>
                                <div class="timeline-content">
                                    <h6>Teste Realizado</h6>
                                    <p class="text-muted mb-1">{{ date('d/m/Y', strtotime($inscricao->data_teste)) }}</p>
                                    <p>Nota: {{ number_format($inscricao->nota_teste, 1, ',', '.') }} valores -
                                        {{ $inscricao->resultado_teste === 'aprovado' ? 'Aprovado' : 'Reprovado' }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($inscricao->data_conclusao)
                            <div class="timeline-item">
                                <div
                                    class="timeline-marker {{ $inscricao->status === 'aprovada' ? 'bg-success' : 'bg-danger' }}">
                                </div>
                                <div class="timeline-content">
                                    <h6>Concluída</h6>
                                    <p class="text-muted mb-1">{{ date('d/m/Y', strtotime($inscricao->data_conclusao)) }}
                                    </p>
                                    <p>Status final: {{ ucfirst($inscricao->status) }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Fazer Teste -->
    @if ($inscricao->status === 'aprovada' && !$inscricao->nota_teste)
        <div class="modal fade" id="testeModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Teste de Admissão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('aluno.inscricao.teste', $inscricao->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Digite sua nota do teste de admissão (0-20). Nota mínima para aprovação: 10 valores.
                            </div>
                            <div class="mb-3">
                                <label for="nota" class="form-label">Nota do Teste *</label>
                                <input type="number" class="form-control" id="nota" name="nota" min="0"
                                    max="20" step="0.1" required placeholder="Ex: 14.5">
                                <small class="text-muted">Valor entre 0 e 20</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Registrar Nota</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal para Adicionar Documento -->
    @if ($inscricao->status === 'pendente')
        <div class="modal fade" id="adicionarDocumentoModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar Documento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('aluno.inscricao.documento.store', $inscricao->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="tipo_documento" class="form-label">Tipo do Documento *</label>
                                <select class="form-select" id="tipo_documento" name="tipo" required>
                                    <option value="">Selecione o tipo</option>
                                    <option value="bi">Bilhete de Identidade</option>
                                    <option value="certificado">Certificado de Habilitações</option>
                                    <option value="fotografia">Fotografia 3x4</option>
                                    <option value="comprovativo">Comprovativo de Residência</option>
                                    <option value="declaracao">Declaração</option>
                                    <option value="outro">Outro Documento</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="documento_file" class="form-label">Arquivo *</label>
                                <input type="file" class="form-control" id="documento_file" name="documento"
                                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                                <small class="text-muted">Formatos: PDF, JPG, PNG, DOC, DOCX (Max: 5MB)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Enviar Documento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('css')
    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }

        .timeline-marker {
            position: absolute;
            left: -30px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 0 3px #dee2e6;
        }

        .timeline-content {
            padding-left: 20px;
            border-left: 2px solid #dee2e6;
            padding-bottom: 20px;
        }

        .timeline-item:last-child .timeline-content {
            border-left: 2px solid transparent;
            padding-bottom: 0;
        }

        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-info {
            background-color: #0dcaf0;
        }

        .badge-warning {
            background-color: #ffc107;
        }

        .badge-success {
            background-color: #198754;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-secondary {
            background-color: #6c757d;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Validação do modal de teste
        document.querySelector('#testeModal form')?.addEventListener('submit', function(e) {
            const nota = document.getElementById('nota').value;
            if (nota < 0 || nota > 20) {
                e.preventDefault();
                alert('A nota deve estar entre 0 e 20 valores.');
                return false;
            }
            return true;
        });

        // Validação do modal de documento
        document.querySelector('#adicionarDocumentoModal form')?.addEventListener('submit', function(e) {
            const fileInput = document.getElementById('documento_file');
            if (fileInput.files.length > 0) {
                const fileSize = fileInput.files[0].size / 1024 / 1024; // MB
                if (fileSize > 5) {
                    e.preventDefault();
                    alert('O arquivo excede o limite de 5MB.');
                    return false;
                }
            }
            return true;
        });
    </script>
@endsection
