<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bem-vindo ao Instituto 30 de Setembro</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #1e3a8a; color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8fafc; padding: 30px; border: 1px solid #e2e8f0; }
        .info-box { background: white; border: 2px solid #dbeafe; border-radius: 10px; padding: 20px; margin: 20px 0; }
        .footer { background: #f1f5f9; padding: 20px; text-align: center; border-radius: 0 0 10px 10px; font-size: 12px; color: #64748b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Instituto Politécnico 30 de Setembro</h1>
            <p>Sistema de Gestão de Processos Académicos</p>
        </div>

        <div class="content">
            <h2>Olá, {{ $nome }}!</h2>
            <p>Seja muito bem-vindo(a) ao Instituto Politécnico 30 de Setembro.</p>
            <p>Sua conta foi criada com sucesso e você já pode acessar o sistema de gestão de processos.</p>

            <div class="info-box">
                <h3>Seus Dados de Acesso:</h3>
                <p><strong>Número de Aluno:</strong> {{ $numeroAluno }}</p>
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Curso:</strong> {{ $curso }}</p>
                <p><strong>Ano Letivo:</strong> {{ $anoLetivo }}</p>
                <p><strong>Data de Inscrição:</strong> {{ $dataInscricao }}</p>
            </div>

            <h3>Próximos Passos:</h3>
            <ol>
                <li>Acesse o sistema com seu email e senha</li>
                <li>Complete seu perfil no sistema</li>
                <li>Envie os documentos necessários para seu processo</li>
                <li>Acompanhe o status do seu processo</li>
            </ol>

            <p><strong>Importante:</strong> Guarde estas informações em local seguro.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Instituto Politécnico 30 de Setembro. Todos os direitos reservados.</p>
            <p>Este é um email automático, por favor não responda.</p>
        </div>
    </div>
</body>
</html>
