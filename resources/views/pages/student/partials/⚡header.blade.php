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
                <!-- Usuário -->
                <div class="dropdown">
                    <button class="btn btn-light d-flex align-items-center" data-bs-toggle="dropdown">
                        <div class="user-avatar-sm me-2">
                            <img src="{{ Auth::user()->photo ?? asset('assets/image/df.jpg') }}" alt="Aluno">
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
                        <a class="dropdown-item" href="#" wire:click.prevent='logout'>
                            <i class="bi bi-box-arrow-left me-2"></i>Sair
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
