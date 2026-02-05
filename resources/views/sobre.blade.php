@extends('layouts.app')

@section('title', 'Sobre Nós')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(rgba(30, 58, 138, 0.9), rgba(30, 58, 138, 0.8)),
                            url('https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
                            background-size: cover;
                            background-position: center;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-4 fw-bold mb-4">Sobre o Instituto</h1>
                <p class="lead">Excelência em educação técnica desde 2000</p>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Nossa História</h2>
                <p class="lead text-muted mb-4">Fundado em 2000, o Instituto Politécnico 30 de Setembro nasceu da necessidade de formar profissionais técnicos altamente qualificados para impulsionar o desenvolvimento de Angola.</p>

                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-primary fs-4 me-3"></i>
                            <div>
                                <h5 class="fw-bold">Missão</h5>
                                <p class="text-muted mb-0">Formar técnicos competentes com base em valores éticos e científicos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-primary fs-4 me-3"></i>
                            <div>
                                <h5 class="fw-bold">Visão</h5>
                                <p class="text-muted mb-0">Ser referência nacional em educação técnica politécnica.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="rounded-3 overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Campus do Instituto" class="img-fluid">
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="fw-bold text-center mb-5">Nossos Valores</h2>
            </div>

            <div class="col-md-3 mb-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <i class="bi bi-award display-4 text-primary mb-3"></i>
                    <h5 class="fw-bold">Excelência</h5>
                    <p class="text-muted">Compromisso com a qualidade em todas as atividades académicas.</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <i class="bi bi-people display-4 text-primary mb-3"></i>
                    <h5 class="fw-bold">Ética</h5>
                    <p class="text-muted">Conduta íntegra e transparente em todas as relações.</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <i class="bi bi-lightbulb display-4 text-primary mb-3"></i>
                    <h5 class="fw-bold">Inovação</h5>
                    <p class="text-muted">Busca constante por melhorias e novas soluções.</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <i class="bi bi-heart display-4 text-primary mb-3"></i>
                    <h5 class="fw-bold">Responsabilidade</h5>
                    <p class="text-muted">Compromisso com o desenvolvimento social e sustentável.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Nossa Equipa</h2>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         class="card-img-top" alt="Diretor">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Dr. Manuel Silva</h5>
                        <p class="text-muted mb-2">Diretor Geral</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         class="card-img-top" alt="Coordenadora">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Dra. Ana Pereira</h5>
                        <p class="text-muted mb-2">Coordenadora Pedagógica</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         class="card-img-top" alt="Secretária">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Sra. Marta Santos</h5>
                        <p class="text-muted mb-2">Chefe de Secretaria</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                         class="card-img-top" alt="Administrador">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Sr. João Costa</h5>
                        <p class="text-muted mb-2">Administrador de Sistemas</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-primary"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
