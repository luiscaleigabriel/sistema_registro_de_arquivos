// JavaScript para a página Sobre

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips do Bootstrap
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Galeria - Capturar cliques nas imagens
    const galleryItems = document.querySelectorAll('.gallery-item');
    const galleryModal = document.getElementById('galleryModal');
    const galleryModalImg = galleryModal ? galleryModal.querySelector('img') : null;
    const galleryModalDesc = galleryModal ? galleryModal.querySelector('p') : null;

    galleryItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            if (galleryModalImg) {
                const imgSrc = this.querySelector('img').src;
                const imgAlt = this.querySelector('img').alt;

                galleryModalImg.src = imgSrc;
                galleryModalImg.alt = imgAlt;
                galleryModalDesc.textContent = imgAlt;
            }
        });
    });

    // Animações ao rolar
    function animateOnScroll() {
        const elements = document.querySelectorAll('.fade-in-section');

        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementTop < windowHeight - 100) {
                element.classList.add('visible');
            }
        });
    }

    // Adicionar classe fade-in-section às seções
    const sections = document.querySelectorAll('section');
    sections.forEach((section, index) => {
        if (index > 0) { // Ignorar a primeira seção (hero)
            section.classList.add('fade-in-section');
        }
    });

    // Verificar animação ao carregar e ao rolar
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);

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

    // Função para mostrar alertas
    function showAlert(message, type) {
        // Remover alertas anteriores
        const existingAlert = document.querySelector('.alert');
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

    // Efeito parallax para hero section
    function parallaxEffect() {
        const heroSection = document.querySelector('.hero-sobre');
        if (heroSection) {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            heroSection.style.backgroundPosition = `center ${rate}px`;
        }
    }

    window.addEventListener('scroll', parallaxEffect);

    // Timeline interativa
    const timelineItems = document.querySelectorAll('.timeline-item');
    timelineItems.forEach((item, index) => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
            this.style.transition = 'transform 0.3s ease';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });

        // Adicionar delay para animação sequencial
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
            item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        }, index * 200);
    });

    // Sistema de tabs para valores (se necessário)
    const valueItems = document.querySelectorAll('.valores-list li');
    valueItems.forEach(item => {
        item.addEventListener('click', function() {
            valueItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            // Mostrar descrição detalhada do valor
            const valueName = this.textContent.trim();
            showValueDetails(valueName);
        });
    });

    function showValueDetails(valueName) {
        // Esta função pode ser expandida para mostrar mais detalhes
        console.log('Valor selecionado:', valueName);
    }

    // Contador para estatísticas (se adicionadas)
    function initCounters() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            let current = 0;
            const increment = target / 100;

            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        });
    }

    // Iniciar contadores quando a seção de estatísticas estiver visível
    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    initCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(statsSection);
    }

    // Navegação suave para âncoras internas
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
