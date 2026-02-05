@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(rgba(30, 58, 138, 0.9), rgba(30, 58, 138, 0.8)),
                            url('https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
                            background-size: cover;
                            background-position: center;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-4 fw-bold mb-4">Entre em Contacto</h1>
                <p class="lead">Estamos aqui para ajudar. Entre em contacto connosco.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-3">Envie-nos uma Mensagem</h2>
                            <p class="text-muted">Responderemos o mais breve possível</p>
                        </div>

                        <form id="contactForm" action="{{ route('contacto.submit') }}" method="POST">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nome" name="nome"
                                               placeholder="Seu nome" required>
                                        <label for="nome">Nome Completo *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Seu email" required>
                                        <label for="email">Email *</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="assunto" name="assunto"
                                           placeholder="Assunto" required>
                                    <label for="assunto">Assunto *</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-floating">
                                    <textarea class="form-control" id="mensagem" name="mensagem"
                                              placeholder="Sua mensagem" style="height: 150px" required></textarea>
                                    <label for="mensagem">Mensagem *</label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-send me-2"></i> Enviar Mensagem
                                </button>
                            </div>
                        </form>

                        <!-- Success Message -->
                        <div id="successMessage" class="alert alert-success mt-4 text-center d-none">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <span>Mensagem enviada com sucesso! Responderemos em breve.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-white h-100">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 60px; height: 60px;">
                        <i class="bi bi-geo-alt fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Endereço</h5>
                    <p class="text-muted mb-0">Instituto Politécnico 30 de Setembro</p>
                    <p class="text-muted">Luanda, Angola</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-white h-100">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 60px; height: 60px;">
                        <i class="bi bi-telephone fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Telefone</h5>
                    <p class="text-muted mb-1">Secretaria: +244 222 123 456</p>
                    <p class="text-muted">Direção: +244 222 123 457</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-white h-100">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 60px; height: 60px;">
                        <i class="bi bi-envelope fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Email</h5>
                    <p class="text-muted mb-1">info@ip30setembro.edu.ao</p>
                    <p class="text-muted">admissao@ip30setembro.edu.ao</p>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="rounded-3 overflow-hidden shadow-sm">
                    <div class="bg-light p-5 text-center border rounded-3">
                        <i class="bi bi-map display-1 text-primary mb-3"></i>
                        <h4 class="fw-bold mb-3">Localização</h4>
                        <p class="text-muted mb-0">Encontre-nos facilmente em Luanda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Perguntas Frequentes</h2>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1" aria-expanded="true">
                                Como posso me inscrever no instituto?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                As inscrições são realizadas através do nosso sistema online. Basta criar uma conta,
                                preencher o formulário de inscrição e enviar os documentos necessários digitalmente.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2" aria-expanded="false">
                                Quais documentos são necessários para a inscrição?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                São necessários: BI, certificado de habilitações, fotografia e comprovativo de residência.
                                Todos os documentos devem ser digitalizados e enviados através do sistema.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3" aria-expanded="false">
                                Como acesso o sistema de gestão de processos?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                O acesso ao sistema é feito através do botão "Login" no canto superior direito do site.
                                Utilize as credenciais fornecidas pela instituição.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const successMessage = document.getElementById('successMessage');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Simulate form submission
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Enviando...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success message
                successMessage.classList.remove('d-none');
                contactForm.reset();

                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessage.classList.add('d-none');
                }, 5000);
            }, 1500);
        });
    }
});
</script>
@endsection
