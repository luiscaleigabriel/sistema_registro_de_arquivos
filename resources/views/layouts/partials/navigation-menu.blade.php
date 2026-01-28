<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="bi bi-archive-fill"></i>
            30 Setembro
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features">Funcionalidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contacto</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
