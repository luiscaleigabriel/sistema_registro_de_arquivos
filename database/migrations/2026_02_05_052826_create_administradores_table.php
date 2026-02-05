<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('codigo_admin')->unique();
            $table->string('nivel_permissao', 50)->default('super');
            $table->boolean('pode_gerenciar_usuarios')->default(true);
            $table->boolean('pode_gerar_relatorios')->default(true);
            $table->boolean('pode_configurar_sistema')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administradores');
    }
};
