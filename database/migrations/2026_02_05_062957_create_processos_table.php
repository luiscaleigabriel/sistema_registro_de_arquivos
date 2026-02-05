<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
            $table->string('num_processo')->unique();
            $table->date('data_abertura');
            $table->enum('tipo', ['admissao', 'matricula', 'transferencia', 'outro']);
            $table->enum('status', ['aberto', 'em_analise', 'aprovado', 'rejeitado', 'arquivado'])->default('aberto');
            $table->text('descricao')->nullable();
            $table->decimal('taxa_processo', 10, 2)->default(0);
            $table->foreignId('criado_por')->nullable()->constrained('users');
            $table->foreignId('analisado_por')->nullable()->constrained('users');
            $table->date('data_analise')->nullable();
            $table->text('observacoes_analise')->nullable();
            $table->date('data_arquivamento')->nullable();
            $table->string('local_arquivamento', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('processos');
    }
};
