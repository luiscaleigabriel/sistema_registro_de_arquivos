@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Gestão Digital de Processos Académicos</h1>
                <p class="lead mb-4">Modernize a administração dos processos estudantis com nossa plataforma integrada. Segurança, eficiência e controle total em uma única solução.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('registro') }}" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-rocket-takeoff me-2"></i> Começar Agora
                    </a>
                    <a href="{{ route('sobre') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-info-circle me-2"></i> Saiba Mais
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="mt-4 mt-lg-0">
                    <div class="bg-white rounded-3 p-4 d-inline-block">
                        <i class="bi bi-laptop display-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Por que escolher nosso sistema?</h2>
            <p class="lead text-muted">Oferecemos uma solução completa para gestão de processos académicos</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card p-4 h-100">
                    <div class="card-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Segurança Avançada</h4>
                    <p class="text-muted">Dados protegidos com criptografia de ponta e múltiplos níveis de acesso para garantir a confidencialidade das informações.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card p-4 h-100">
                    <div class="card-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Processos Ágeis</h4>
                    <p class="text-muted">Reduza o tempo de processamento em até 70% com fluxos de trabalho automatizados e digitalização inteligente.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card p-4 h-100">
                    <div class="card-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Relatórios Inteligentes</h4>
                    <p class="text-muted">Gere análises detalhadas e relatórios personalizados para uma tomada de decisão baseada em dados reais.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">3,000+</div>
                    <p class="text-muted mb-0">Processos Geridos</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">587</div>
                    <p class="text-muted mb-0">Estudantes Ativos</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">320</div>
                    <p class="text-muted mb-0">Funcionários</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">99.8%</div>
                    <p class="text-muted mb-0">Satisfação</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Flow -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Como funciona?</h2>
            <p class="lead text-muted">Um fluxo de trabalho simplificado para gestão eficiente</p>
        </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-plus fs-3"></i>
                    </div>
                    <h5 class="fw-bold">1. Cadastro</h5>
                    <p class="text-muted">Registro simples e rápido de estudantes</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-file-earmark-text fs-3"></i>
                    </div>
                    <h5 class="fw-bold">2. Documentação</h5>
                    <p class="text-muted">Upload e validação digital de documentos</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-check-circle fs-3"></i>
                    </div>
                    <h5 class="fw-bold">3. Validação</h5>
                    <p class="text-muted">Análise e aprovação pelos responsáveis</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-archive fs-3"></i>
                    </div>
                    <h5 class="fw-bold">4. Arquivamento</h5>
                    <p class="text-muted">Armazenamento seguro e organização</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5" style="background: linear-gradient(135deg, var(--azul-principal), var(--azul-secundario));">
    <div class="container text-center text-white">
        <h2 class="fw-bold mb-4">Pronto para transformar sua gestão de processos?</h2>
        <p class="lead mb-4">Junte-se a dezenas de instituições que já modernizaram seus processos conosco.</p>
        <a href="{{ route('registro') }}" class="btn btn-light btn-lg px-5">
            <i class="bi bi-calendar-check me-2"></i> Agendar Demonstração
        </a>
    </div>
</section>
@endsection
