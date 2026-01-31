<?php

use Livewire\Component;

new class extends Component {
    public function logout()
    {
        auth()->logout();
    }
};
?>

<div>
    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('site.index') }}">
                <i class="bi bi-building-gear me-2"></i>
                Instituto 30 de Setembro
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('site.index') }}">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site.about') }}">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site.cursos') }}">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site.inscricao') }}">Inscrição</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Teste Online</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item">
                            <a >{{ auth()->user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-danger" wire:click='logout'>Logout</button>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div>
