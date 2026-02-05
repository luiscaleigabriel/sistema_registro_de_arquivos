@extends('layouts.system')

@section('title', 'Nova Inscrição')

@section('page-title', 'Nova Inscrição')

@section('sidebar-menu')
@include('aluno.partials.menu')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="dashboard-card">
                <h3 class="mb-4">Nova Inscrição Acadêmica</h3>

                <form method="POST" action="{{ route('aluno.inscricao.store') }}" enctype="multipart/form-data" id="inscricaoForm">
                    @csrf

                    <!-- Progress Steps -->
                    <div class="mb-5">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" role="progressbar" id="progressBar" style="width: 33%"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="text-center">
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-1"
                                     style="width: 30px; height: 30px;">1</div>
                                <small>Informações</small>
                            </div>
                            <div class="text-center">
                                <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center mb-1"
                                     style="width: 30px; height: 30px;">2</div>
                                <small>Documentos</small>
                            </div>
                            <div class="text-center">
                                <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center mb-1"
                                     style="width: 30px; height: 30px;">3</div>
                                <small>Revisão</small>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Informações -->
                    <div id="step1">
                        <h5 class="mb-4">Informações da Inscrição</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tipo_inscricao" class="form-label">Tipo de Inscrição *</label>
                                <select class="form-select" id="tipo_inscricao" name="tipo_inscricao" required>
                                    <option value="">Selecione o tipo</option>
                                    <option value="regular">Inscrição Regular</option>
                                    <option value="reinscricao">Reinscrição</option>
                                    <option value="transferencia">Transferência</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="curso" class="form-label">Curso *</label>
                                <select class="form-select" id="curso" name="curso" required>
                                    <option value="">Selecione o curso</option>
                                    @foreach($cursos as $curso)
                                    <option value="{{ $curso }}" {{ $aluno->curso == $curso ? 'selected' : '' }}>
                                        {{ $curso }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="ano_letivo" class="form-label">Ano Letivo *</label>
                                <select class="form-select" id="ano_letivo" name="ano_letivo" required>
                                    <option value="">Selecione o ano</option>
                                    @for($i = date('Y'); $i <= date('Y') + 2; $i++)
                                    <option value="{{ $i }}/{{ $i + 1 }}" {{ $aluno->ano_letivo == $i . '/' . ($i + 1) ? 'selected' : '' }}>
                                        {{ $i }}/{{ $i + 1 }}
                                    </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Taxa de Inscrição</label>
                                <div class="input-group">
                                    <span class="input-group-text">Kz</span>
                                    <input type="text" class="form-control" id="taxa" value="10.000,00" readonly>
                                    <span class="input-group-text">Regular</span>
                                </div>
                                <small class="text-muted">Valor para inscrição regular</small>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Após preencher estas informações, você poderá enviar os documentos necessários.
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('aluno.inscricoes') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="button" class="btn btn-primary" onclick="nextStep()">
                                Próximo <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Documentos -->
                    <div id="step2" style="display: none;">
                        <h5 class="mb-4">Documentos Necessários</h5>

                        <div class="alert alert-warning mb-4">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Atenção:</strong> Os seguintes documentos são obrigatórios para inscrição regular:
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3 text-center h-100">
                                    <i class="bi bi-file-text display-4 text-primary mb-3"></i>
                                    <h6>Bilhete de Identidade</h6>
                                    <small class="text-muted">Frente e verso digitalizados</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3 text-center h-100">
                                    <i class="bi bi-award display-4 text-success mb-3"></i>
                                    <h6>Certificado de Habilitações</h6>
                                    <small class="text-muted">Último certificado obtido</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3 text-center h-100">
                                    <i class="bi bi-person-badge display-4 text-warning mb-3"></i>
                                    <h6>Fotografia 3x4</h6>
                                    <small class="text-muted">Fotografia tipo passe</small>
                                </div>
                            </div>
                        </div>

                        <div id="documentosContainer">
                            <div class="documento-item mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">Tipo de Documento *</label>
                                                <select class="form-select tipo-documento" name="tipo_documentos[]" required>
                                                    <option value="">Selecione o tipo</option>
                                                    <option value="bi">Bilhete de Identidade</option>
                                                    <option value="certificado">Certificado de Habilitações</option>
                                                    <option value="fotografia">Fotografia 3x4</option>
                                                    <option value="comprovativo">Comprovativo de Residência</option>
                                                    <option value="declaracao">Declaração</option>
                                                    <option value="outro">Outro Documento</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label">Arquivo *</label>
                                                <input type="file" class="form-control" name="documentos[]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                                                <small class="text-muted">Formatos: PDF, JPG, PNG, DOC (max: 5MB)</small>
                                            </div>
                                            <div class="col-md-2 mb-2 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger w-100" onclick="removeDocumento(this)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="button" class="btn btn-outline-primary" onclick="addDocumento()">
                                <i class="bi bi-plus-circle me-2"></i>Adicionar Outro Documento
                            </button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="prevStep()">
                                <i class="bi bi-arrow-left me-2"></i>Voltar
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextStep()">
                                Próximo <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Revisão -->
                    <div id="step3" style="display: none;">
                        <h5 class="mb-4">Revisão e Confirmação</h5>

                        <div class="alert alert-success mb-4">
                            <i class="bi bi-check-circle me-2"></i>
                            <strong>Pronto para enviar!</strong> Revise as informações abaixo antes de submeter sua inscrição.
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Resumo da Inscrição</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="150">Tipo:</th>
                                                <td id="reviewTipo">-</td>
                                            </tr>
                                            <tr>
                                                <th>Curso:</th>
                                                <td id="reviewCurso">-</td>
                                            </tr>
                                            <tr>
                                                <th>Ano Letivo:</th>
                                                <td id="reviewAno">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="150">Taxa:</th>
                                                <td id="reviewTaxa">-</td>
                                            </tr>
                                            <tr>
                                                <th>Documentos:</th>
                                                <td id="reviewDocumentos">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="confirmacao" required>
                            <label class="form-check-label" for="confirmacao">
                                Declaro que as informações fornecidas são verdadeiras e que compreendo os termos da inscrição.
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="prevStep()">
                                <i class="bi bi-arrow-left me-2"></i>Voltar
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-2"></i>Confirmar Inscrição
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
let currentStep = 1;
const totalSteps = 3;

function updateProgress() {
    const progress = (currentStep / totalSteps) * 100;
    document.getElementById('progressBar').style.width = `${progress}%`;

    // Update step indicators
    for (let i = 1; i <= totalSteps; i++) {
        const indicator = document.querySelector(`.d-flex > div:nth-child(${i}) .rounded-circle`);
        if (i < currentStep) {
            indicator.classList.remove('bg-secondary');
            indicator.classList.add('bg-primary');
        } else if (i === currentStep) {
            indicator.classList.remove('bg-secondary');
            indicator.classList.add('bg-primary');
        } else {
            indicator.classList.remove('bg-primary');
            indicator.classList.add('bg-secondary');
        }
    }
}

function showStep(step) {
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById(`step${i}`).style.display = i === step ? 'block' : 'none';
    }
    currentStep = step;
    updateProgress();
}

