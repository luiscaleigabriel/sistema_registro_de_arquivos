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
                                        <span class="text-warning" id="statusText">{{ Auth::user()->get_inscricao()->first()->status }}</span>
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
                                        <span id="docCount">2/3</span>
                                    </h4>
                                    <small class="text-success" id="docStatus">Aprovados</small>
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
                                        <span id="testScore">85</span>/100
                                    </h4>
                                    <small class="text-success" id="testStatus">Aprovado</small>
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
                    <!-- Alertas -->
                    <div class="card mb-4">
                        <div class="card-header bg-warning">
                            <h5 class="card-title mb-0 text-white">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Atenção Necessária
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert-item">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="bi bi-exclamation-circle text-danger"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Certificado Pendente</h6>
                                        <p class="small mb-2">Seu certificado de conclusão do ensino médio precisa ser
                                            reenviado.</p>
                                        <a href="documentos.html" class="btn btn-sm btn-danger">Corrigir Agora</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Próximos Passos -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-list-check me-2"></i>
                                Próximos Passos
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <span class="step-number">1</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Aprovação dos Documentos</h6>
                                            <p class="small text-muted mb-0">Aguardando análise do certificado</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <span class="step-number">2</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Confirmação de Matrícula</h6>
                                            <p class="small text-muted mb-0">Após aprovação dos documentos</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <span class="step-number">3</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Pagamento da Matrícula</h6>
                                            <p class="small text-muted mb-0">Será liberado após confirmação</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

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
                                    <i class="bi bi-chat-left-text me-2"></i>Chat de Suporte
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="bi bi-telephone me-2"></i>(222) 123-456
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
                        <!-- Conteúdo será carregado via JavaScript -->
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
                        <h5 class="fw-bold mb-3">Informática</h5>
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Duração</small>
                                <strong>3 anos</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Período</small>
                                <strong>Noturno</strong>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Início das Aulas</small>
                                <strong>15/03/2024</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Turno</small>
                                <strong>18h às 22h</strong>
                            </div>
                        </div>
                        <hr>
                        <h6 class="fw-bold mb-2">Coordenador do Curso</h6>
                        <p class="mb-3">Prof. João Silva - joao.silva@instituto.ao</p>
                        <h6 class="fw-bold mb-2">Local das Aulas</h6>
                        <p class="mb-0">Bloco B, Sala 201 - Campus Principal</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-download me-2"></i>Baixar Grade Curricular
                    </button>
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
                        <!-- Conteúdo será carregado via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
