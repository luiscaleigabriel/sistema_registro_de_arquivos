// JavaScript para a página de Cursos

document.addEventListener('DOMContentLoaded', function() {
    // Dados dos cursos (simulação - em produção viria de API)
    const cursosData = {
        informatica: {
            title: "Informática",
            area: "Tecnologia",
            duration: "3 anos",
            period: "Diurno/Noturno",
            vacancies: "40 vagas",
            description: "Formação completa em tecnologia da informação, preparando profissionais para o mercado digital.",
            fullDescription: `
                <p>O curso técnico de Informática do Instituto Politécnico 30 de Setembro prepara os alunos para atuarem
                como profissionais de TI capazes de desenvolver, implementar e manter sistemas computacionais.</p>

                <h5 class="mt-4">Objetivos do Curso</h5>
                <ul>
                    <li>Desenvolver habilidades em programação e análise de sistemas</li>
                    <li>Capacitar para a administração de redes de computadores</li>
                    <li>Ensinar manutenção preventiva e corretiva de hardware</li>
                    <li>Preparar para o desenvolvimento web e mobile</li>
                </ul>

                <h5 class="mt-4">Disciplinas Principais</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>Algoritmos e Programação</li>
                            <li>Banco de Dados</li>
                            <li>Redes de Computadores</li>
                            <li>Desenvolvimento Web</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>Análise de Sistemas</li>
                            <li>Segurança da Informação</li>
                            <li>Manutenção de Computadores</li>
                            <li>Empreendedorismo Digital</li>
                        </ul>
                    </div>
                </div>

                <h5 class="mt-4">Mercado de Trabalho</h5>
                <p>O profissional formado pode atuar como:</p>
                <ul>
                    <li>Desenvolvedor de Software</li>
                    <li>Analista de Sistemas</li>
                    <li>Técnico em Redes</li>
                    <li>Suporte Técnico</li>
                    <li>Administrador de Banco de Dados</li>
                </ul>

                <h5 class="mt-4">Requisitos de Ingresso</h5>
                <ul>
                    <li>Ensino Médio completo ou equivalente</li>
                    <li>Aprovação no teste de admissão</li>
                    <li>Documentação completa (BI, certificados)</li>
                </ul>

                <div class="alert alert-info mt-4">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Investimento:</strong> Mensalidade de 25.000 Kz/mês. Possibilidade de bolsas de estudo para casos específicos.
                </div>
            `,
            professores: [
                { nome: "Prof. João Silva", especialidade: "Desenvolvimento" },
                { nome: "Prof. Maria Santos", especialidade: "Redes" },
                { nome: "Prof. Carlos Mendes", especialidade: "Banco de Dados" }
            ]
        },
        mecanica: {
            title: "Mecânica Industrial",
            area: "Engenharia",
            duration: "2 anos",
            period: "Diurno",
            vacancies: "30 vagas",
            description: "Especialização em manutenção industrial e mecânica automotiva.",
            fullDescription: `
                <p>Formação técnica especializada em mecânica para atuação no setor industrial e automotivo.</p>

                <h5 class="mt-4">Objetivos do Curso</h5>
                <ul>
                    <li>Capacitar para manutenção de máquinas industriais</li>
                    <li>Ensinar mecânica automotiva moderna</li>
                    <li>Desenvolver habilidades em projetos mecânicos</li>
                    <li>Preparar para gestão de manutenção</li>
                </ul>

                <h5 class="mt-4">Disciplinas Principais</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>Mecânica Técnica</li>
                            <li>Manutenção Industrial</li>
                            <li>Mecânica Automotiva</li>
                            <li>Desenho Técnico</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>Metrologia</li>
                            <li>Gestão da Manutenção</li>
                            <li>Segurança Industrial</li>
                            <li>Projetos Mecânicos</li>
                        </ul>
                    </div>
                </div>
            `,
            professores: [
                { nome: "Prof. António Costa", especialidade: "Mecânica Industrial" },
                { nome: "Prof. Pedro Almeida", especialidade: "Automotiva" }
            ]
        },
        construcao: {
            title: "Construção Civil",
            area: "Engenharia",
            duration: "3 anos",
            period: "Diurno/Noturno",
            vacancies: "35 vagas",
            description: "Formação em técnicas construtivas, topografia e gestão de obras.",
            fullDescription: `
                <p>Prepara profissionais para atuarem em todas as fases da construção civil, desde o projeto até a execução.</p>

                <h5 class="mt-4">Objetivos do Curso</h5>
                <ul>
                    <li>Capacitar para leitura e execução de projetos</li>
                    <li>Ensinar técnicas construtivas modernas</li>
                    <li>Desenvolver habilidades em topografia</li>
                    <li>Preparar para gestão de obras</li>
                </ul>
            `,
            professores: [
                { nome: "Prof. Ana Pereira", especialidade: "Construção" },
                { nome: "Prof. Miguel Santos", especialidade: "Topografia" }
            ]
        }
        // Outros cursos seguiriam o mesmo padrão
    };

    // Sistema de Filtros
    const searchInput = document.getElementById('searchCourse');
    const filterArea = document.getElementById('filterArea');
    const filterDuration = document.getElementById('filterDuration');
    const coursesContainer = document.getElementById('coursesContainer');
    const noCoursesMessage = document.getElementById('noCoursesMessage');
    const courseCards = document.querySelectorAll('.course-card');

    function filterCourses() {
        const searchTerm = searchInput.value.toLowerCase();
        const areaFilter = filterArea.value;
        const durationFilter = filterDuration.value;

        let visibleCount = 0;

        courseCards.forEach(card => {
            const courseElement = card.closest('[data-area]');
            const courseArea = courseElement.getAttribute('data-area');
            const courseDuration = courseElement.getAttribute('data-duration');
            const courseTitle = courseElement.querySelector('.card-header h5').textContent.toLowerCase();
            const courseDescription = courseElement.querySelector('.text-muted').textContent.toLowerCase();

            const matchesSearch = searchTerm === '' ||
                courseTitle.includes(searchTerm) ||
                courseDescription.includes(searchTerm);

            const matchesArea = areaFilter === '' || courseArea === areaFilter;
            const matchesDuration = durationFilter === '' || courseDuration === durationFilter;

            if (matchesSearch && matchesArea && matchesDuration) {
                courseElement.classList.remove('hidden');
                visibleCount++;

                // Adicionar efeito de animação
                courseElement.style.animation = 'fadeIn 0.5s ease';
            } else {
                courseElement.classList.add('hidden');
            }
        });

        // Mostrar/ocultar mensagem de nenhum curso
        if (visibleCount === 0) {
            noCoursesMessage.style.display = 'block';
        } else {
            noCoursesMessage.style.display = 'none';
        }

        // Animar a aparição dos cursos
        animateCourses();
    }

    // Adicionar event listeners aos filtros
    searchInput.addEventListener('input', filterCourses);
    filterArea.addEventListener('change', filterCourses);
    filterDuration.addEventListener('change', filterCourses);

    // Modal de Detalhes do Curso
    const cursoModal = document.getElementById('cursoModal');
    const cursoModalTitle = document.getElementById('cursoModalTitle');
    const cursoModalContent = document.getElementById('cursoModalContent');

    if (cursoModal) {
        cursoModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const courseId = button.getAttribute('data-course');
            const courseData = cursosData[courseId];

            if (courseData) {
                cursoModalTitle.innerHTML = `
                    <i class="bi bi-info-circle me-2"></i>
                    ${courseData.title} - ${courseData.area}
                `;

                cursoModalContent.innerHTML = `
                    <div class="course-details-modal">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="info-box">
                                    <small class="text-muted d-block">Duração</small>
                                    <strong class="fs-5">${courseData.duration}</strong>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box">
                                    <small class="text-muted d-block">Período</small>
                                    <strong class="fs-5">${courseData.period}</strong>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box">
                                    <small class="text-muted d-block">Vagas</small>
                                    <strong class="fs-5">${courseData.vacancies}</strong>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box">
                                    <small class="text-muted d-block">Área</small>
                                    <strong class="fs-5">${courseData.area}</strong>
                                </div>
                            </div>
                        </div>

                        <h5>Descrição do Curso</h5>
                        <p class="text-muted">${courseData.description}</p>

                        ${courseData.fullDescription}

                        ${courseData.professores ? `
                            <h5 class="mt-4">Corpo Docente</h5>
                            <div class="teacher-grid">
                                ${courseData.professores.map(prof => `
                                    <div class="teacher-card">
                                        <div class="teacher-img bg-primary text-white d-flex align-items-center justify-content-center">
                                            ${prof.nome.split(' ')[0].charAt(0)}${prof.nome.split(' ')[1].charAt(0)}
                                        </div>
                                        <h6 class="mb-1">${prof.nome}</h6>
                                        <small class="text-muted">${prof.especialidade}</small>
                                    </div>
                                `).join('')}
                            </div>
                        ` : ''}

                        <div class="alert alert-success mt-4">
                            <i class="bi bi-calendar-check me-2"></i>
                            <strong>Início das Aulas:</strong> Próxima turma inicia em 15 de Março de 2024.
                        </div>
                    </div>
                `;
            } else {
                cursoModalContent.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Informações do curso não disponíveis no momento.
                    </div>
                `;
            }
        });
    }

    // Animações ao rolar
    function animateOnScroll() {
        const elements = document.querySelectorAll('.fade-in');

        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementTop < windowHeight - 100) {
                element.classList.add('visible');
            }
        });
    }

    // Adicionar classe fade-in aos cards
    courseCards.forEach(card => {
        card.classList.add('fade-in');
    });

    // Verificar animação ao carregar e ao rolar
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);

    // Animar cards sequencialmente
    function animateCourses() {
        const visibleCards = document.querySelectorAll('.course-card:not(.hidden)');

        visibleCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // Inicializar animação dos cursos
    animateCourses();

    // Sistema de interesse nos cursos (simulação)
    const interestButtons = document.querySelectorAll('.btn-interest');
    interestButtons.forEach(button => {
        button.addEventListener('click', function() {
            const courseTitle = this.closest('.course-card').querySelector('h5').textContent;

            // Alternar estado de interesse
            if (this.classList.contains('btn-outline-primary')) {
                this.classList.remove('btn-outline-primary');
                this.classList.add('btn-danger');
                this.innerHTML = '<i class="bi bi-heart-fill me-2"></i>Interessado';

                showAlert(`Você demonstrou interesse no curso de ${courseTitle}!`, 'success');
                saveInterest(courseTitle, true);
            } else {
                this.classList.remove('btn-danger');
                this.classList.add('btn-outline-primary');
                this.innerHTML = '<i class="bi bi-heart me-2"></i>Tenho Interesse';

                showAlert(`Interesse removido do curso de ${courseTitle}.`, 'info');
                saveInterest(courseTitle, false);
            }
        });
    });

    // Salvar interesse no localStorage (simulação)
    function saveInterest(courseName, interested) {
        let interests = JSON.parse(localStorage.getItem('courseInterests')) || {};
        interests[courseName] = interested;
        localStorage.setItem('courseInterests', JSON.stringify(interests));
    }

    // Carregar interesses salvos
    function loadInterests() {
        const interests = JSON.parse(localStorage.getItem('courseInterests')) || {};

        courseCards.forEach(card => {
            const courseTitle = card.querySelector('h5').textContent;
            const interestButton = card.querySelector('.btn-interest');

            if (interestButton && interests[courseTitle]) {
                interestButton.classList.remove('btn-outline-primary');
                interestButton.classList.add('btn-danger');
                interestButton.innerHTML = '<i class="bi bi-heart-fill me-2"></i>Interessado';
            }
        });
    }

    // Carregar interesses ao iniciar
    loadInterests();

    // Função para mostrar alertas
    function showAlert(message, type) {
        // Remover alertas anteriores
        const existingAlert = document.querySelector('.alert:not(.course-details-modal .alert)');
        if (existingAlert) existingAlert.remove();

        // Criar novo alerta
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
        alertDiv.style.zIndex = '1060';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(alertDiv);

        // Remover alerta automaticamente após 5 segundos
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Formulário de Login
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            // Validação básica
            if (!email || !password) {
                showAlert('Por favor, preencha todos os campos.', 'danger');
                return;
            }

            if (!isValidEmail(email)) {
                showAlert('Por favor, insira um email válido.', 'danger');
                return;
            }

            // Simulação de login
            showAlert('Login realizado com sucesso! Redirecionando...', 'success');

            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                if (modal) modal.hide();

                console.log('Login realizado:', { email, password });
                loginForm.reset();
            }, 1500);
        });
    }

    // Função auxiliar para validar email
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // FAQ Accordion - Abrir primeiro item por padrão
    const firstAccordionItem = document.querySelector('.accordion-button');
    if (firstAccordionItem) {
        firstAccordionItem.classList.remove('collapsed');
        firstAccordionItem.setAttribute('aria-expanded', 'true');
        document.querySelector(firstAccordionItem.getAttribute('data-bs-target')).classList.add('show');
    }

    // Efeito de digitação no hero (opcional)
    function typeWriterEffect() {
        const heroTitle = document.querySelector('.hero-cursos h1 .text-secondary');
        if (!heroTitle) return;

        const originalText = heroTitle.textContent;
        heroTitle.textContent = '';
        let i = 0;

        function type() {
            if (i < originalText.length) {
                heroTitle.textContent += originalText.charAt(i);
                i++;
                setTimeout(type, 100);
            }
        }

        type();
    }

    // Iniciar efeito de digitação após um delay
    setTimeout(typeWriterEffect, 500);

    // Navegação suave
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});
