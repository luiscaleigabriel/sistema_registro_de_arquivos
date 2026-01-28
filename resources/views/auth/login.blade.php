<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Sistema de Processos</title>

    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="row g-0">

                <div class="col-lg-6 login-left">
                    <div class="position-relative">
                        <div class="login-logo">
                            <i class="bi bi-archive-fill"></i>
                            30 Setembro
                        </div>

                        <h1 class="display-5 fw-bold mb-4">Bem-vindo de volta!</h1>
                        <p class="lead opacity-90">Acesse sua conta para gerenciar processos acadêmicos de forma
                            eficiente e segura.</p>

                        <div class="login-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Segurança Garantida</h5>
                                    <p class="small opacity-90 mb-0">Criptografia de ponta a ponta</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-lightning"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Acesso Rápido</h5>
                                    <p class="small opacity-90 mb-0">Interface otimizada para performance</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-bar-chart"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Dashboard Inteligente</h5>
                                    <p class="small opacity-90 mb-0">Acompanhe tudo em tempo real</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side (Login Form) -->
                <div class="col-lg-6 login-right">
                    <div class="login-header">
                        <h2>Faça seu login</h2>
                        <p>Entre com suas credenciais para acessar o sistema</p>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" value="{{ old('email') }}"
                                placeholder=" ">
                                @error('email') {{ $message }} @enderror
                            <label for="username">
                                <i class="bi bi-person me-2"></i>Usuário ou Email
                            </label>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" placeholder=" " >
                            <label for="password">
                                <i class="bi bi-lock me-2"></i>Senha
                            </label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Lembrar-me
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    Esqueceu a senha?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-login w-100 text-white">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Entrar no Sistema
                        </button>
                    </form>

                    <div class="divider">
                        <span>Ou entre com</span>
                    </div>

                    <div class="social-login">
                        <button class="btn-social">
                            <i class="bi bi-google text-danger"></i>
                            Google
                        </button>
                        <button class="btn-social">
                            <i class="bi bi-microsoft text-primary"></i>
                            Microsoft
                        </button>
                    </div>

                    <div class="login-footer">
                        <p class="mb-0">
                            Não tem uma conta?
                            <a href="{{ route('register') }}" class="fw-semibold">Crie uma agora</a>
                        </p>
                        <p class="mt-2">
                            <a href="{{ route('site.index') }}" class="text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i>Voltar para o site
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>

