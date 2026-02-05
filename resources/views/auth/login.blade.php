@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label fw-bold">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    placeholder="seu@email.com" required>
            </div>
        </div>

        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label for="senha" class="form-label fw-bold">Senha</label>
                <a href="{{ route('password.request') }}" class="auth-link small">Esqueceu a senha?</a>
            </div>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
                <button type="button" class="input-group-text" id="togglePassword">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Lembrar-me</label>
        </div>

        <button type="submit" class="btn btn-auth mb-4">
            <i class="bi bi-box-arrow-in-right me-2"></i> Entrar
        </button>

        <div class="text-center">
            <p class="mb-0">Não tem uma conta?
                <a href="{{ route('registro') }}" class="auth-link">Cadastre-se</a>
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
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('senha');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' :
                        '<i class="bi bi-eye-slash"></i>';
                });
            }

            // Form submission animation
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-2"></span>Entrando...';
                        submitBtn.disabled = true;
                    }
                });
            }
        });
    </script>
@endsection
