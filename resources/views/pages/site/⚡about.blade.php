<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection

<div>
    <livewire:partials.header />

    <!-- Hero Section Sobre -->
    <section class="hero-sobre py-5 mt-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-primary mb-4">
                        Nossa História, <span class="text-secondary">Nossa Missão</span>
                    </h1>
                    <p class="lead mb-4">
                        Há mais de duas décadas transformando vidas através da educação técnica de qualidade em Angola.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="ratio ratio-16x9">
                        <img src="https://via.placeholder.com/800x450/1e3a8a/ffffff?text=Instituto+Politecnico+30+de+Setembro"
                            alt="Instituto" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nossa História -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-4">
                        <h2 class="fw-bold text-primary mb-4">Nossa História</h2>
                        <p class="mb-4">
                            Fundado em 2003, o Instituto Politécnico 30 de Setembro nasceu com o propósito
                            de oferecer educação técnica de qualidade a jovens angolanos, preparando-os
                            para os desafios do mercado de trabalho.
                        </p>
                        <p class="mb-4">
                            Começamos com apenas 3 cursos e 50 alunos. Hoje, somos referência em
                            educação técnica em Luanda, com mais de 15 cursos e milhares de
                            profissionais formados.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <i class="bi bi-award-fill text-primary fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Excelência</h5>
                                        <p class="text-muted mb-0">20+ anos de experiência</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <i class="bi bi-people-fill text-primary fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Comunidade</h5>
                                        <p class="text-muted mb-0">1500+ alunos formados</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-4">
                        <img src="https://via.placeholder.com/600x400/3b82f6/ffffff?text=História+do+Instituto"
                            alt="História" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Missão, Visão e Valores -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Nossos Pilares</h2>
                <p class="text-muted">O que nos move e nos guia</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="icon-circle-large mb-3 mx-auto">
                            <i class="bi bi-bullseye text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Missão</h4>
                        <p class="text-muted">
                            Formar técnicos profissionais competentes e éticos, capazes de contribuir
                            para o desenvolvimento sustentável de Angola através da educação técnica
                            de excelência.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="icon-circle-large mb-3 mx-auto">
                            <i class="bi bi-eye text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Visão</h4>
                        <p class="text-muted">
                            Ser referência nacional em educação técnica até 2030, reconhecido pela
                            qualidade do ensino e pelo impacto positivo na empregabilidade dos
                            nossos graduados.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="icon-circle-large mb-3 mx-auto">
                            <i class="bi bi-heart text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Valores</h4>
                        <ul class="list-unstyled text-muted text-start">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Excelência Académica
                            </li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Ética e Integridade
                            </li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Inovação Constante
                            </li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Responsabilidade
                                Social</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Trabalho em Equipa</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Infraestrutura -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold text-primary mb-4">Infraestrutura Moderna</h2>
                    <p class="mb-4">
                        Oferecemos instalações modernas e adequadas para o aprendizado prático:
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Laboratórios de Informática
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Oficinas Equipadas
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Biblioteca Digital
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Auditório Moderno
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Áreas de Convivência
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Acesso a Deficientes
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="https://via.placeholder.com/400x300/1e3a8a/ffffff?text=Laboratório"
                                alt="Laboratório" class="img-fluid rounded shadow-sm">
                        </div>
                        <div class="col-6">
                            <img src="https://via.placeholder.com/400x300/3b82f6/ffffff?text=Biblioteca"
                                alt="Biblioteca" class="img-fluid rounded shadow-sm">
                        </div>
                        <div class="col-6">
                            <img src="https://via.placeholder.com/400x300/1e3a8a/ffffff?text=Oficina" alt="Oficina"
                                class="img-fluid rounded shadow-sm">
                        </div>
                        <div class="col-6">
                            <img src="https://via.placeholder.com/400x300/3b82f6/ffffff?text=Auditório"
                                alt="Auditório" class="img-fluid rounded shadow-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipa -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Nossa Equipa</h2>
                <p class="text-muted">Profissionais qualificados e dedicados</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center">
                        <img src="https://via.placeholder.com/300x300/1e3a8a/ffffff?text=Diretor"
                            class="card-img-top rounded-circle p-4" alt="Diretor">
                        <div class="card-body">
                            <h5 class="fw-bold">Dr. João Silva</h5>
                            <p class="text-muted mb-2">Diretor Geral</p>
                            <small class="text-muted">20 anos de experiência</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center">
                        <img src="https://via.placeholder.com/300x300/3b82f6/ffffff?text=Coordenadora"
                            class="card-img-top rounded-circle p-4" alt="Coordenadora">
                        <div class="card-body">
                            <h5 class="fw-bold">Dra. Maria Santos</h5>
                            <p class="text-muted mb-2">Coordenadora Académica</p>
                            <small class="text-muted">15 anos de experiência</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center">
                        <img src="https://via.placeholder.com/300x300/1e3a8a/ffffff?text=Professor"
                            class="card-img-top rounded-circle p-4" alt="Professor">
                        <div class="card-body">
                            <h5 class="fw-bold">Prof. António Costa</h5>
                            <p class="text-muted mb-2">Coordenador de Informática</p>
                            <small class="text-muted">Mestre em Engenharia</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm text-center">
                        <img src="https://via.placeholder.com/300x300/3b82f6/ffffff?text=Professora"
                            class="card-img-top rounded-circle p-4" alt="Professora">
                        <div class="card-body">
                            <h5 class="fw-bold">Prof. Ana Pereira</h5>
                            <p class="text-muted mb-2">Coordenadora de Mecânica</p>
                            <small class="text-muted">Especialista Industrial</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeria -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Galeria do Instituto</h2>
                <p class="text-muted">Conheça nossos espaços</p>
            </div>

            <div class="row g-3">
                <div class="col-md-3 col-6">
                    <a href="#" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        <img src="https://via.placeholder.com/400x300/1e3a8a/ffffff?text=Atividades"
                            class="img-fluid rounded shadow-sm" alt="Atividades">
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="#" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        <img src="https://via.placeholder.com/400x300/3b82f6/ffffff?text=Eventos"
                            class="img-fluid rounded shadow-sm" alt="Eventos">
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="#" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        <img src="https://via.placeholder.com/400x300/1e3a8a/ffffff?text=Formatura"
                            class="img-fluid rounded shadow-sm" alt="Formatura">
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="#" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        <img src="https://via.placeholder.com/400x300/3b82f6/ffffff?text=Visitas"
                            class="img-fluid rounded shadow-sm" alt="Visitas">
                    </a>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary">
                    <i class="bi bi-images me-2"></i>Ver Mais Fotos
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">Pronto para fazer parte da nossa história?</h3>
                    <p class="mb-0">Inscreva-se agora e comece sua jornada de sucesso conosco.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="inscricao.html" class="btn btn-light btn-lg">
                        <i class="bi bi-pencil-square me-2"></i>Inscrever-se
                    </a>
                </div>
            </div>
        </div>
    </section>

    <livewire:partials.footer />

    <livewire:partials.gallerymodal />

</div>
