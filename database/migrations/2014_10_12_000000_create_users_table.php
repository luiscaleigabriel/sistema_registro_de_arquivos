<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('bi', 20)->unique();
            $table->date('data_nasc');
            $table->string('morada', 255);
            $table->string('telefone', 20);
            $table->enum('nivel_acesso', ['aluno', 'secretario', 'administrador'])->default('aluno');
            $table->boolean('ativo')->default(true);
            $table->timestamp('email_verificado_em')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
