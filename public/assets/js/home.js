// JavaScript para a página inicial

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips do Bootstrap
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Animação de entrada dos elementos
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

    // Adicionar classe fade-in aos elementos
    const sections = document.querySelectorAll('section');
    sections.forEach((section, index) => {
        if (index > 0) { // Ignorar a primeira seção (hero)
            section.classList.add('fade-in');
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

            // Simulação de login (substituir por chamada AJAX real)
            showAlert('Login realizado com sucesso! Redirecionando...', 'success');

            // Em produção, aqui faria uma requisição AJAX para o backend
            setTimeout(() => {
                // Fechar modal após login bem-sucedido
                const modal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                if (modal) modal.hide();

                // Redirecionar para dashboard (simulação)
                console.log('Login realizado:', { email, password });

                // Limpar formulário
                loginForm.reset();

                // Aqui normalmente redirecionaria para o dashboard
                // window.location.href = '/dashboard';
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
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        // Adicionar alerta no topo da página
        document.body.insertBefore(alertDiv, document.body.firstChild);

        // Remover alerta automaticamente após 5 segundos
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Contador animado para estatísticas
    function animateCounters() {
        const counters = document.querySelectorAll('.stats-box h3');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target + (counter.textContent.includes('+') ? '+' : '');
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current) + (counter.textContent.includes('+') ? '+' : '');
                }
            }, 20);
        });
    }

    // Observador para animar contadores quando visíveis
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.bg-primary');
    if (statsSection) {
        observer.observe(statsSection);
    }

    // Smooth scroll para links internos
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

    // Adicionar classe active à navbar conforme scroll
    function updateNavbarActive() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollY >= (sectionTop - 100)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', updateNavbarActive);
});
