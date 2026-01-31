// JavaScript para o Dashboard (Login e Painel do Aluno)

document.addEventListener('DOMContentLoaded', function() {
    // Verificar se estamos na página de login ou no dashboard
    if (document.getElementById('loginForm')) {
        initLoginPage();
    } else {
        initDashboard();
    }
});

// Inicializar página de login
function initLoginPage() {
    const loginForm = document.getElementById('loginForm');
    const recoveryForm = document.getElementById('recoveryForm');
    const forgotPasswordLink = document.getElementById('forgotPassword');
    const recoveryModal = new bootstrap.Modal(document.getElementById('recoveryModal'));

    // Dados de usuários simulados (em produção viria de API)
    const users = {
        student: {
            email: "aluno@instituto.ao",
            password: "123456",
            name: "João da Silva",
            type: "student"
        },
        secretary: {
            email: "secretaria@instituto.ao",
            password: "123456",
            name: "Maria Santos",
            type: "secretary"
        },
        admin: {
            email: "admin@instituto.ao",
            password: "123456",
            name: "Administrador",
            type: "admin"
        }
    };

    // Configurar formulário de login
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const userType = document.querySelector('input[name="userType"]:checked').id;
        const rememberMe = document.getElementById('rememberMe').checked;

        // Validação básica
        if (!email || !password) {
            showAlert('Por favor, preencha todos os campos.', 'danger');
            return;
        }

        if (!isValidEmail(email)) {
            showAlert('Por favor, insira um email válido.', 'danger');
            return;
        }

        // Simulação de autenticação
        const user = authenticateUser(email, password, userType);

        if (user) {
            showAlert('Login realizado com sucesso! Redirecionando...', 'success');

            // Salvar dados do usuário (simulação)
            if (rememberMe) {
                localStorage.setItem('rememberedUser', JSON.stringify({
                    email: user.email,
                    type: user.type
                }));
            }

            // Redirecionar baseado no tipo de usuário
            setTimeout(() => {
                switch(user.type) {
                    case 'student':
                        window.location.href = 'dashboard/aluno/index.html';
                        break;
                    case 'secretary':
                        window.location.href = 'dashboard/secretaria/index.html';
                        break;
                    case 'admin':
                        window.location.href = 'dashboard/admin/index.html';
                        break;
                }
            }, 1500);
        } else {
            showAlert('Email ou senha incorretos.', 'danger');
        }
    });

    // Recuperação de senha
    forgotPasswordLink.addEventListener('click', function(e) {
        e.preventDefault();
        recoveryModal.show();
    });

    recoveryForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('recoveryEmail').value;

        if (!email || !isValidEmail(email)) {
            showAlert('Por favor, insira um email válido.', 'danger');
            return;
        }

        // Simulação de envio de email
        showAlert('Link de recuperação enviado para seu email.', 'success');
        recoveryModal.hide();
        recoveryForm.reset();
    });

    // Função de autenticação simulada
    function authenticateUser(email, password, userType) {
        const user = users[userType];

        if (user && user.email === email && user.password === password) {
            // Simular token de autenticação
            const authData = {
                token: 'simulated_token_' + Date.now(),
                user: {
                    id: 1,
                    name: user.name,
                    email: user.email,
                    type: user.type
                },
                expires: Date.now() + (24 * 60 * 60 * 1000) // 24 horas
            };

            localStorage.setItem('authData', JSON.stringify(authData));
            sessionStorage.setItem('currentUser', JSON.stringify(user));

            return user;
        }

        return null;
    }

    // Carregar usuário lembrado
    const rememberedUser = localStorage.getItem('rememberedUser');
    if (rememberedUser) {
        const user = JSON.parse(rememberedUser);
        document.getElementById('email').value = user.email;

        // Marcar o tipo de usuário correto
        document.getElementById(user.type).checked = true;
        document.getElementById('rememberMe').checked = true;
    }
}

