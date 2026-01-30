<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <!-- Modal de Login -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Acesso ao Sistema
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" placeholder="seu@email.com"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Lembrar-me</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none">Esqueci minha senha</a>
                        <p class="mt-2 mb-0">
                            Não tem conta? <a href="#" class="text-decoration-none fw-bold">Inscreva-se aqui</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
