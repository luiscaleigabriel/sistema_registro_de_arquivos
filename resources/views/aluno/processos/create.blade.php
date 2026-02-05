{{-- resources/views/aluno/processos/create.blade.php --}}
@extends('layouts.system')

@section('title', 'Criar Novo Processo')

@section('page-title', 'Criar Novo Processo')

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
                            <i class="bi bi-plus-circle me-2"></i>Criar Novo Processo
                        </h4>
                        <p class="text-muted mb-0">Preencha os dados para criar um novo processo acadêmico</p>
                    </div>

                    <div class="dashboard-card-body">
                        <form action="{{ route('aluno.processos.store') }}" method="POST" enctype="multipart/form-data"
                            id="processoForm">
                            @csrf

                            <!-- Informações do Aluno -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-person me-2"></i>Informações do Aluno
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->nome }}" readonly
                                            disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Número do Aluno</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->aluno->numero_aluno }}" readonly disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Curso</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->aluno->curso }}"
                                            readonly disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ano Letivo</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->aluno->ano_letivo }}" readonly disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Tipo do Processo -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-folder me-2"></i>Tipo do Processo
                                </h5>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="tipo" class="form-label required">Selecione o tipo de
                                            processo</label>
                                        <select class="form-select @error('tipo') is-invalid @enderror" id="tipo"
                                            name="tipo" required>
                                            <option value="">Selecione uma opção</option>
                                            <option value="admissao" {{ old('tipo') == 'admissao' ? 'selected' : '' }}>
                                                Admissão</option>
                                            <option value="matricula" {{ old('tipo') == 'matricula' ? 'selected' : '' }}>
                                                Matrícula/Renovação</option>
                                            <option value="transferencia"
                                                {{ old('tipo') == 'transferencia' ? 'selected' : '' }}>Transferência
                                            </option>
                                            <option value="certificado"
                                                {{ old('tipo') == 'certificado' ? 'selected' : '' }}>Certificação</option>
                                            <option value="bolsa" {{ old('tipo') == 'bolsa' ? 'selected' : '' }}>Bolsa de
                                                Estudo</option>
                                            <option value="declaracao" {{ old('tipo') == 'declaracao' ? 'selected' : '' }}>
                                                Declaração</option>
                                            <option value="outro" {{ old('tipo') == 'outro' ? 'selected' : '' }}>Outro
                                            </option>
                                        </select>
                                        @error('tipo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted mt-1 d-block">
                                            Selecione o tipo de processo que melhor descreve sua solicitação
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Descrição do Processo -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-text-paragraph me-2"></i>Descrição
                                </h5>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="descricao" class="form-label required">Descrição detalhada</label>
                                        <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="4"
                                            placeholder="Descreva detalhadamente o motivo do processo..." required>{{ old('descricao') }}</textarea>
                                        @error('descricao')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted mt-1 d-block">
                                            Seja específico. Inclua datas, referências e outras informações relevantes.
                                            <span id="charCount" class="float-end">0/500</span>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Documentos -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-paperclip me-2"></i>Documentos Anexados
                                </h5>
                                <div id="documentosContainer">
                                    <!-- Documento 1 -->
                                    <div class="documento-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label required">Tipo do Documento</label>
                                                <select class="form-select" name="tipo_documentos[]" required>
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
                                                <label class="form-label required">Arquivo</label>
                                                <input type="file" class="form-control" name="documentos[]"
                                                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                                                <small class="text-muted">Formatos: PDF, JPG, PNG, DOC, DOCX (Max:
                                                    5MB)</small>
                                            </div>
                                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    onclick="removeDocumento(this)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="addDocumento()">
                                    <i class="bi bi-plus-circle me-1"></i>Adicionar Outro Documento
                                </button>

                                <div class="alert alert-info mt-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Importante:</strong> Todos os documentos devem estar legíveis e atualizados.
                                    Processos com documentos incompletos serão rejeitados.
                                </div>
                            </div>

                            <!-- Taxa do Processo -->
                            <div class="mb-4">
                                <div class="alert alert-warning">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-exclamation-triangle fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="alert-heading">Taxa de Processo</h5>
                                            <p class="mb-1">Este processo está sujeito a uma taxa administrativa de
                                                <strong>5.000,00 kz</strong>.</p>
                                            <p class="mb-0">A taxa deve ser paga após a aprovação do processo.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botões -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('aluno.processos') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-2"></i>Criar Processo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Contador de caracteres da descrição
        document.getElementById('descricao').addEventListener('input', function() {
            const maxLength = 500;
            const currentLength = this.value.length;
            document.getElementById('charCount').textContent = currentLength + '/' + maxLength;

            if (currentLength > maxLength) {
                this.value = this.value.substring(0, maxLength);
                document.getElementById('charCount').textContent = maxLength + '/' + maxLength;
            }
        });

        // Contador de documentos
        let documentoCount = 1;

        function addDocumento() {
            documentoCount++;
            const container = document.getElementById('documentosContainer');
            const newDocumento = document.createElement('div');
            newDocumento.className = 'documento-item mb-3 p-3 border rounded';
            newDocumento.innerHTML = `
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Tipo do Documento</label>
                    <select class="form-select" name="tipo_documentos[]" required>
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
                    <label class="form-label required">Arquivo</label>
                    <input type="file" class="form-control" name="documentos[]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                    <small class="text-muted">Formatos: PDF, JPG, PNG, DOC, DOCX (Max: 5MB)</small>
                </div>
                <div class="col-md-1 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeDocumento(this)">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;
            container.appendChild(newDocumento);
        }

        function removeDocumento(button) {
            if (document.querySelectorAll('.documento-item').length > 1) {
                button.closest('.documento-item').remove();
            } else {
                alert('Pelo menos um documento é obrigatório.');
            }
        }

        // Validação do formulário
        document.getElementById('processoForm').addEventListener('submit', function(e) {
            const tipo = document.getElementById('tipo').value;
            const descricao = document.getElementById('descricao').value.trim();

            if (!tipo) {
                e.preventDefault();
                alert('Por favor, selecione o tipo do processo.');
                document.getElementById('tipo').focus();
                return;
            }

            if (!descricao || descricao.length < 10) {
                e.preventDefault();
                alert('Por favor, forneça uma descrição detalhada (mínimo 10 caracteres).');
                document.getElementById('descricao').focus();
                return;
            }

            // Validar arquivos
            const files = document.querySelectorAll('input[name="documentos[]"]');
            let hasFiles = false;
            files.forEach(fileInput => {
                if (fileInput.files.length > 0) {
                    hasFiles = true;
                    const fileSize = fileInput.files[0].size / 1024 / 1024; // MB
                    if (fileSize > 5) {
                        e.preventDefault();
                        alert('Um ou mais arquivos excedem o limite de 5MB.');
                        return;
                    }
                }
            });

            if (!hasFiles) {
                e.preventDefault();
                alert('Por favor, anexe pelo menos um documento.');
                return;
            }

            // Confirmar envio
            if (!confirm(
                'Tem certeza que deseja criar este processo? Verifique se todos os dados estão corretos.')) {
                e.preventDefault();
            }
        });

        // Inicializar contador
        document.addEventListener('DOMContentLoaded', function() {
            const descricao = document.getElementById('descricao');
            document.getElementById('charCount').textContent = descricao.value.length + '/500';
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
    </style>
@endsection
