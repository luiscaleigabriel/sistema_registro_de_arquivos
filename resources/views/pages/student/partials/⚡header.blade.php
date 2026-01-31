<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <!-- Topbar -->
    <header class="topbar">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn sidebar-toggle me-3">
                    <i class="bi bi-list"></i>
                </button>
                <h4 class="mb-0">Painel Principal</h4>
            </div>

            <div class="d-flex align-items-center">
                <!-- Notificações -->
                <div class="dropdown me-3">
                    <button class="btn btn-light position-relative" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow">
                        <h6 class="dropdown-header">Notificações</h6>
                        <div class="notification-item">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-check-circle text-success"></i>
                                </div>
                                <div>
                                    <small class="fw-bold">Documento aprovado</small>
                                    <p class="mb-0 small">Seu BI foi aprovado pela secretaria.</p>
                                    <small class="text-muted">Há 2 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="notification-item">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-exclamation-triangle text-warning"></i>
                                </div>
                                <div>
                                    <small class="fw-bold">Documento pendente</small>
                                    <p class="mb-0 small">Seu certificado necessita de revisão.</p>
                                    <small class="text-muted">Há 1 dia</small>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-center small">
                            Ver todas as notificações
                        </a>
                    </div>
                </div>

                <!-- Usuário -->
                <div class="dropdown">
                    <button class="btn btn-light d-flex align-items-center" data-bs-toggle="dropdown">
                        <div class="user-avatar-sm me-2">
                            <img src="https://via.placeholder.com/100/1e3a8a/ffffff?text=JS" alt="Aluno">
                        </div>
                        <span id="topbarUserName">João Silva</span>
                        <i class="bi bi-chevron-down ms-2"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow">
                        <h6 class="dropdown-header">Minha Conta</h6>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                            <i class="bi bi-person me-2"></i>Meu Perfil
                        </a>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#passwordModal">
                            <i class="bi bi-key me-2"></i>Alterar Senha
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../index.html">
                            <i class="bi bi-box-arrow-left me-2"></i>Sair
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
