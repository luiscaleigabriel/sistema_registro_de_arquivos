<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Aluno;
use App\Models\Secretario;
use App\Models\Administrador;
use App\Models\Processo;
use App\Models\Inscricao;
use App\Models\Documento;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Limpar tabelas
        Documento::truncate();
        Inscricao::truncate();
        Processo::truncate();
        Aluno::truncate();
        Secretario::truncate();
        Administrador::truncate();
        Usuario::truncate();

        // Criar administrador principal
        $adminUser = Usuario::create([
            'nome' => 'Administrador Principal',
            'email' => 'admin@ip30setembro.edu.ao',
            'senha' => Hash::make('Admin@2024'),
            'bi' => '123456789LA001',
            'data_nasc' => '1980-01-01',
            'morada' => 'Luanda, Angola',
            'telefone' => '+244 922 123 456',
            'nivel_acesso' => 'administrador',
            'ativo' => true,
            'email_verificado_em' => now(),
        ]);

        $admin = Administrador::create([
            'usuario_id' => $adminUser->id,
            'codigo_admin' => 'ADMIN001',
            'nivel_permissao' => 'super',
            'pode_gerenciar_usuarios' => true,
            'pode_gerar_relatorios' => true,
            'pode_configurar_sistema' => true,
        ]);

        // Criar secretário
        $secretarioUser = Usuario::create([
            'nome' => 'Secretário Académico',
            'email' => 'secretario@ip30setembro.edu.ao',
            'senha' => Hash::make('Secretario@2024'),
            'bi' => '987654321LA001',
            'data_nasc' => '1985-05-15',
            'morada' => 'Luanda, Angola',
            'telefone' => '+244 923 123 456',
            'nivel_acesso' => 'secretario',
            'ativo' => true,
            'email_verificado_em' => now(),
        ]);

        $secretario = Secretario::create([
            'usuario_id' => $secretarioUser->id,
            'codigo_func' => 'SEC001',
            'departamento' => 'Académico',
            'tipo' => 'academico',
            'data_admissao' => '2020-01-01',
            'pode_arquivar' => true,
            'pode_validar' => true,
        ]);

        // Criar alunos de exemplo com processos e inscrições
        $cursos = ['Informática', 'Gestão', 'Contabilidade', 'Secretariado', 'Eletricidade', 'Mecânica'];

        for ($i = 1; $i <= 6; $i++) {
            $alunoUser = Usuario::create([
                'nome' => 'Aluno Exemplo ' . $i,
                'email' => 'aluno' . $i . '@ip30setembro.edu.ao',
                'senha' => Hash::make('Aluno@2024'),
                'bi' => '00000000' . $i . 'LA001',
                'data_nasc' => '200' . $i . '-01-0' . $i,
                'morada' => 'Luanda, Angola',
                'telefone' => '+244 925 123 45' . $i,
                'nivel_acesso' => 'aluno',
                'ativo' => true,
                'email_verificado_em' => now(),
            ]);

            $aluno = Aluno::create([
                'usuario_id' => $alunoUser->id,
                'numero_aluno' => 'AL' . date('Y') . str_pad($i, 4, '0', STR_PAD_LEFT),
                'curso' => $cursos[($i - 1) % count($cursos)],
                'ano_letivo' => '2024/2025',
                'status' => 'ativo',
                'data_inscricao' => now()->subDays($i * 10),
            ]);

            // Criar processo para o aluno
            $processo = Processo::create([
                'aluno_id' => $aluno->id,
                'tipo' => 'admissao',
                'status' => ($i % 3 == 0) ? 'aprovado' : (($i % 3 == 1) ? 'em_analise' : 'aberto'),
                'descricao' => 'Processo de admissão do aluno ' . $aluno->numero_aluno,
                'taxa_processo' => 5000.00,
                'criado_por' => $adminUser->id,
                'analisado_por' => ($i % 3 == 0) ? $secretarioUser->id : null,
                'data_analise' => ($i % 3 == 0) ? now()->subDays($i * 2) : null,
                'observacoes_analise' => ($i % 3 == 0) ? 'Processo analisado e aprovado.' : null,
            ]);

            // Criar inscrição para o aluno
            $inscricao = Inscricao::create([
                'aluno_id' => $aluno->id,
                'processo_id' => $processo->id,
                'tipo_inscricao' => 'regular',
                'status' => ($i % 3 == 0) ? 'aprovada' : (($i % 3 == 1) ? 'em_analise' : 'pendente'),
                'nota_teste' => rand(10, 20),
                'resultado_teste' => ($i % 3 == 0) ? 'aprovado' : (($i % 3 == 1) ? 'pendente' : 'reprovado'),
                'documentos_completos' => ($i % 2 == 0),
                'taxa_paga' => ($i % 2 == 0),
                'avaliado_por' => ($i % 3 == 0) ? $secretarioUser->id : null,
                'data_avaliacao' => ($i % 3 == 0) ? now()->subDays($i) : null,
            ]);

            // Criar documentos para o processo
            $tiposDocumentos = ['bi', 'certificado', 'fotografia', 'comprovativo'];

            foreach ($tiposDocumentos as $tipo) {
                Documento::create([
                    'processo_id' => $processo->id,
                    'inscricao_id' => $inscricao->id,
                    'tipo' => $tipo,
                    'nome_arquivo' => $tipo . '_' . $aluno->numero_aluno . '.pdf',
                    'caminho_arquivo' => 'documentos/' . $aluno->numero_aluno . '/' . $tipo . '.pdf',
                    'extensao' => 'pdf',
                    'tamanho' => rand(100, 2000),
                    'status' => ($i % 3 == 0) ? 'validado' : 'pendente',
                    'enviado_por' => $alunoUser->id,
                    'validado_por' => ($i % 3 == 0) ? $secretarioUser->id : null,
                    'data_validacao' => ($i % 3 == 0) ? now()->subDays($i) : null,
                ]);
            }
        }

        $this->command->info('📊 Dados iniciais criados com sucesso!');
        $this->command->info('🔐 Credenciais de acesso:');
        $this->command->info('   👨‍💼 Administrador: admin@ip30setembro.edu.ao / Admin@2024');
        $this->command->info('   👩‍💼 Secretário: secretario@ip30setembro.edu.ao / Secretario@2024');
        $this->command->info('   👨‍🎓 Alunos: aluno1@...aluno6@ip30setembro.edu.ao / Aluno@2024');
        $this->command->info('');
        $this->command->info('📁 Estrutura criada:');
        $this->command->info('   ✅ 6 Alunos com processos e inscrições');
        $this->command->info('   ✅ Processos com diferentes status');
        $this->command->info('   ✅ Documentos para cada processo');
        $this->command->info('   ✅ Relacionamentos configurados');
    }
}
