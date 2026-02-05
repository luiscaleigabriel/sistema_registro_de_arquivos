<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
            $table->foreignId('processo_id')->nullable()->constrained('processos');
            $table->date('data_inscricao');
            $table->enum('tipo_inscricao', ['regular', 'reinscricao', 'transferencia']);
            $table->enum('status', ['pendente', 'submetida', 'em_analise', 'aprovada', 'rejeitada'])->default('pendente');
            $table->decimal('nota_teste', 5, 2)->nullable();
            $table->enum('resultado_teste', ['aprovado', 'reprovado', 'pendente'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->foreignId('avaliado_por')->nullable()->constrained('users');
            $table->date('data_avaliacao')->nullable();
            $table->boolean('documentos_completos')->default(false);
            $table->boolean('taxa_paga')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscricoes');
    }
};
