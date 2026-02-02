@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection
<div>
    <livewire:pages::student.partials.sidebar />

    <!-- Main Content -->
    <div class="main-content">
        <livewire:pages::student.partials.header />

        <!-- Conteúdo Principal -->
        <main class="content-wrapper">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
            </nav>

            <!-- Cards de Resumo -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Status Geral</h6>
                                    <h4 class="fw-bold mb-0">
                                        <span class="text-warning"
                                            id="statusText">{{ Auth::user()->get_inscricao()->first()->status }}</span>
                                    </h4>
                                </div>
                                <div class="stat-icon">
                                    <i class="bi bi-clipboard-data text-warning"></i>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height: 5px;">
                                <div class="progress-bar bg-warning" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Documentos</h6>
                                    <h4 class="fw-bold mb-0">
                                        <span id="docCount">{{ count(Auth::user()->docs) }}/3</span>
                                    </h4>
                                </div>
                                <div class="stat-icon">
                                    <i class="bi bi-folder-check text-success"></i>
                                </div>
                            </div>
                            <a href="documentos.html" class="btn btn-sm btn-outline-primary mt-3">
                                Ver Documentos
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Nota do Teste</h6>
                                    <h4 class="fw-bold mb-0">
                                        <span
                                            id="testScore">{{ number_format(Auth::user()->get_inscricao()->first()->nota_teste, 1, ',') }}</span>/100
                                    </h4>
                                    @if (Auth::user()->get_inscricao()->first()->status == 'em analise')
                                        <small class="text-warning" id="testStatus">Em Analise</small>
                                    @else
                                        <small class="text-success" id="testStatus">Aprovado</small>
                                    @endif
                                </div>
                                <div class="stat-icon">
                                    <i class="bi bi-award text-success"></i>
                                </div>
                            </div>
                            <a href="resultado.html" class="btn btn-sm btn-outline-primary mt-3">
                                Ver Resultado
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Curso Escolhido</h6>
                                    <h4 class="fw-bold mb-0" id="courseName">Informática</h4>
                                    <small class="text-primary" id="coursePeriod">Período: Noturno</small>
                                </div>
                                <div class="stat-icon">
                                    <i class="bi bi-laptop text-primary"></i>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal"
                                data-bs-target="#courseModal">
                                Detalhes
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas e Alertas -->
            <div class="row">
                <!-- Ações Rápidas -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-lightning-charge me-2"></i>
                                Ações Rápidas
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="action-card">
                                        <div class="action-icon bg-primary">
                                            <i class="bi bi-upload"></i>
                                        </div>
                                        <h6 class="mt-3 mb-2">Enviar Documentos</h6>
                                        <p class="text-muted small">Faça upload dos documentos pendentes</p>
                                        <a href="documentos.html" class="btn btn-sm btn-primary w-100">
                                            Acessar
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="action-card">
                                        <div class="action-icon bg-success">
                                            <i class="bi bi-printer"></i>
                                        </div>
                                        <h6 class="mt-3 mb-2">Imprimir Comprovante</h6>
                                        <p class="text-muted small">Gere comprovante de inscrição</p>
                                        <button class="btn btn-sm btn-success w-100" id="printReceipt">
                                            Imprimir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documentos Recentes -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-clock-history me-2"></i>
                                    Documentos Recentes
                                </h5>
                                <a href="documentos.html" class="btn btn-sm btn-outline-primary">
                                    Ver Todos
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Data de Envio</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="recentDocuments">
                                        <!-- Documentos serão carregados via JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alertas e Notícias -->
                <div class="col-lg-4">
                    <!-- Suporte -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-headset me-2"></i>
                                Precisa de Ajuda?
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="small text-muted mb-3">Nossa equipe está disponível para ajudar.</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#helpModal">
                                    <i class="bi bi-chat-left-text me-2"></i>Suporte
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="bi bi-telephone me-2"></i>(244) 999 999 999
                                </button>
                                <button class="btn btn-outline-info">
                                    <i class="bi bi-envelope me-2"></i>suporte@instituto.ao
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modais -->

    <!-- Modal de Perfil -->
    <div class="modal fade" id="profileModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-person-circle me-2"></i>Meu Perfil
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="profileContent">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="user-avatar-lg mb-3">
                                    <img src="{{ Auth::user()->photo ?? asset('assets/image/df.jpg') }}"
                                        alt="Aluno" class="avatar-img-lg">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <form wire:submit.prevent='updateProfile' id="profileForm">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="profileName"
                                                     wire:model='name' />
                                                <label for="profileName">Nome Completo</label>
                                                @error('name') <small class="text text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input disabled type="email" class="form-control" id="profileEmail" value="{{ Auth::user()->email }}">
                                                <label for="profileEmail">Email</label>
                                                <small class="text text-warning">Para alterar o Email fale com o Admim</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="tel" class="form-control" id="profilePhone"
                                                    wire:model='phone'>
                                                <label for="profilePhone">Telefone</label>
                                                @error('phone') <small class="text text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input wire:model='data_nasc' type="date" class="form-control" id="profileBirthDate">
                                                <label for="profileBirthDate">Data de Nascimento</label>
                                                @error('data_nasc') <small class="text text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input wire:model='bi' type="text" class="form-control" id="profileBI">
                                                <label for="profileBI">Bilhete de Identidade</label>
                                                @error('bi') <small class="text text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea wire:model='morada' class="form-control" id="profileAddress" style="height: 100px"></textarea>
                                                <label for="profileAddress">Morada</label>
                                                @error('morada') <small class="text text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Escolher outra imagem</label>
                                                    <input wire:model='photo' class="form-control" type="file" id="formFile">
                                                    @error('photo') <small class="text text-danger">{{ $message }}</small> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Salvar Alterações
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Alterar Senha -->
    <div class="modal fade" id="passwordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-key me-2"></i>Alterar Senha
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Senha Atual</label>
                            <input type="password" class="form-control" id="currentPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="newPassword" required minlength="6">
                            <div class="form-text">Mínimo 6 caracteres</div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmNewPassword" class="form-label">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" id="confirmNewPassword" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Alterar Senha
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Curso -->
    <div class="modal fade" id="courseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-laptop me-2"></i>Informações do Curso
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="course-info">
                        <h5 class="fw-bold mb-3">{{ Auth::user()->students()->first()->curso()->first()->name }}</h5>
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Duração</small>
                                <strong>{{ Auth::user()->students()->first()->curso()->first()->duracao }}</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Período</small>
                                <strong>{{ Auth::user()->students()->first()->curso()->first()->period }}</strong>
                            </div>
                        </div>
                        <hr>
                        <h6 class="fw-bold mb-2">Descriçã:</h6>
                        <p class="mb-3">{{ Auth::user()->students()->first()->curso()->first()->description }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Ajuda -->
    <div class="modal fade" id="helpModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-question-circle me-2"></i>Ajuda e Suporte
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="helpContent">
                        <div class="accordion" id="helpAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#help1">
                                        Como enviar documentos?
                                    </button>
                                </h2>
                                <div id="help1" class="accordion-collapse collapse show"
                                    data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <p>Acesse a seção <strong>"Meus Documentos"</strong> no menu lateral. Clique no
                                            botão "Enviar Documento" e selecione o arquivo desejado. Formatos aceitos:
                                            PDF, JPG, PNG. Tamanho máximo: 5MB por arquivo.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#help2">
                                        Como ver o status da minha inscrição?
                                    </button>
                                </h2>
                                <div id="help2" class="accordion-collapse collapse"
                                    data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <p>No <strong>Painel Principal</strong>, você verá uma linha do tempo com o
                                            status de cada etapa do processo. A seção "Status do Seu Processo" mostra
                                            detalhadamente cada fase.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#help3">
                                        Quando receberei o resultado do teste?
                                    </button>
                                </h2>
                                <div id="help3" class="accordion-collapse collapse"
                                    data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <p>O resultado do teste de admissão é disponibilizado em até <strong>48 horas
                                                úteis</strong> após a realização. Você será notificado por email e
                                            poderá consultar na seção "Resultado do Teste".</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">Canais de Atendimento</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="bi bi-telephone fs-1 text-primary mb-3"></i>
                                            <h6>Telefone</h6>
                                            <p class="small">(244) 999 999 999</p>
                                            <small class="text-muted">Seg-Sex: 8h-18h</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="bi bi-envelope fs-1 text-primary mb-3"></i>
                                            <h6>Email</h6>
                                            <p class="small">suporte@instituto.ao</p>
                                            <small class="text-muted">Resposta em até 24h</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
