@extends('layouts.auth')

@section('title', 'Cadastro de Aluno')

@section('content')
    <form method="POST" action="{{ route('registro.submit') }}" id="registroForm">
        @csrf

        <div class="mb-4 text-center">
            <h4 class="fw-bold mb-2">Criar Conta de Aluno</h4>
            <p class="text-muted mb-0">Preencha os dados abaixo para se cadastrar</p>
        </div>

        <div class="mb-3">
            <label for="nome" class="form-label fw-bold">Nome Completo *</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}"
                    placeholder="Seu nome completo" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email *</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    placeholder="seu@email.com" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="bi" class="form-label fw-bold">Bilhete de Identidade *</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-card-text"></i>
                    </span>
                    <input type="text" class="form-control" id="bi" name="bi" value="{{ old('bi') }}"
                        placeholder="Número do BI" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="data_nasc" class="form-label fw-bold">Data de Nascimento *</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>
                    <input type="date" class="form-control" id="data_nasc" name="data_nasc"
                        value="{{ old('data_nasc') }}" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="morada" class="form-label fw-bold">Morada *</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-house-door"></i>
                </span>
                <input type="text" class="form-control" id="morada" name="morada" value="{{ old('morada') }}"
                    placeholder="Sua morada completa" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="telefone" class="form-label fw-bold">Telefone *</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-telephone"></i>
                    </span>
                    <input type="tel" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}"
                        placeholder="+244 9XX XXX XXX" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="curso" class="form-label fw-bold">Curso *</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-book"></i>
                    </span>
                    <select class="form-select" id="curso" name="curso" required>
                        <option value="" disabled selected>Selecione o curso</option>
                        <option value="Informática">Informática</option>
                        <option value="Gestão">Gestão</option>
                        <option value="Contabilidade">Contabilidade</option>
                        <option value="Secretariado">Secretariado</option>
                        <option value="Eletricidade">Eletricidade</option>
                        <option value="Mecânica">Mecânica</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="senha" class="form-label fw-bold">Senha *</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="senha" name="senha"
                        placeholder="Mínimo 8 caracteres" minlength="8" required>
                    <button type="button" class="input-group-text toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <label for="senha_confirmation" class="form-label fw-bold">Confirmar Senha *</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation"
                        placeholder="Digite novamente" required>
                    <button type="button" class="input-group-text toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="mb-4 form-check">
            <input type="checkbox" class="form-check-input" id="termos" name="termos" required>
            <label class="form-check-label" for="termos">
                Aceito os
                <a href="#" class="auth-link">Termos de Uso</a> e
                <a href="#" class="auth-link">Política de Privacidade</a>
            </label>
        </div>

        <button type="submit" class="btn btn-auth mb-3">
            <i class="bi bi-person-plus me-2"></i> Criar Conta
        </button>

        <div class="text-center">
            <p class="mb-0">Já tem uma conta?
                <a href="{{ route('login') }}" class="auth-link">Faça login</a>
            </p>
        </div>
    </form>
@endsection

@section('footer')
    <p class="mb-0">
        <a href="{{ route('home') }}" class="auth-link">
            <i class="bi bi-arrow-left me-1"></i> Voltar ao site
        </a>
    </p>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format phone input
            const telefoneInput = document.getElementById('telefone');
            if (telefoneInput) {
                telefoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 0) {
                        if (value.length <= 3) {
                            value = '+244 ' + value;
                        } else if (value.length <= 6) {
                            value = '+244 ' + value.substring(0, 3) + ' ' + value.substring(3);
                        } else if (value.length <= 9) {
                            value = '+244 ' + value.substring(0, 3) + ' ' + value.substring(3, 6) + ' ' +
                                value.substring(6);
                        } else {
                            value = '+244 ' + value.substring(0, 3) + ' ' + value.substring(3, 6) + ' ' +
                                value.substring(6, 9);
                        }
                    }
                    e.target.value = value;
                });
            }

            // Toggle password visibility for both fields
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentNode.querySelector('input');
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' :
                        '<i class="bi bi-eye-slash"></i>';
                });
            });

            // Validate date of birth (must be at least 16 years old)
            const dataNascInput = document.getElementById('data_nasc');
            if (dataNascInput) {
                const today = new Date();
                const minDate = new Date();
                minDate.setFullYear(today.getFullYear() - 16);
                dataNascInput.max = minDate.toISOString().split('T')[0];
            }

            // Form submission
            const registroForm = document.getElementById('registroForm');
            if (registroForm) {
                registroForm.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-2"></span>Criando conta...';
                        submitBtn.disabled = true;
                    }
                });
            }
        });
    </script>
@endsection
