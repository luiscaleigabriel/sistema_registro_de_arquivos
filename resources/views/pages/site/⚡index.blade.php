<?php

use Livewire\Component;

new class extends Component {};
?>
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script></script>
@endsection
<div>
    <livewire:partials.header />

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            Transforme Seu Futuro com Educação de Qualidade
                        </h1>
                        <p class="lead text-light mb-4">
                            No Instituto Politécnico 30 de Setembro, oferecemos formação técnica
                            de excelência com foco na empregabilidade e desenvolvimento pessoal.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-light btn-lg px-4">
                                <i class="bi bi-pencil-square me-2"></i>Inscreva-se Agora
                            </a>
                            <a href="#" class="btn btn-outline-light btn-lg px-4">
                                <i class="bi bi-info-circle me-2"></i>Saiba Mais
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="https://via.placeholder.com/500x400/1e3a8a/ffffff?text=Estudantes+Universitários"
                            alt="Estudantes" class="img-fluid rounded shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção de Cursos -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-primary">Nossos Cursos</h2>
                    <p class="text-muted">Formação técnica especializada para o mercado de trabalho</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm course-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-circle mb-3 mx-auto">
                                    <i class="bi bi-laptop text-primary"></i>
                                </div>
                                <h4 class="card-title fw-bold">Informática</h4>
                                <p class="card-text text-muted">
                                    Formação completa em desenvolvimento de software, redes e manutenção de
                                    computadores.
                                </p>
                                <a href="#" class="btn btn-outline-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm course-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-circle mb-3 mx-auto">
                                    <i class="bi bi-gear text-primary"></i>
                                </div>
                                <h4 class="card-title fw-bold">Mecânica</h4>
                                <p class="card-text text-muted">
                                    Especialização em manutenção automotiva e industrial com prática em laboratórios
                                    equipados.
                                </p>
                                <a href="#" class="btn btn-outline-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm course-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-circle mb-3 mx-auto">
                                    <i class="bi bi-building text-primary"></i>
                                </div>
                                <h4 class="card-title fw-bold">Construção Civil</h4>
                                <p class="card-text text-muted">
                                    Formação em técnicas construtivas, topografia e gestão de obras.
                                </p>
                                <a href="#" class="btn btn-outline-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="#" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-list-ul me-2"></i>Ver Todos os Cursos
                    </a>
                </div>
            </div>
        </section>

        <!-- Seção do Sistema -->
        <section class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <img src="https://via.placeholder.com/500x400/3b82f6/ffffff?text=Sistema+de+Gestão"
                            alt="Sistema de Gestão" class="img-fluid rounded shadow">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="fw-bold text-primary mb-4">
                            Sistema de Gestão de Processos Académicos
                        </h2>
                        <p class="lead mb-4">
                            Processos digitais simplificados para uma experiência académica eficiente e sem papel.
                        </p>

                        <div class="feature-list">
                            <div class="d-flex mb-3">
                                <div class="feature-icon">
                                    <i class="bi bi-file-earmark-text text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold">Inscrição Online</h5>
                                    <p class="text-muted">Complete sua inscrição totalmente online, sem necessidade de
                                        deslocamento.</p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="feature-icon">
                                    <i class="bi bi-cloud-upload text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold">Upload de Documentos</h5>
                                    <p class="text-muted">Envie seus documentos digitalizados diretamente pelo sistema.
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="feature-icon">
                                    <i class="bi bi-clipboard-check text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold">Acompanhamento em Tempo Real</h5>
                                    <p class="text-muted">Acompanhe o status do seu processo a qualquer momento.</p>
                                </div>
                            </div>
                        </div>

                        <a href="#" class="btn btn-primary btn-lg mt-3">
                            <i class="bi bi-play-circle me-2"></i>Começar Agora
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção de Destaques -->
        <section class="py-5 bg-primary text-white">
            <div class="container">
                <div class="row text-center g-4">
                    <div class="col-md-3">
                        <div class="stats-box">
                            <h3 class="display-4 fw-bold">1500+</h3>
                            <p class="lead">Estudantes Formados</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-box">
                            <h3 class="display-4 fw-bold">98%</h3>
                            <p class="lead">Taxa de Empregabilidade</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-box">
                            <h3 class="display-4 fw-bold">15+</h3>
                            <p class="lead">Cursos Técnicos</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-box">
                            <h3 class="display-4 fw-bold">24/7</h3>
                            <p class="lead">Suporte Online</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="fw-bold text-primary mb-3">Pronto para Iniciar Sua Jornada?</h2>
                        <p class="lead mb-4">
                            Inscreva-se hoje mesmo e dê o primeiro passo rumo ao seu futuro profissional.
                        </p>
                        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                            <a href="#" class="btn btn-primary btn-lg px-4">
                                <i class="bi bi-pencil-square me-2"></i>Realizar Inscrição
                            </a>
                            <a href="#" class="btn btn-outline-primary btn-lg px-4">
                                <i class="bi bi-question-circle me-2"></i>Tirar Dúvidas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <livewire:partials.footer />
</div>
