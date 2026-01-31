<?php

use Livewire\Component;

new class extends Component {
    public function logout()
    {
        Auth::logout();
        return redirect()->route('site.index');
    }
};
?>

<div>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center">
                <div class="sidebar-logo me-3">
                    <i class="bi bi-building-gear"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Instituto 30 de Setembro</h6>
                    <small class="text-muted">Área do Aluno</small>
                </div>
            </div>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">
                <img src="https://via.placeholder.com/100/1e3a8a/ffffff?text=JS" alt="Aluno" class="avatar-img">
            </div>
            <div class="user-info">
                <h6 class="fw-bold mb-0" id="sidebarUserName">{{ Auth::user()->name }}</h6>
                <small class="text-muted" id="sidebarUserEmail">{{ Auth::user()->email }}</small>
                <span class="badge bg-primary mt-1" id="sidebarUserStatus">{{ Auth::user()->get_inscricao()->first()->status }}</span>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Menu Principal</li>
            <li class="menu-item active">
                <a href="index.html">
                    <i class="bi bi-house-door"></i>
                    <span>Painel Principal</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="documentos.html">
                    <i class="bi bi-folder"></i>
                    <span>Meus Documentos</span>
                    <span class="badge bg-warning" id="docBadge">2</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="status.html">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Status da Inscrição</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="resultado.html">
                    <i class="bi bi-award"></i>
                    <span>Resultado do Teste</span>
                </a>
            </li>

            <li class="menu-header">Configurações</li>
            <li class="menu-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="bi bi-person-circle"></i>
                    <span>Meu Perfil</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#passwordModal">
                    <i class="bi bi-key"></i>
                    <span>Alterar Senha</span>
                </a>
            </li>

            <li class="menu-header">Ajuda</li>
            <li class="menu-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#helpModal">
                    <i class="bi bi-question-circle"></i>
                    <span>Ajuda e Suporte</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="text-danger" wire:click.prevent='logout'>
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Sair</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
