<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/inscricao.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/js/inscricao.js') }}"></script>
    <script></script>
@endsection

<div>

    <livewire:partials.header />

    <!-- Hero Section Inscrição -->
    <section class="hero-inscricao py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-primary mb-4">
                        Faça Sua <span class="text-secondary">Inscrição</span>
                    </h1>
                    <p class="lead mb-4">
                        Complete seu cadastro online e dê o primeiro passo rumo ao seu futuro profissional.
                    </p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            <i class="bi bi-shield-check fs-1 text-success"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Processo 100% Seguro</h5>
                            <p class="text-muted mb-0">Seus dados são protegidos e não serão compartilhados</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4">
                            <div class="progress mb-4">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    Passo 1 de 4
                                </div>
                            </div>

                            <div class="steps">
                                <div class="step active">
                                    <span class="step-number">1</span>
                                    <span class="step-label">Dados Pessoais</span>
                                </div>
                                <div class="step">
                                    <span class="step-number">2</span>
                                    <span class="step-label">Curso Escolhido</span>
                                </div>
                                <div class="step">
                                    <span class="step-number">3</span>
                                    <span class="step-label">Documentos</span>
                                </div>
                                <div class="step">
                                    <span class="step-number">4</span>
                                    <span class="step-label">Confirmação</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulário de Inscrição -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="fw-bold mb-0">
                                <i class="bi bi-person-plus me-2"></i>
                                Formulário de Inscrição
                            </h4>
                        </div>

                        <div class="card-body p-4">
                            <form id="inscricaoForm" novalidate>
                                <!-- Passo 1: Dados Pessoais -->
                                <div class="form-step active" id="step1">
                                    <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">
                                        <i class="bi bi-person-circle me-2"></i>
                                        Dados Pessoais
                                    </h5>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nomeCompleto"
                                                    placeholder="Nome Completo" required>
                                                <label for="nomeCompleto">Nome Completo *</label>
                                                <div class="invalid-feedback">
                                                    Por favor, informe seu nome completo.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Email" required>
                                                <label for="email">Email *</label>
                                                <div class="invalid-feedback">
                                                    Por favor, informe um email válido.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="tel" class="form-control" id="telefone"
                                                    placeholder="Telefone" required>
                                                <label for="telefone">Telefone *</label>
                                                <div class="invalid-feedback">
                                                    Por favor, informe seu telefone.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="dataNascimento" required>
                                                <label for="dataNascimento">Data de Nascimento *</label>
                                                <div class="invalid-feedback">
                                                    Por favor, informe sua data de nascimento.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="bi"
                                                    placeholder="Bilhete de Identidade" required>
                                                <label for="bi">Bilhete de Identidade *</label>
                                                <div class="invalid-feedback">
                                                    Por favor, informe seu BI.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="genero" required>
                                                    <option value="" selected disabled>Selecione...</option>
                                                    <option value="masculino">Masculino</option>
                                                    <option value="feminino">Feminino</option>
                                                    <option value="outro">Outro</option>
                                                    <option value="prefiro-nao-dizer">Prefiro não dizer</option>
                                                </select>
                                                <label for="genero">Gênero *</label>
                                                <div class="invalid-feedback">
                                                    Por favor, selecione seu gênero.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="morada" placeholder="Morada Completa" style="height: 100px" required></textarea>
                                                <label for="morada">Morada Completa *</label>
                                                <div class="invalid-feedback">
                                                    Por favor, informe sua morada completa.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="senha"
                                                    placeholder="Senha" required minlength="6">
                                                <label for="senha">Senha *</label>
                                                <div class="invalid-feedback">
                                                    A senha deve ter pelo menos 6 caracteres.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="confirmarSenha"
                                                    placeholder="Confirmar Senha" required>
                                                <label for="confirmarSenha">Confirmar Senha *</label>
                                                <div class="invalid-feedback">
                                                    As senhas não coincidem.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="button" class="btn btn-primary btn-next" data-next="step2">
                                            Próximo <i class="bi bi-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Passo 2: Curso Escolhido -->
                                <div class="form-step" id="step2">
                                    <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">
                                        <i class="bi bi-book me-2"></i>
                                        Escolha do Curso
                                    </h5>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100 border">
                                                <div class="card-body">
                                                    <h6 class="fw-bold mb-3">Selecione o Curso</h6>
                                                    <div class="mb-3">
                                                        <select class="form-select" id="curso" required>
                                                            <option value="" selected disabled>Selecione um
                                                                curso...</option>
                                                            <option value="informatica">Informática</option>
                                                            <option value="mecanica">Mecânica Industrial</option>
                                                            <option value="construcao">Construção Civil</option>
                                                            <option value="eletronica">Electrónica</option>
                                                            <option value="gestao">Gestão Empresarial</option>
                                                            <option value="enfermagem">Enfermagem</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Por favor, selecione um curso.
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Período Preferencial</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="periodo" id="diurno" value="diurno"
                                                                required>
                                                            <label class="form-check-label" for="diurno">
                                                                Diurno (8h - 17h)
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="periodo" id="noturno" value="noturno">
                                                            <label class="form-check-label" for="noturno">
                                                                Noturno (18h - 22h)
                                                            </label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Por favor, selecione um período.
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Ano de Ingresso</label>
                                                        <select class="form-select" id="anoIngresso" required>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100 border">
                                                <div class="card-body">
                                                    <h6 class="fw-bold mb-3">Informações Académicas</h6>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Nível de Escolaridade
                                                            *</label>
                                                        <select class="form-select" id="escolaridade" required>
                                                            <option value="" selected disabled>Selecione...
                                                            </option>
                                                            <option value="ensino-medio">Ensino Médio Completo</option>
                                                            <option value="ensino-medio-cursando">Ensino Médio Cursando
                                                            </option>
                                                            <option value="superior">Superior Completo</option>
                                                            <option value="superior-cursando">Superior Cursando
                                                            </option>
                                                            <option value="outro">Outro</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Por favor, selecione seu nível de escolaridade.
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control"
                                                                id="escolaAnterior" placeholder="Escola Anterior">
                                                            <label for="escolaAnterior">Escola Anterior
                                                                (Opcional)</label>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Como ficou sabendo do
                                                            Instituto?</label>
                                                        <select class="form-select" id="comoFicouSabendo">
                                                            <option value="" selected>Selecione...</option>
                                                            <option value="internet">Internet/Redes Sociais</option>
                                                            <option value="amigos">Amigos/Conhecidos</option>
                                                            <option value="panfleto">Panfleto/Outdoor</option>
                                                            <option value="jornal">Jornal/Revista</option>
                                                            <option value="radio-tv">Rádio/TV</option>
                                                            <option value="outro">Outro</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-primary btn-prev"
                                            data-prev="step1">
                                            <i class="bi bi-arrow-left me-2"></i>Voltar
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next" data-next="step3">
                                            Próximo <i class="bi bi-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Passo 3: Documentos -->
                                <div class="form-step" id="step3">
                                    <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">
                                        <i class="bi bi-folder me-2"></i>
                                        Upload de Documentos
                                    </h5>

                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Todos os documentos devem ser digitalizados em PDF ou imagem (JPG/PNG).
                                        Tamanho máximo por arquivo: 5MB.
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="document-upload">
                                                <div class="document-header">
                                                    <h6 class="fw-bold mb-0">Bilhete de Identidade (BI)</h6>
                                                    <span class="badge bg-danger">Obrigatório</span>
                                                </div>
                                                <p class="text-muted small mb-2">Frente e verso digitalizados</p>
                                                <div class="dropzone" id="biDropzone">
                                                    <div class="dropzone-content">
                                                        <i class="bi bi-upload fs-1 text-primary"></i>
                                                        <p class="mt-2 mb-1">Arraste ou clique para enviar</p>
                                                        <p class="small text-muted">PDF, JPG ou PNG (max. 5MB)</p>
                                                    </div>
                                                    <input type="file" class="d-none" id="biFile"
                                                        accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                                <div class="document-preview mt-2" id="biPreview"></div>
                                                <div class="invalid-feedback">
                                                    Por favor, envie uma cópia do seu BI.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="document-upload">
                                                <div class="document-header">
                                                    <h6 class="fw-bold mb-0">Certificado de Habilitações</h6>
                                                    <span class="badge bg-danger">Obrigatório</span>
                                                </div>
                                                <p class="text-muted small mb-2">Certificado do ensino médio ou
                                                    equivalente</p>
                                                <div class="dropzone" id="certificadoDropzone">
                                                    <div class="dropzone-content">
                                                        <i class="bi bi-upload fs-1 text-primary"></i>
                                                        <p class="mt-2 mb-1">Arraste ou clique para enviar</p>
                                                        <p class="small text-muted">PDF, JPG ou PNG (max. 5MB)</p>
                                                    </div>
                                                    <input type="file" class="d-none" id="certificadoFile"
                                                        accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                                <div class="document-preview mt-2" id="certificadoPreview"></div>
                                                <div class="invalid-feedback">
                                                    Por favor, envie seu certificado de habilitações.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="document-upload">
                                                <div class="document-header">
                                                    <h6 class="fw-bold mb-0">Atestado Médico</h6>
                                                    <span class="badge bg-warning">Recomendado</span>
                                                </div>
                                                <p class="text-muted small mb-2">Atestado de boa saúde física</p>
                                                <div class="dropzone" id="atestadoDropzone">
                                                    <div class="dropzone-content">
                                                        <i class="bi bi-upload fs-1 text-primary"></i>
                                                        <p class="mt-2 mb-1">Arraste ou clique para enviar</p>
                                                        <p class="small text-muted">PDF, JPG ou PNG (max. 5MB)</p>
                                                    </div>
                                                    <input type="file" class="d-none" id="atestadoFile"
                                                        accept=".pdf,.jpg,.jpeg,.png">
                                                </div>
                                                <div class="document-preview mt-2" id="atestadoPreview"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="document-upload">
                                                <div class="document-header">
                                                    <h6 class="fw-bold mb-0">Outros Documentos</h6>
                                                    <span class="badge bg-info">Opcional</span>
                                                </div>
                                                <p class="text-muted small mb-2">Histórico escolar, comprovantes, etc.
                                                </p>
                                                <div class="dropzone" id="outrosDropzone">
                                                    <div class="dropzone-content">
                                                        <i class="bi bi-upload fs-1 text-primary"></i>
                                                        <p class="mt-2 mb-1">Arraste ou clique para enviar</p>
                                                        <p class="small text-muted">PDF, JPG ou PNG (max. 5MB)</p>
                                                    </div>
                                                    <input type="file" class="d-none" id="outrosFile"
                                                        accept=".pdf,.jpg,.jpeg,.png" multiple>
                                                </div>
                                                <div class="document-preview mt-2" id="outrosPreview"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="declaracao" required>
                                            <label class="form-check-label" for="declaracao">
                                                Declaro que todas as informações fornecidas são verdadeiras e
                                                que os documentos enviados são autênticos. *
                                            </label>
                                            <div class="invalid-feedback">
                                                Você deve aceitar a declaração para continuar.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-primary btn-prev"
                                            data-prev="step2">
                                            <i class="bi bi-arrow-left me-2"></i>Voltar
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next" data-next="step4">
                                            Próximo <i class="bi bi-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Passo 4: Confirmação -->
                                <div class="form-step" id="step4">
                                    <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Confirmação de Inscrição
                                    </h5>

                                    <div class="alert alert-success">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                                            <div>
                                                <h5 class="alert-heading fw-bold">Inscrição Completa!</h5>
                                                <p class="mb-0">Revise todas as informações antes de finalizar.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-4">
                                                <div class="card-header bg-light">
                                                    <h6 class="fw-bold mb-0">Dados Pessoais</h6>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <th>Nome:</th>
                                                            <td id="reviewNome"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email:</th>
                                                            <td id="reviewEmail"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Telefone:</th>
                                                            <td id="reviewTelefone"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>BI:</th>
                                                            <td id="reviewBI"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Morada:</th>
                                                            <td id="reviewMorada"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card mb-4">
                                                <div class="card-header bg-light">
                                                    <h6 class="fw-bold mb-0">Informações Académicas</h6>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <th>Curso:</th>
                                                            <td id="reviewCurso"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Período:</th>
                                                            <td id="reviewPeriodo"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Escolaridade:</th>
                                                            <td id="reviewEscolaridade"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Ano Ingresso:</th>
                                                            <td id="reviewAno"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h6 class="fw-bold mb-0">Documentos Enviados</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="reviewDocumentos"></div>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        <strong>Atenção:</strong> Após o envio, você será redirecionado para realizar o
                                        <strong>Teste de Admissão Online</strong>. O resultado do teste será
                                        disponibilizado
                                        em até 48 horas no seu painel do aluno.
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-primary btn-prev"
                                            data-prev="step3">
                                            <i class="bi bi-arrow-left me-2"></i>Voltar
                                        </button>
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-check-circle me-2"></i>Finalizar Inscrição
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Informações Importantes -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-primary mb-4">
                                <i class="bi bi-info-circle me-2"></i>
                                Informações Importantes
                            </h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="bi bi-calendar-check text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold">Prazo de Inscrição</h6>
                                            <p class="text-muted mb-0">As inscrições estão abertas até 15 de Março de
                                                2024.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="bi bi-cash-coin text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold">Taxa de Inscrição</h6>
                                            <p class="text-muted mb-0">Isento de taxa para o primeiro semestre de 2024.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="bi bi-clock text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold">Processamento</h6>
                                            <p class="text-muted mb-0">Análise da inscrição em até 5 dias úteis.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="bi bi-headset text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold">Suporte</h6>
                                            <p class="text-muted mb-0">Dúvidas? Contacte-nos:
                                                inscricoes@instituto30setembro.ao</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Sucesso -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle me-2"></i>Inscrição Realizada!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Parabéns!</h4>
                    <p class="mb-4">
                        Sua inscrição foi realizada com sucesso. Um email de confirmação foi enviado para
                        <strong id="confirmationEmail"></strong>.
                    </p>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Próximo Passo:</strong> Realize o Teste de Admissão Online para completar seu processo.
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="teste.html" class="btn btn-primary btn-lg">
                        <i class="bi bi-pencil-square me-2"></i>Realizar Teste
                    </a>
                    <a href="index.html" class="btn btn-outline-primary">
                        Voltar ao Início
                    </a>
                </div>
            </div>
        </div>
    </div>

    <livewire:partials.footer />

</div>
