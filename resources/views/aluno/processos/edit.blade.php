{{-- resources/views/aluno/processos/edit.blade.php --}}
@extends('layouts.system')

@section('title', 'Editar Processo')

@section('page-title', 'Editar Processo')

@section('sidebar-menu')
    @include('aluno.partials.menu')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square me-2"></i>Editar Processo
                        </h4>
                        <p class="text-muted mb-0">Processo: {{ $processo->num_processo }}</p>
                    </div>

                    <div class="dashboard-card-body">
                        @if ($processo->status !== 'aberto')
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Este processo já está em análise e não pode ser editado.
                                Status atual: <strong>{{ $processo->statusFormatado }}</strong>
                            </div>
                        @endif

                        <form action="{{ route('aluno.processos.update', $processo->id) }}" method="POST"
                            enctype="multipart/form-data" id="processoForm">
                            @csrf
                            @method('PUT')

                            <!-- Informações do Processo (somente leitura) -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informações do Processo
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Número do Processo</label>
                                        <input type="text" class="form-control" value="{{ $processo->num_processo }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" value="{{ $processo->statusFormatado }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Data de Abertura</label>
                                        <input type="text" class="form-control"
                                            value="{{ date('d/m/Y', strtotime($processo->data_abertura)) }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Taxa do Processo</label>
                                        <input type="text" class="form-control"
                                            value="{{ $processo->taxaProcessoFormatada }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Informações do Aluno (somente leitura) -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-person me-2"></i>Informações do Aluno
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->nome }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Número do Aluno</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->aluno->numero_aluno }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Curso</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->aluno->curso }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ano Letivo</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->aluno->ano_letivo }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Tipo do Processo (editável apenas se aberto) -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-folder me-2"></i>Tipo do Processo
                                </h5>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="tipo" class="form-label required">Tipo de processo</label>
                                        @if ($processo->status === 'aberto')
                                            <select class="form-select @error('tipo') is-invalid @enderror" id="tipo"
                                                name="tipo" required
                                                {{ $processo->status !== 'aberto' ? 'disabled' : '' }}>
                                                <option value="">Selecione uma opção</option>
                                                <option value="admissao"
                                                    {{ old('tipo', $processo->tipo) == 'admissao' ? 'selected' : '' }}>
                                                    Admissão</option>
                                                <option value="matricula"
                                                    {{ old('tipo', $processo->tipo) == 'matricula' ? 'selected' : '' }}>
                                                    Matrícula/Renovação</option>
                                                <option value="transferencia"
                                                    {{ old('tipo', $processo->tipo) == 'transferencia' ? 'selected' : '' }}>
                                                    Transferência</option>
                                                <option value="certificado"
                                                    {{ old('tipo', $processo->tipo) == 'certificado' ? 'selected' : '' }}>
                                                    Certificação</option>
                                                <option value="bolsa"
                                                    {{ old('tipo', $processo->tipo) == 'bolsa' ? 'selected' : '' }}>Bolsa
                                                    de Estudo</option>
                                                <option value="declaracao"
                                                    {{ old('tipo', $processo->tipo) == 'declaracao' ? 'selected' : '' }}>
                                                    Declaração</option>
                                                <option value="outro"
                                                    {{ old('tipo', $processo->tipo) == 'outro' ? 'selected' : '' }}>Outro
                                                </option>
                                            </select>
                                            @error('tipo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @else
                                            <input type="text" class="form-control"
                                                value="{{ $processo->tipoFormatado }}" readonly>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Descrição do Processo (editável apenas se aberto) -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-text-paragraph me-2"></i>Descrição
                                </h5>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="descricao" class="form-label required">Descrição detalhada</label>
                                        @if ($processo->status === 'aberto')
                                            <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="4"
                                                placeholder="Descreva detalhadamente o motivo do processo..." required
                                                {{ $processo->status !== 'aberto' ? 'disabled' : '' }}>{{ old('descricao', $processo->descricao) }}</textarea>
                                            @error('descricao')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted mt-1 d-block">
                                                Seja específico. Inclua datas, referências e outras informações relevantes.
                                                <span id="charCount"
                                                    class="float-end">{{ strlen(old('descricao', $processo->descricao)) }}/500</span>
                                            </small>
                                        @else
                                            <div class="border rounded p-3 bg-light">
                                                {{ $processo->descricao }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Documentos Existentes -->
                            @if ($processo->documentos->count() > 0)
                                <div class="mb-4">
                                    <h5 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-paperclip me-2"></i>Documentos Anexados
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>Nome do Arquivo</th>
                                                    <th>Data Envio</th>
                                                    <th>Status</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($processo->documentos as $documento)
                                                    <tr>
                                                        <td>{{ $documento->tipoFormatado }}</td>
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
                                                                {{ $documento->statusFormatado }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="{{ route('aluno.documento.download', $documento->id) }}"
                                                                    class="btn btn-sm btn-outline-primary"
                                                                    title="Download">
                                                                    <i class="bi bi-download"></i>
                                                                </a>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            <!-- Adicionar Novos Documentos (apenas se processo aberto) -->
                            @if ($processo->status === 'aberto')
                                <div class="mb-4">
                                    <h5 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-cloud-upload me-2"></i>Adicionar Novos Documentos
                                    </h5>
                                    <div id="novosDocumentosContainer">
                                        <!-- Novo Documento 1 -->
                                        <div class="documento-item mb-3 p-3 border rounded">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Tipo do Documento</label>
                                                    <select class="form-select" name="novos_tipos_documentos[]">
                                                        <option value="">Selecione</option>
                                                        <option value="bi">Bilhete de Identidade</option>
                                                        <option value="certificado">Certificado</option>
                                                        <option value="historico">Histórico Acadêmico</option>
                                                        <option value="declaracao">Declaração</option>
                                                        <option value="foto">Fotografia</option>
                                                        <option value="comprovativo">Comprovativo</option>
                                                        <option value="contrato">Contrato</option>
                                                        <option value="outro">Outro</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                    <label class="form-label">Arquivo</label>
                                                    <input type="file" class="form-control" name="novos_documentos[]"
                                                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                    <small class="text-muted">Formatos: PDF, JPG, PNG, DOC, DOCX (Max:
                                                        5MB)</small>
                                                </div>
                                                <div class="col-md-1 mb-3 d-flex align-items-end">
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        onclick="removeNovoDocumento(this)">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                        onclick="addNovoDocumento()">
                                        <i class="bi bi-plus-circle me-1"></i>Adicionar Outro Documento
                                    </button>

                                    <div class="alert alert-info mt-3">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Você pode adicionar novos documentos ou remover documentos pendentes.
                                        Documentos já validados não podem ser removidos.
                                    </div>
                                </div>
                            @endif

                            <!-- Observações da Análise (se houver) -->
                            @if ($processo->observacoes_analise)
                                <div class="mb-4">
                                    <h5 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-chat-left-text me-2"></i>Observações da Análise
                                    </h5>
                                    <div class="border rounded p-3 bg-light">
                                        {{ $processo->observacoes_analise }}
                                    </div>
                                </div>
                            @endif

                            <!-- Botões -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('aluno.processo.view', $processo->id) }}"
                                    class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Voltar
                                </a>

                                @if ($processo->status === 'aberto')
                                    <div class="btn-group" role="group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-2"></i>Salvar Alterações
                                        </button>

                                        @if ($processo->documentos->where('status', 'pendente')->count() === 0)
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#finalizarModal">
                                                <i class="bi bi-send me-2"></i>Finalizar e Enviar
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Finalizar Processo -->
    @if ($processo->status === 'aberto')
        <div class="modal fade" id="finalizarModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Finalizar Processo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Você está prestes a finalizar e enviar este processo para análise.</p>
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Atenção:</strong> Após enviar, você não poderá mais editar o processo.
                            Verifique se todas as informações estão corretas.
                        </div>
                        <p>Confirma o envio do processo <strong>{{ $processo->num_processo }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('aluno.processos.finalizar', $processo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Sim, Enviar para Análise</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        // Contador de caracteres da descrição
        document.getElementById('descricao')?.addEventListener('input', function() {
            const maxLength = 500;
            const currentLength = this.value.length;
            document.getElementById('charCount').textContent = currentLength + '/' + maxLength;

            if (currentLength > maxLength) {
                this.value = this.value.substring(0, maxLength);
                document.getElementById('charCount').textContent = maxLength + '/' + maxLength;
            }
        });

        // Contador de novos documentos
        let novoDocumentoCount = 1;

        function addNovoDocumento() {
            novoDocumentoCount++;
            const container = document.getElementById('novosDocumentosContainer');
            const newDocumento = document.createElement('div');
            newDocumento.className = 'documento-item mb-3 p-3 border rounded';
            newDocumento.innerHTML = `
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo do Documento</label>
                    <select class="form-select" name="novos_tipos_documentos[]">
                        <option value="">Selecione</option>
                        <option value="bi">Bilhete de Identidade</option>
                        <option value="certificado">Certificado</option>
                        <option value="historico">Histórico Acadêmico</option>
                        <option value="declaracao">Declaração</option>
                        <option value="foto">Fotografia</option>
                        <option value="comprovativo">Comprovativo</option>
                        <option value="contrato">Contrato</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="col-md-7 mb-3">
                    <label class="form-label">Arquivo</label>
                    <input type="file" class="form-control" name="novos_documentos[]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                    <small class="text-muted">Formatos: PDF, JPG, PNG, DOC, DOCX (Max: 5MB)</small>
                </div>
                <div class="col-md-1 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeNovoDocumento(this)">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;
            container.appendChild(newDocumento);
        }

        function removeNovoDocumento(button) {
            if (document.querySelectorAll('#novosDocumentosContainer .documento-item').length > 1) {
                button.closest('.documento-item').remove();
            } else {
                alert('Pelo menos um campo de documento deve permanecer.');
            }
        }

        // Validação do formulário
        document.getElementById('processoForm')?.addEventListener('submit', function(e) {
            const tipo = document.getElementById('tipo')?.value;
            const descricao = document.getElementById('descricao')?.value.trim();

            if (tipo && !tipo) {
                e.preventDefault();
                alert('Por favor, selecione o tipo do processo.');
                document.getElementById('tipo').focus();
                return;
            }

            if (descricao && (!descricao || descricao.length < 10)) {
                e.preventDefault();
                alert('Por favor, forneça uma descrição detalhada (mínimo 10 caracteres).');
                document.getElementById('descricao').focus();
                return;
            }

            // Validar novos arquivos
            const files = document.querySelectorAll('input[name="novos_documentos[]"]');
            files.forEach(fileInput => {
                if (fileInput.files.length > 0) {
                    const fileSize = fileInput.files[0].size / 1024 / 1024; // MB
                    if (fileSize > 5) {
                        e.preventDefault();
                        alert('Um ou mais arquivos excedem o limite de 5MB.');
                        return;
                    }

                    // Verificar se o tipo foi selecionado
                    const tipoSelect = fileInput.closest('.documento-item').querySelector(
                        'select[name="novos_tipos_documentos[]"]');
                    if (!tipoSelect.value) {
                        e.preventDefault();
                        alert('Por favor, selecione o tipo para todos os documentos anexados.');
                        tipoSelect.focus();
                        return;
                    }
                }
            });

            // Confirmar envio
            if (!confirm('Tem certeza que deseja salvar as alterações?')) {
                e.preventDefault();
            }
        });

        // Inicializar contador
        document.addEventListener('DOMContentLoaded', function() {
            const descricao = document.getElementById('descricao');
            if (descricao) {
                document.getElementById('charCount').textContent = descricao.value.length + '/500';
            }
        });
    </script>

    <style>
        .required:after {
            content: " *";
            color: #dc3545;
        }

        .documento-item {
            background-color: #f8f9fa;
        }

        .documento-item:hover {
            background-color: #f0f2f5;
        }

        .custom-table th {
            background-color: #f8f9fa;
            border-top: none;
        }
    </style>
@endsection
