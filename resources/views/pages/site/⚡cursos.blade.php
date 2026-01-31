<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/cursos.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/cursos.js') }}"></script>
    <script></script>
@endsection

<div>

    <livewire:partials.header />

    <!-- Hero Section Cursos -->
    <section class="hero-cursos py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-primary mb-4">
                        Formação Técnica <span class="text-secondary">de Excelência</span>
                    </h1>
                    <p class="lead mb-4">
                        Escolha entre nossos cursos técnicos e dê o primeiro passo para uma carreira de sucesso.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-primary fs-6 py-2 px-3">
                            <i class="bi bi-clock me-1"></i>Duração: 2-3 anos
                        </span>
                        <span class="badge bg-success fs-6 py-2 px-3">
                            <i class="bi bi-briefcase me-1"></i>98% Empregabilidade
                        </span>
                        <span class="badge bg-info fs-6 py-2 px-3">
                            <i class="bi bi-mortarboard me-1"></i>Certificação Reconhecida
                        </span>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://via.placeholder.com/600x400/1e3a8a/ffffff?text=Cursos+Técnicos"
                        alt="Cursos Técnicos" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Filtro de Cursos -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" id="searchCourse" placeholder="Pesquisar curso...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="filterArea">
                        <option value="">Todas as Áreas</option>
                        <option value="tecnologia">Tecnologia</option>
                        <option value="engenharia">Engenharia</option>
                        <option value="administracao">Administração</option>
                        <option value="saude">Saúde</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="filterDuration">
                        <option value="">Qualquer Duração</option>
                        <option value="1">1 ano</option>
                        <option value="2">2 anos</option>
                        <option value="3">3 anos</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Lista de Cursos -->
    <section class="py-5">
        <div class="container">
            <div class="row" id="coursesContainer">
                <!-- Curso 1: Informática -->
                <div class="col-lg-4 col-md-6 mb-4" data-area="tecnologia" data-duration="3">
                    <div class="card h-100 border-0 shadow-sm course-card">
                        <div class="card-header bg-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">Informática</h5>
                                <span class="badge bg-light text-primary">Tecnologia</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="course-icon mb-3">
                                <i class="bi bi-laptop text-primary"></i>
                            </div>
                            <p class="text-muted mb-4">
                                Formação completa em desenvolvimento de software, redes de computadores,
                                manutenção e suporte técnico.
                            </p>
                            <div class="course-details mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Duração</small>
                                        <strong>3 anos</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Período</small>
                                        <strong>Diurno/Noturno</strong>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Desenvolvimento Web
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Redes e Segurança
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Banco de Dados
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#cursoModal"
                                data-course="informatica">
                                <i class="bi bi-info-circle me-2"></i>Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Curso 2: Mecânica -->
                <div class="col-lg-4 col-md-6 mb-4" data-area="engenharia" data-duration="2">
                    <div class="card h-100 border-0 shadow-sm course-card">
                        <div class="card-header bg-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">Mecânica Industrial</h5>
                                <span class="badge bg-light text-primary">Engenharia</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="course-icon mb-3">
                                <i class="bi bi-gear text-primary"></i>
                            </div>
                            <p class="text-muted mb-4">
                                Especialização em manutenção industrial, mecânica automotiva e projetos
                                mecânicos para o setor produtivo.
                            </p>
                            <div class="course-details mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Duração</small>
                                        <strong>2 anos</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Período</small>
                                        <strong>Diurno</strong>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Mecânica Automotiva
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Manutenção Industrial
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Projetos Mecânicos
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#cursoModal"
                                data-course="mecanica">
                                <i class="bi bi-info-circle me-2"></i>Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Curso 3: Construção Civil -->
                <div class="col-lg-4 col-md-6 mb-4" data-area="engenharia" data-duration="3">
                    <div class="card h-100 border-0 shadow-sm course-card">
                        <div class="card-header bg-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">Construção Civil</h5>
                                <span class="badge bg-light text-primary">Engenharia</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="course-icon mb-3">
                                <i class="bi bi-building text-primary"></i>
                            </div>
                            <p class="text-muted mb-4">
                                Formação em técnicas construtivas, topografia, gestão de obras e
                                segurança na construção civil.
                            </p>
                            <div class="course-details mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Duração</small>
                                        <strong>3 anos</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Período</small>
                                        <strong>Diurno/Noturno</strong>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Topografia
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Gestão de Obras
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Segurança na Construção
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#cursoModal"
                                data-course="construcao">
                                <i class="bi bi-info-circle me-2"></i>Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Curso 4: Electrónica -->
                <div class="col-lg-4 col-md-6 mb-4" data-area="tecnologia" data-duration="2">
                    <div class="card h-100 border-0 shadow-sm course-card">
                        <div class="card-header bg-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">Electrónica</h5>
                                <span class="badge bg-light text-primary">Tecnologia</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="course-icon mb-3">
                                <i class="bi bi-cpu text-primary"></i>
                            </div>
                            <p class="text-muted mb-4">
                                Especialização em circuitos eletrónicos, automação industrial,
                                telecomunicações e sistemas embarcados.
                            </p>
                            <div class="course-details mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Duração</small>
                                        <strong>2 anos</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Período</small>
                                        <strong>Noturno</strong>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Circuitos Eletrónicos
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Automação Industrial
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Telecomunicações
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#cursoModal"
                                data-course="eletronica">
                                <i class="bi bi-info-circle me-2"></i>Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Curso 5: Gestão -->
                <div class="col-lg-4 col-md-6 mb-4" data-area="administracao" data-duration="3">
                    <div class="card h-100 border-0 shadow-sm course-card">
                        <div class="card-header bg-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">Gestão Empresarial</h5>
                                <span class="badge bg-light text-primary">Administração</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="course-icon mb-3">
                                <i class="bi bi-graph-up text-primary"></i>
                            </div>
                            <p class="text-muted mb-4">
                                Formação em gestão financeira, recursos humanos, marketing e
                                empreendedorismo para pequenas e médias empresas.
                            </p>
                            <div class="course-details mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Duração</small>
                                        <strong>3 anos</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Período</small>
                                        <strong>Noturno</strong>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Gestão Financeira
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Recursos Humanos
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Empreendedorismo
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#cursoModal"
                                data-course="gestao">
                                <i class="bi bi-info-circle me-2"></i>Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Curso 6: Enfermagem -->
                <div class="col-lg-4 col-md-6 mb-4" data-area="saude" data-duration="2">
                    <div class="card h-100 border-0 shadow-sm course-card">
                        <div class="card-header bg-primary text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">Enfermagem</h5>
                                <span class="badge bg-light text-primary">Saúde</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="course-icon mb-3">
                                <i class="bi bi-heart-pulse text-primary"></i>
                            </div>
                            <p class="text-muted mb-4">
                                Formação técnica em cuidados de saúde, primeiros socorros,
                                administração de medicamentos e assistência ao paciente.
                            </p>
                            <div class="course-details mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Duração</small>
                                        <strong>2 anos</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Período</small>
                                        <strong>Diurno</strong>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Cuidados Básicos
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Primeiros Socorros
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Saúde Comunitária
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#cursoModal"
                                data-course="enfermagem">
                                <i class="bi bi-info-circle me-2"></i>Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mensagem quando não há cursos -->
            <div class="text-center mt-5" id="noCoursesMessage" style="display: none;">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Nenhum curso encontrado com os filtros aplicados.
                </div>
            </div>
        </div>
    </section>

    <!-- Processo de Inscrição -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold text-primary mb-4">Como se Inscrever</h2>
                    <div class="process-step mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="step-number me-3">
                                <span
                                    class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">1</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Escolha o Curso</h5>
                                <p class="text-muted mb-0">Selecione o curso técnico que mais se adequa aos seus
                                    interesses e objetivos profissionais.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="step-number me-3">
                                <span
                                    class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">2</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Faça a Inscrição Online</h5>
                                <p class="text-muted mb-0">Preencha o formulário de inscrição com seus dados pessoais e
                                    informações académicas.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="step-number me-3">
                                <span
                                    class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">3</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Realize o Teste de Admissão</h5>
                                <p class="text-muted mb-0">Faça o teste online para avaliar seus conhecimentos básicos.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="step-number me-3">
                                <span
                                    class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">4</span>
                            </div>
                            <div>
                                <h5 class="fw-bold">Entrega de Documentos</h5>
                                <p class="text-muted mb-0">Envie os documentos necessários digitalmente pelo sistema.
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="inscricao.html" class="btn btn-primary btn-lg mt-3">
                        <i class="bi bi-pencil-square me-2"></i>Iniciar Inscrição
                    </a>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400/3b82f6/ffffff?text=Processo+de+Inscrição"
                        alt="Processo de Inscrição" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Perguntas Frequentes</h2>
                <p class="text-muted">Tire suas dúvidas sobre nossos cursos</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Qual é o horário das aulas?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Oferecemos períodos diurno (8h às 17h) e noturno (18h às 22h) para a maioria dos
                                    cursos.
                                    Alguns cursos específicos podem ter apenas um dos períodos disponíveis.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2">
                                    Há possibilidade de estágio?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim, todos os nossos cursos incluem estágio supervisionado como parte do currículo.
                                    Temos parcerias com diversas empresas para garantir oportunidades de estágio aos
                                    nossos alunos.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3">
                                    O certificado é reconhecido pelo Ministério da Educação?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim, todos os nossos cursos são reconhecidos e credenciados pelo Ministério da
                                    Educação de Angola.
                                    Nossos certificados têm validade nacional.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4">
                                    Posso transferir de curso?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim, é possível solicitar transferência entre cursos, desde que haja vagas
                                    disponíveis
                                    e o aluno atenda aos requisitos do novo curso. A transferência está sujeita à
                                    análise da coordenação.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Detalhes do Curso -->
    <div class="modal fade" id="cursoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="cursoModalTitle">
                        <i class="bi bi-info-circle me-2"></i>Detalhes do Curso
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="cursoModalContent">
                        <!-- Conteúdo será carregado via JavaScript -->
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Carregando...</span>
                            </div>
                            <p class="mt-3">Carregando informações do curso...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="inscricao.html" class="btn btn-primary">
                        <i class="bi bi-pencil-square me-2"></i>Inscrever-se
                    </a>
                </div>
            </div>
        </div>
    </div>

    <livewire:partials.footer />

</div>
