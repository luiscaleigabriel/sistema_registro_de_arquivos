<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('processo_id')->constrained('processos')->onDelete('cascade');
            $table->foreignId('inscricao_id')->nullable()->constrained('inscricoes');
            $table->string('tipo', 50);
            $table->string('nome_arquivo', 255);
            $table->string('caminho_arquivo', 255);
            $table->string('extensao', 10);
            $table->decimal('tamanho', 10, 2)->comment('Tamanho em KB');
            $table->enum('status', ['pendente', 'validado', 'rejeitado'])->default('pendente');
            $table->text('observacoes_validacao')->nullable();
            $table->foreignId('enviado_por')->constrained('users');
            $table->foreignId('validado_por')->nullable()->constrained('users');
            $table->dateTime('data_envio');
            $table->dateTime('data_validacao')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
};
