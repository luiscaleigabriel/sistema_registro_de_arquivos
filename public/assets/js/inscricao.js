// JavaScript para a página de Inscrição

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const form = document.getElementById('inscricaoForm');
    const steps = document.querySelectorAll('.form-step');
    const progressBar = document.querySelector('.progress-bar');
    const stepElements = document.querySelectorAll('.step');
    const nextButtons = document.querySelectorAll('.btn-next');
    const prevButtons = document.querySelectorAll('.btn-prev');
    const dropzones = document.querySelectorAll('.dropzone');
    const fileInputs = document.querySelectorAll('input[type="file"]');
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));

    // Dados do formulário
    let formData = {
        pessoal: {},
        academico: {},
        documentos: {}
    };

    // Estado atual do formulário
    let currentStep = 1;
    const totalSteps = 4;

    // Inicializar formulário
    initForm();

    function initForm() {
        // Configurar validação do Bootstrap
        form.addEventListener('submit', handleSubmit);

        // Configurar navegação entre passos
        nextButtons.forEach(button => {
            button.addEventListener('click', handleNextStep);
        });

        prevButtons.forEach(button => {
            button.addEventListener('click', handlePrevStep);
        });

        // Configurar upload de arquivos
        initFileUpload();

        // Configurar validação em tempo real
        initRealTimeValidation();

        // Configurar máscaras para campos
        initInputMasks();

        // Carregar dados salvos (se houver)
        loadSavedData();
    }

    // Navegação para o próximo passo
    function handleNextStep(e) {
        e.preventDefault();
        const nextStepId = e.target.getAttribute('data-next');
        const currentStepId = `step${currentStep}`;

        // Validar passo atual antes de avançar
        if (validateStep(currentStep)) {
            saveStepData(currentStep);
            showStep(nextStepId);
            updateProgress();
        }
    }

    // Navegação para o passo anterior
    function handlePrevStep(e) {
        e.preventDefault();
        const prevStepId = e.target.getAttribute('data-prev');
        showStep(prevStepId);
        updateProgress();
    }

    // Mostrar um passo específico
    function showStep(stepId) {
        // Atualizar passo atual
        currentStep = parseInt(stepId.replace('step', ''));

        // Esconder todos os passos
        steps.forEach(step => {
            step.classList.remove('active');
            step.style.display = 'none';
        });

        // Mostrar passo atual
        const currentStepElement = document.getElementById(stepId);
        currentStepElement.classList.add('active');
        currentStepElement.style.display = 'block';

        // Atualizar classes dos steps na parte superior
        updateStepIndicators();

        // Se for o passo de revisão, preencher com os dados
        if (stepId === 'step4') {
            populateReviewStep();
        }

        // Rolar para o topo do formulário
        document.querySelector('.card-body').scrollIntoView({ behavior: 'smooth' });
    }

    // Atualizar indicadores de progresso
    function updateProgress() {
        const percentage = (currentStep / totalSteps) * 100;
        progressBar.style.width = `${percentage}%`;
        progressBar.setAttribute('aria-valuenow', percentage);
        progressBar.textContent = `Passo ${currentStep} de ${totalSteps}`;
    }

    // Atualizar indicadores visuais dos passos
    function updateStepIndicators() {
        stepElements.forEach((step, index) => {
            const stepNumber = index + 1;
            step.classList.remove('active', 'completed');

            if (stepNumber === currentStep) {
                step.classList.add('active');
            } else if (stepNumber < currentStep) {
                step.classList.add('completed');
            }
        });
    }

    // Validar passo atual
    function validateStep(stepNumber) {
        const stepElement = document.getElementById(`step${stepNumber}`);
        const inputs = stepElement.querySelectorAll('input, select, textarea, [required]');
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required')) {
                if (!input.value.trim()) {
                    markAsInvalid(input);
                    isValid = false;
                } else {
                    markAsValid(input);

                    // Validações específicas
                    if (input.type === 'email' && !isValidEmail(input.value)) {
                        markAsInvalid(input, 'Por favor, informe um email válido.');
                        isValid = false;
                    }

                    if (input.id === 'senha' && input.value.length < 6) {
                        markAsInvalid(input, 'A senha deve ter pelo menos 6 caracteres.');
                        isValid = false;
                    }

                    if (input.id === 'confirmarSenha' && input.value !== document.getElementById('senha').value) {
                        markAsInvalid(input, 'As senhas não coincidem.');
                        isValid = false;
                    }
                }
            }
        });

        // Validação especial para arquivos no passo 3
        if (stepNumber === 3) {
            const requiredFiles = ['biFile', 'certificadoFile'];
            requiredFiles.forEach(fileId => {
                const fileInput = document.getElementById(fileId);
                if (!fileInput.files.length) {
                    markAsInvalid(fileInput);
                    isValid = false;
                }
            });
        }

        if (!isValid) {
            showAlert('Por favor, preencha todos os campos obrigatórios corretamente.', 'danger');
        }

        return isValid;
    }

    // Salvar dados do passo atual
    function saveStepData(stepNumber) {
        const stepElement = document.getElementById(`step${stepNumber}`);
        const inputs = stepElement.querySelectorAll('input, select, textarea');

        inputs.forEach(input => {
            const fieldName = input.id || input.name;

            if (fieldName) {
                if (input.type === 'file') {
                    // Salvar informações dos arquivos
                    formData.documentos[fieldName] = {
                        files: Array.from(input.files),
                        name: input.files[0]?.name || ''
                    };
                } else if (input.type === 'radio') {
                    if (input.checked) {
                        formData.academico[input.name] = input.value;
                    }
                } else {
                    // Salvar em diferentes seções baseado no passo
                    if (stepNumber === 1) {
                        formData.pessoal[fieldName] = input.value;
                    } else if (stepNumber === 2) {
                        formData.academico[fieldName] = input.value;
                    }
                }
            }
        });

        // Salvar no localStorage (simulação)
        localStorage.setItem('inscricaoData', JSON.stringify(formData));
    }

    // Preencher passo de revisão
    function populateReviewStep() {
        // Dados pessoais
        document.getElementById('reviewNome').textContent = formData.pessoal.nomeCompleto || '';
        document.getElementById('reviewEmail').textContent = formData.pessoal.email || '';
        document.getElementById('reviewTelefone').textContent = formData.pessoal.telefone || '';
        document.getElementById('reviewBI').textContent = formData.pessoal.bi || '';
        document.getElementById('reviewMorada').textContent = formData.pessoal.morada || '';

        // Dados académicos
        document.getElementById('reviewCurso').textContent = getCourseName(formData.academico.curso) || '';
        document.getElementById('reviewPeriodo').textContent = formData.academico.periodo === 'diurno' ? 'Diurno' : 'Noturno';
        document.getElementById('reviewEscolaridade').textContent = getEscolaridadeName(formData.academico.escolaridade) || '';
        document.getElementById('reviewAno').textContent = formData.academico.anoIngresso || '';

        // Documentos
        const documentosContainer = document.getElementById('reviewDocumentos');
        documentosContainer.innerHTML = '';

        Object.entries(formData.documentos).forEach(([key, doc]) => {
            if (doc.files && doc.files.length > 0) {
                doc.files.forEach(file => {
                    const docElement = document.createElement('div');
                    docElement.className = 'col-md-6 mb-2';
                    docElement.innerHTML = `
                        <div class="document-item">
                            <div class="document-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="document-name">
                                ${file.name}
                            </div>
                            <div class="document-size">
                                ${formatFileSize(file.size)}
                            </div>
                        </div>
                    `;
                    documentosContainer.appendChild(docElement);
                });
            }
        });
    }

    // Inicializar upload de arquivos
    function initFileUpload() {
        dropzones.forEach(dropzone => {
            const fileInput = dropzone.querySelector('input[type="file"]');
            const previewContainer = document.getElementById(`${fileInput.id.replace('File', '')}Preview`);

            // Click no dropzone
            dropzone.addEventListener('click', () => {
                fileInput.click();
            });

            // Drag and drop
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('dragover');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('dragover');

                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    handleFileUpload(fileInput, previewContainer);
                }
            });

            // Change no input de arquivo
            fileInput.addEventListener('change', () => {
                handleFileUpload(fileInput, previewContainer);
            });
        });
    }

    // Manipular upload de arquivos
    function handleFileUpload(fileInput, previewContainer) {
        previewContainer.innerHTML = '';

        const files = Array.from(fileInput.files);

        files.forEach(file => {
            // Validar tamanho do arquivo (5MB máximo)
            if (file.size > 5 * 1024 * 1024) {
                showAlert(`O arquivo "${file.name}" excede o tamanho máximo de 5MB.`, 'danger');
                return;
            }

            // Validar tipo de arquivo
            const validTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                showAlert(`O arquivo "${file.name}" não é um tipo válido (PDF, JPG, PNG).`, 'danger');
                return;
            }

            // Adicionar preview
            const fileElement = createFileElement(file);
            previewContainer.appendChild(fileElement);

            // Marcar como válido
            fileInput.classList.remove('is-invalid');
            fileInput.classList.add('is-valid');
        });
    }

    // Criar elemento de preview de arquivo
    function createFileElement(file) {
        const element = document.createElement('div');
        element.className = 'document-item';
        element.innerHTML = `
            <div class="document-icon">
                <i class="bi ${getFileIcon(file.type)}"></i>
            </div>
            <div class="document-name" title="${file.name}">
                ${file.name}
            </div>
            <div class="document-size">
                ${formatFileSize(file.size)}
            </div>
            <div class="document-remove" onclick="removeFile(this, '${file.name}')">
                <i class="bi bi-x-circle"></i>
            </div>
        `;

        return element;
    }

    // Função global para remover arquivo
    window.removeFile = function(button, fileName) {
        const fileItem = button.closest('.document-item');
        const previewContainer = fileItem.closest('.document-preview');
        const dropzone = previewContainer.previousElementSibling;
        const fileInput = dropzone.querySelector('input[type="file"]');

        // Remover arquivo do input
        const dt = new DataTransfer();
        const files = Array.from(fileInput.files).filter(file => file.name !== fileName);

        files.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;

        // Remover preview
        fileItem.remove();

        // Se não houver mais arquivos, remover validação
        if (files.length === 0) {
            fileInput.classList.remove('is-valid');
        }
    };

    // Obter ícone baseado no tipo de arquivo
    function getFileIcon(fileType) {
        if (fileType === 'application/pdf') return 'bi-file-earmark-pdf';
        if (fileType.includes('image')) return 'bi-file-earmark-image';
        return 'bi-file-earmark';
    }

    // Formatar tamanho do arquivo
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Validação em tempo real
    function initRealTimeValidation() {
        const inputs = form.querySelectorAll('input, select, textarea');

        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                validateField(input);
            });

            input.addEventListener('input', () => {
                if (input.classList.contains('is-invalid')) {
                    validateField(input);
                }
            });
        });
    }

    // Validar campo individual
    function validateField(input) {
        if (!input.hasAttribute('required')) return true;

        let isValid = true;
        let message = 'Este campo é obrigatório.';

        if (input.value.trim()) {
            // Validações específicas por tipo
            switch (input.type) {
                case 'email':
                    if (!isValidEmail(input.value)) {
                        isValid = false;
                        message = 'Por favor, informe um email válido.';
                    }
                    break;

                case 'password':
                    if (input.id === 'senha' && input.value.length < 6) {
                        isValid = false;
                        message = 'A senha deve ter pelo menos 6 caracteres.';
                    } else if (input.id === 'confirmarSenha' && input.value !== document.getElementById('senha')?.value) {
                        isValid = false;
                        message = 'As senhas não coincidem.';
                    }
                    break;

                case 'date':
                    const date = new Date(input.value);
                    const today = new Date();
                    const minAge = new Date(today.getFullYear() - 16, today.getMonth(), today.getDate());

                    if (date > minAge) {
                        isValid = false;
                        message = 'Você deve ter pelo menos 16 anos.';
                    }
                    break;
            }
        } else {
            isValid = false;
        }

        if (isValid) {
            markAsValid(input);
        } else {
            markAsInvalid(input, message);
        }

        return isValid;
    }

    // Inicializar máscaras de input
    function initInputMasks() {
        // Máscara para telefone
        const telefoneInput = document.getElementById('telefone');
        if (telefoneInput) {
            telefoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');

                if (value.length <= 9) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{3})/, '$1 $2 $3');
                } else if (value.length <= 13) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{4})/, '$1 $2 $3 $4');
                }

                e.target.value = value;
            });
        }

        // Máscara para BI
        const biInput = document.getElementById('bi');
        if (biInput) {
            biInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = value.replace(/^(\d{3})(\d{5})(\d{3})(\d{2})/, '$1 $2 $3 $4');
                e.target.value = value;
            });
        }
    }

    // Carregar dados salvos
    function loadSavedData() {
        const savedData = localStorage.getItem('inscricaoData');
        if (savedData) {
            formData = JSON.parse(savedData);

            // Preencher campos com dados salvos (exceto senhas)
            Object.entries(formData.pessoal).forEach(([key, value]) => {
                const input = document.getElementById(key);
                if (input && key !== 'senha' && key !== 'confirmarSenha') {
                    input.value = value;
                }
            });

            Object.entries(formData.academico).forEach(([key, value]) => {
                const input = document.getElementById(key);
                if (input) {
                    input.value = value;
                } else if (key === 'periodo') {
                    const radio = document.querySelector(`input[name="periodo"][value="${value}"]`);
                    if (radio) radio.checked = true;
                }
            });
        }
    }

    // Manipular envio do formulário
    function handleSubmit(e) {
        e.preventDefault();

        if (validateStep(4)) {
            saveStepData(4);

            // Simular envio para o servidor
            showLoading(true);

            setTimeout(() => {
                showLoading(false);

                // Mostrar modal de sucesso
                document.getElementById('confirmationEmail').textContent = formData.pessoal.email;
                successModal.show();

                // Limpar dados do localStorage
                localStorage.removeItem('inscricaoData');

                // Limpar formulário
                form.reset();
                formData = { pessoal: {}, academico: {}, documentos: {} };

                // Resetar para o primeiro passo
                showStep('step1');
                updateProgress();

                // Limpar previews de arquivos
                document.querySelectorAll('.document-preview').forEach(container => {
                    container.innerHTML = '';
                });

                // Limpar validações
                form.classList.remove('was-validated');
                form.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
                    el.classList.remove('is-valid', 'is-invalid');
                });

            }, 2000); // Simulação de delay de envio
        }
    }

    // Mostrar/ocultar loading
    function showLoading(show) {
        let spinner = document.querySelector('.spinner-container');

        if (!spinner) {
            spinner = document.createElement('div');
            spinner.className = 'spinner-container';
            spinner.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Enviando...</span>
                    </div>
                    <p class="mt-3">Enviando sua inscrição...</p>
                </div>
            `;
            document.body.appendChild(spinner);
        }

        spinner.style.display = show ? 'flex' : 'none';
    }

    // Funções auxiliares
    function markAsValid(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');

        const feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.style.display = 'none';
        }
    }

    function markAsInvalid(input, message = 'Este campo é obrigatório.') {
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');

        let feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = message;
            feedback.style.display = 'block';
        }
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function getCourseName(courseId) {
        const courses = {
            'informatica': 'Informática',
            'mecanica': 'Mecânica Industrial',
            'construcao': 'Construção Civil',
            'eletronica': 'Electrónica',
            'gestao': 'Gestão Empresarial',
            'enfermagem': 'Enfermagem'
        };
        return courses[courseId] || courseId;
    }

    function getEscolaridadeName(escolaridadeId) {
        const escolaridades = {
            'ensino-medio': 'Ensino Médio Completo',
            'ensino-medio-cursando': 'Ensino Médio Cursando',
            'superior': 'Superior Completo',
            'superior-cursando': 'Superior Cursando',
            'outro': 'Outro'
        };
        return escolaridades[escolaridadeId] || escolaridadeId;
    }

    function showAlert(message, type) {
        // Remover alertas anteriores
        const existingAlert = document.querySelector('.alert:not(.fixed-alert)');
        if (existingAlert) existingAlert.remove();

        // Criar novo alerta
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show fixed-alert position-fixed top-0 start-50 translate-middle-x mt-3`;
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

    // Formulário de Login (reutilizado)
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            if (!email || !password) {
                showAlert('Por favor, preencha todos os campos.', 'danger');
                return;
            }

            if (!isValidEmail(email)) {
                showAlert('Por favor, insira um email válido.', 'danger');
                return;
            }

            showAlert('Login realizado com sucesso! Redirecionando...', 'success');

            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                if (modal) modal.hide();
                loginForm.reset();
            }, 1500);
        });
    }
});