// Inicializar dashboard do aluno
function initDashboard() {
    // Elementos do DOM
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const printReceiptBtn = document.getElementById('printReceipt');
    const recentDocumentsTable = document.getElementById('recentDocuments');

    // Dados do aluno (simulação - em produção viria da API)
    const studentData = {
        id: 1,
        name: "João da Silva",
        email: "joao.silva@email.com",
        phone: "+244 922 123 456",
        bi: "123456789LA123",
        address: "Luanda, Angola",
        birthDate: "2000-05-15",
        course: "Informática",
        period: "Noturno",
        status: "em analise",
        testScore: 85,
        totalScore: 100,
        documents: [
            {
                id: 1,
                name: "Bilhete de Identidade",
                type: "BI",
                uploadedAt: "2024-01-15",
                status: "aprovado",
                fileUrl: "#"
            },
            {
                id: 2,
                name: "Certificado de Ensino Médio",
                type: "Certificado",
                uploadedAt: "2024-01-16",
                status: "em analise",
                fileUrl: "#"
            },
            {
                id: 3,
                name: "Atestado Médico",
                type: "Atestado Medico",
                uploadedAt: "2024-01-18",
                status: "aprovado",
                fileUrl: "#"
            }
        ]
    };

    // Inicializar dashboard
    loadStudentData();
    loadRecentDocuments();
    setupEventListeners();
    updateBadges();

    function loadStudentData() {
        // Atualizar informações do aluno na interface
        document.getElementById('sidebarUserName').textContent = studentData.name;
        document.getElementById('sidebarUserEmail').textContent = studentData.email;
        document.getElementById('topbarUserName').textContent = studentData.name.split(' ')[0]; // Primeiro nome

        // Status
        const statusText = document.getElementById('statusText');
        const statusBadge = document.getElementById('sidebarUserStatus');

        switch(studentData.status) {
            case 'aprovado':
                statusText.textContent = 'Aprovado';
                statusText.className = 'text-success';
                statusBadge.textContent = 'Aprovado';
                statusBadge.className = 'badge bg-success';
                break;
            case 'reprovado':
                statusText.textContent = 'Reprovado';
                statusText.className = 'text-danger';
                statusBadge.textContent = 'Reprovado';
                statusBadge.className = 'badge bg-danger';
                break;
            case 'em analise':
                statusText.textContent = 'Em Análise';
                statusText.className = 'text-warning';
                statusBadge.textContent = 'Em análise';
                statusBadge.className = 'badge bg-warning';
                break;
            default:
                statusText.textContent = 'Pendente';
                statusText.className = 'text-secondary';
                statusBadge.textContent = 'Pendente';
                statusBadge.className = 'badge bg-secondary';
        }

        // Documentos
        const approvedDocs = studentData.documents.filter(doc => doc.status === 'aprovado').length;
        const totalDocs = studentData.documents.length;

        document.getElementById('docCount').textContent = `${approvedDocs}/${totalDocs}`;
        document.getElementById('docStatus').textContent = approvedDocs === totalDocs ? 'Todos aprovados' : 'Pendente';
        document.getElementById('docStatus').className = approvedDocs === totalDocs ? 'text-success' : 'text-warning';

        // Nota do teste
        document.getElementById('testScore').textContent = studentData.testScore;
        const testStatus = document.getElementById('testStatus');
        testStatus.textContent = studentData.testScore >= 50 ? 'Aprovado' : 'Reprovado';
        testStatus.className = studentData.testScore >= 50 ? 'text-success' : 'text-danger';

        // Curso
        document.getElementById('courseName').textContent = studentData.course;
        document.getElementById('coursePeriod').textContent = `Período: ${studentData.period}`;
    }

    function loadRecentDocuments() {
        if (!recentDocumentsTable) return;

        recentDocumentsTable.innerHTML = '';

        studentData.documents.forEach(doc => {
            const row = document.createElement('tr');

            let statusClass = '';
            let statusText = '';

            switch(doc.status) {
                case 'aprovado':
                    statusClass = 'aprovado';
                    statusText = 'Aprovado';
                    break;
                case 'reprovado':
                    statusClass = 'reprovado';
                    statusText = 'Reprovado';
                    break;
                case 'em analise':
                    statusClass = 'em-analise';
                    statusText = 'Em Análise';
                    break;
                default:
                    statusClass = 'pendente';
                    statusText = 'Pendente';
            }

            row.innerHTML = `
                <td>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-file-earmark-text fs-4 text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">${doc.name}</h6>
                            <small class="text-muted">${doc.type}</small>
                        </div>
                    </div>
                </td>
                <td>${formatDate(doc.uploadedAt)}</td>
                <td>
                    <span class="status-badge ${statusClass}">${statusText}</span>
                </td>
                <td>
                    <button class="btn btn-sm btn-outline-primary me-1 view-document" data-id="${doc.id}">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-success download-document" data-id="${doc.id}">
                        <i class="bi bi-download"></i>
                    </button>
                </td>
            `;

            recentDocumentsTable.appendChild(row);
        });
    }

    function setupEventListeners() {
        // Toggle sidebar em mobile
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }

        // Fechar sidebar ao clicar fora (mobile)
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992 &&
                !sidebar.contains(e.target) &&
                !sidebarToggle.contains(e.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });

        // Imprimir comprovante
        if (printReceiptBtn) {
            printReceiptBtn.addEventListener('click', function() {
                printReceipt();
            });
        }

        // Modal de perfil
        const profileModal = document.getElementById('profileModal');
        if (profileModal) {
            profileModal.addEventListener('show.bs.modal', function() {
                loadProfileContent();
            });
        }

        // Alterar senha
        const changePasswordForm = document.getElementById('changePasswordForm');
        if (changePasswordForm) {
            changePasswordForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const currentPassword = document.getElementById('currentPassword').value;
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmNewPassword').value;

                if (!currentPassword || !newPassword || !confirmPassword) {
                    showAlert('Por favor, preencha todos os campos.', 'danger');
                    return;
                }

                if (newPassword.length < 6) {
                    showAlert('A nova senha deve ter pelo menos 6 caracteres.', 'danger');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    showAlert('As senhas não coincidem.', 'danger');
                    return;
                }

                // Simulação de alteração de senha
                showAlert('Senha alterada com sucesso!', 'success');
                changePasswordForm.reset();
                bootstrap.Modal.getInstance(changePasswordForm.closest('.modal')).hide();
            });
        }

        // Documentos - visualizar
        document.addEventListener('click', function(e) {
            if (e.target.closest('.view-document')) {
                const docId = e.target.closest('.view-document').getAttribute('data-id');
                viewDocument(docId);
            }

            if (e.target.closest('.download-document')) {
                const docId = e.target.closest('.download-document').getAttribute('data-id');
                downloadDocument(docId);
            }
        });

        // Calendário
        const calendarModal = document.getElementById('calendarModal');
        if (calendarModal) {
            calendarModal.addEventListener('show.bs.modal', function() {
                loadCalendarEvents();
            });
        }

        // Ajuda
        const helpModal = document.getElementById('helpModal');
        if (helpModal) {
            helpModal.addEventListener('show.bs.modal', function() {
                loadHelpContent();
            });
        }

        // Logout
        const logoutLinks = document.querySelectorAll('a[href="../../index.html"]');
        logoutLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                logout();
            });
        });
    }

    function updateBadges() {
        const pendingDocs = studentData.documents.filter(doc =>
            doc.status === 'em analise' || doc.status === 'pendente'
        ).length;

        const docBadge = document.getElementById('docBadge');
        if (docBadge && pendingDocs > 0) {
            docBadge.textContent = pendingDocs;
            docBadge.style.display = 'inline-block';
        } else if (docBadge) {
            docBadge.style.display = 'none';
        }
    }

    function loadProfileContent() {
        const profileContent = document.getElementById('profileContent');

        profileContent.innerHTML = `
            <div class="row">
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <div class="user-avatar-lg mb-3">
                        <img src="https://via.placeholder.com/150/1e3a8a/ffffff?text=JS" alt="Aluno" class="avatar-img-lg">
                    </div>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-camera me-2"></i>Alterar Foto
                    </button>
                </div>

                <div class="col-md-8">
                    <form id="profileForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="profileName"
                                           value="${studentData.name}" readonly>
                                    <label for="profileName">Nome Completo</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="profileEmail"
                                           value="${studentData.email}" readonly>
                                    <label for="profileEmail">Email</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="profilePhone"
                                           value="${studentData.phone}">
                                    <label for="profilePhone">Telefone</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="profileBirthDate"
                                           value="${studentData.birthDate}">
                                    <label for="profileBirthDate">Data de Nascimento</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="profileBI"
                                           value="${studentData.bi}">
                                    <label for="profileBI">Bilhete de Identidade</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="profileAddress"
                                              style="height: 100px">${studentData.address}</textarea>
                                    <label for="profileAddress">Morada</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Salvar Alterações
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        `;

        // Configurar formulário de perfil
        const profileForm = document.getElementById('profileForm');
        if (profileForm) {
            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Simulação de atualização
                showAlert('Perfil atualizado com sucesso!', 'success');
                bootstrap.Modal.getInstance(profileForm.closest('.modal')).hide();
            });
        }
    }

    function loadCalendarEvents() {
        const calendarContent = document.querySelector('.calendar-events');

        const events = [
            {
                date: '2024-03-15',
                title: 'Início das Aulas',
                description: 'Início do semestre letivo 2024.1',
                type: 'academico'
            },
            {
                date: '2024-03-22',
                title: 'Prazo para Entrega de Documentos',
                description: 'Último dia para entrega de documentos pendentes',
                type: 'documentos'
            },
            {
                date: '2024-04-05',
                title: 'Primeira Avaliação',
                description: 'Avaliação parcial do primeiro módulo',
                type: 'avaliacao'
            },
            {
                date: '2024-05-01',
                title: 'Feriado - Dia do Trabalhador',
                description: 'Não haverá aulas',
                type: 'feriado'
            }
        ];

        let html = '<div class="timeline">';

        events.forEach(event => {
            const date = new Date(event.date);
            const formattedDate = date.toLocaleDateString('pt-AO', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });

            let typeClass = '';
            switch(event.type) {
                case 'academico':
                    typeClass = 'bg-primary';
                    break;
                case 'documentos':
                    typeClass = 'bg-warning';
                    break;
                case 'avaliacao':
                    typeClass = 'bg-danger';
                    break;
                case 'feriado':
                    typeClass = 'bg-success';
                    break;
            }

            html += `
                <div class="timeline-item">
                    <div class="timeline-marker ${typeClass}"></div>
                    <div class="timeline-content">
                        <h6 class="fw-bold mb-1">${event.title}</h6>
                        <p class="small text-muted mb-1">${formattedDate}</p>
                        <p class="small mb-0">${event.description}</p>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        calendarContent.innerHTML = html;
    }

    function loadHelpContent() {
        const helpContent = document.getElementById('helpContent');

        helpContent.innerHTML = `
            <div class="accordion" id="helpAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#help1">
                            Como enviar documentos?
                        </button>
                    </h2>
                    <div id="help1" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Acesse a seção <strong>"Meus Documentos"</strong> no menu lateral. Clique no botão "Enviar Documento" e selecione o arquivo desejado. Formatos aceitos: PDF, JPG, PNG. Tamanho máximo: 5MB por arquivo.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#help2">
                            Como ver o status da minha inscrição?
                        </button>
                    </h2>
                    <div id="help2" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>No <strong>Painel Principal</strong>, você verá uma linha do tempo com o status de cada etapa do processo. A seção "Status do Seu Processo" mostra detalhadamente cada fase.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#help3">
                            Quando receberei o resultado do teste?
                        </button>
                    </h2>
                    <div id="help3" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>O resultado do teste de admissão é disponibilizado em até <strong>48 horas úteis</strong> após a realização. Você será notificado por email e poderá consultar na seção "Resultado do Teste".</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3">Canais de Atendimento</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="bi bi-telephone fs-1 text-primary mb-3"></i>
                                <h6>Telefone</h6>
                                <p class="small">(222) 123-456</p>
                                <small class="text-muted">Seg-Sex: 8h-18h</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="bi bi-envelope fs-1 text-primary mb-3"></i>
                                <h6>Email</h6>
                                <p class="small">suporte@instituto.ao</p>
                                <small class="text-muted">Resposta em até 24h</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <i class="bi bi-chat-left-text fs-1 text-primary mb-3"></i>
                                <h6>Chat Online</h6>
                                <p class="small">Disponível no horário comercial</p>
                                <button class="btn btn-sm btn-primary mt-2">Iniciar Chat</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function printReceipt() {
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Comprovante de Inscrição - ${studentData.name}</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        .header { text-align: center; margin-bottom: 30px; }
                        .info { margin: 20px 0; }
                        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; }
                        .info-label { font-weight: bold; }
                        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #666; }
                        .qr-code { text-align: center; margin: 30px 0; }
                        @media print {
                            .no-print { display: none; }
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h2>Instituto Politécnico 30 de Setembro</h2>
                        <h3>Comprovante de Inscrição</h3>
                        <p>Nº ${studentData.id.toString().padStart(6, '0')}</p>
                    </div>

                    <div class="info">
                        <div class="info-row">
                            <span class="info-label">Candidato:</span>
                            <span>${studentData.name}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email:</span>
                            <span>${studentData.email}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Curso:</span>
                            <span>${studentData.course}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Período:</span>
                            <span>${studentData.period}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Data da Inscrição:</span>
                            <span>${new Date().toLocaleDateString('pt-AO')}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span>${studentData.status === 'em analise' ? 'Em Análise' : studentData.status}</span>
                        </div>
                    </div>

                    <div class="qr-code">
                        <p>Use este código para consultar seu status:</p>
                        <div style="background: #f0f0f0; padding: 20px; display: inline-block;">
                            CÓDIGO: INS${studentData.id.toString().padStart(6, '0')}
                        </div>
                    </div>

                    <div class="footer">
                        <p>Este comprovante foi gerado automaticamente pelo sistema.</p>
                        <p>Para verificar a autenticidade, acesse: https://instituto30setembro.ao/verificar</p>
                        <p>Data de emissão: ${new Date().toLocaleString('pt-AO')}</p>
                    </div>

                    <div class="footer no-print">
                        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Imprimir
                        </button>
                        <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
                            Fechar
                        </button>
                    </div>
                </body>
            </html>
        `);
        printWindow.document.close();
    }

    function viewDocument(docId) {
        const doc = studentData.documents.find(d => d.id == docId);
        if (doc) {
            showAlert(`Visualizando documento: ${doc.name}`, 'info');
            // Em produção, abriria o documento em uma nova janela ou modal
        }
    }

    function downloadDocument(docId) {
        const doc = studentData.documents.find(d => d.id == docId);
        if (doc) {
            showAlert(`Baixando documento: ${doc.name}`, 'success');
            // Em produção, iniciaria o download do arquivo
        }
    }

    function logout() {
        // Limpar dados de autenticação
        localStorage.removeItem('authData');
        sessionStorage.removeItem('currentUser');

        // Redirecionar para página inicial
        window.location.href = '../../index.html';
    }
}

// Funções auxiliares
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('pt-AO', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    });
}

function showAlert(message, type) {
    // Remover alertas anteriores
    const existingAlert = document.querySelector('.alert.fixed-alert');
    if (existingAlert) existingAlert.remove();

    // Criar novo alerta
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show fixed-alert position-fixed top-0 start-50 translate-middle-x mt-3`;
    alertDiv.style.zIndex = '9999';
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