function nextStep() {
    if (currentStep < totalSteps) {
        if (validateStep(currentStep)) {
            if (currentStep === 1) {
                updateReview();
            }
            showStep(currentStep + 1);
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        showStep(currentStep - 1);
    }
}

function validateStep(step) {
    if (step === 1) {
        const tipo = document.getElementById('tipo_inscricao').value;
        const curso = document.getElementById('curso').value;
        const ano = document.getElementById('ano_letivo').value;

        if (!tipo || !curso || !ano) {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return false;
        }
        return true;
    }

    if (step === 2) {
        const documentos = document.querySelectorAll('input[name="documentos[]"]');
        let hasFiles = false;

        documentos.forEach(doc => {
            if (doc.files.length > 0) {
                hasFiles = true;
            }
        });

        if (!hasFiles) {
            alert('Por favor, adicione pelo menos um documento.');
            return false;
        }
        return true;
    }

    return true;
}

function updateReview() {
    document.getElementById('reviewTipo').textContent =
        document.getElementById('tipo_inscricao').options[document.getElementById('tipo_inscricao').selectedIndex].text;
    document.getElementById('reviewCurso').textContent =
        document.getElementById('curso').options[document.getElementById('curso').selectedIndex].text;
    document.getElementById('reviewAno').textContent =
        document.getElementById('ano_letivo').options[document.getElementById('ano_letivo').selectedIndex].text;
    document.getElementById('reviewTaxa').textContent = document.getElementById('taxa').value;

    const tipos = document.querySelectorAll('.tipo-documento');
    const documentosCount = Array.from(tipos).filter(t => t.value).length;
    document.getElementById('reviewDocumentos').textContent = `${documentosCount} documento(s) anexado(s)`;
}

function addDocumento() {
    const container = document.getElementById('documentosContainer');
    const newItem = document.createElement('div');
    newItem.className = 'documento-item mb-3';
    newItem.innerHTML = `
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Tipo de Documento *</label>
                        <select class="form-select tipo-documento" name="tipo_documentos[]" required>
                            <option value="">Selecione o tipo</option>
                            <option value="bi">Bilhete de Identidade</option>
                            <option value="certificado">Certificado de Habilitações</option>
                            <option value="fotografia">Fotografia 3x4</option>
                            <option value="comprovativo">Comprovativo de Residência</option>
                            <option value="declaracao">Declaração</option>
                            <option value="outro">Outro Documento</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Arquivo *</label>
                        <input type="file" class="form-control" name="documentos[]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                        <small class="text-muted">Formatos: PDF, JPG, PNG, DOC (max: 5MB)</small>
                    </div>
                    <div class="col-md-2 mb-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger w-100" onclick="removeDocumento(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    container.appendChild(newItem);
}

function removeDocumento(button) {
    const item = button.closest('.documento-item');
    if (document.querySelectorAll('.documento-item').length > 1) {
        item.remove();
    } else {
        // Reset first item instead of removing
        item.querySelector('.tipo-documento').value = '';
        item.querySelector('input[type="file"]').value = '';
    }
}

// Update tax based on inscrição type
document.getElementById('tipo_inscricao').addEventListener('change', function() {
    const taxaInput = document.getElementById('taxa');
    switch(this.value) {
        case 'regular':
            taxaInput.value = '10.000,00';
            break;
        case 'reinscricao':
            taxaInput.value = '5.000,00';
            break;
        case 'transferencia':
            taxaInput.value = '7.500,00';
            break;
        default:
            taxaInput.value = '0,00';
    }
});

// Initialize
updateProgress();
</script>
@endsection
