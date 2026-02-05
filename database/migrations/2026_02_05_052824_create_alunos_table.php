<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('numero_aluno', 20)->unique();
            $table->string('curso', 100);
            $table->string('ano_letivo', 9);
            $table->enum('status', ['ativo', 'inativo', 'suspenso', 'graduado'])->default('ativo');
            $table->date('data_inscricao');
            $table->string('numero_processo')->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alunos');
    }
};
