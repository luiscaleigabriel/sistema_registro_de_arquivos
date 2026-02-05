<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-building me-2"></i>
            Instituto 30 de Setembro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sobre') }}">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn btn-primary" href="{{ route('registro') }}">
                        <i class="bi bi-person-plus me-1"></i> Cadastrar-se
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
