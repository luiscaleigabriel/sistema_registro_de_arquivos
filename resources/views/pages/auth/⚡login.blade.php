<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {

    public $email;
    public $password;

    public $rules = [
        'email' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        $autenticated = Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if (!$autenticated) {
            session()->flash('error', 'Email ou senha inválida!');
        }else {

            if(Auth::user()->role == 'student') {
                return redirect()->route('student.index');
            }else if('admin') {
                return redirect('/');
            }

        }

    }

};
?>

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script></script>
@endsection

<div>

    <livewire:partials.header />

    <!-- Área de Login -->
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div>
                <div class="row justify-content-center align-items-center">
                    <!-- Coluna do Formulário -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-lg">
                            <div class="card-header bg-primary text-white py-4">
                                <h4 class="fw-bold mb-0 text-center">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Bem vindo, de volta!
                                </h4>
                            </div>

                            <div class="card-body p-5">
                                <!-- Formulário de Login -->
                                @if (session()->has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <form id="loginForm" wire:submit.prevent='login'>
                                    @csrf
                                    <div class="mb-4">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Email" name="email" wire:model='email' value="{{ old('email') }}">
                                            <label for="email">
                                                <i class="bi bi-envelope me-2"></i>Email
                                            </label>
                                            @error('email')
                                                <div class="text text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Senha" name="password" wire:model='password'>
                                            <label for="password">
                                                <i class="bi bi-lock me-2"></i>Senha
                                            </label>
                                            @error('password')
                                                <div class="text text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">
                                                Lembrar-me neste dispositivo
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                                        </button>
                                    </div>

                                    <div class="text-center">
                                        <a href="#" class="text-decoration-none" id="forgotPassword">
                                            <i class="bi bi-question-circle me-1"></i>Esqueci minha senha
                                        </a>
                                    </div>
                                </form>



                                <!-- Mensagem de Bem-vindo -->
                                <div class="alert alert-info mt-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="bi bi-info-circle fs-4"></i>
                                        </div>
                                        <div>
                                            <strong>Primeiro acesso?</strong>
                                            <p class="mb-0">Utilize o email e senha cadastrados durante a inscrição.
                                            </p>
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

    <!-- Modal de Recuperação de Senha -->
    <div class="modal fade" id="recoveryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-key me-2"></i>Recuperar Senha
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="recoveryForm">
                        <div class="mb-3">
                            <label for="recoveryEmail" class="form-label">Email Cadastrado</label>
                            <input type="email" class="form-control" id="recoveryEmail" placeholder="seu@email.com"
                                required>
                        </div>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Enviaremos um link para redefinir sua senha no email informado.
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i>Enviar Link de Recuperação
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <livewire:partials.footer />

</div>
