<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('secretarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('codigo_func')->unique();
            $table->string('departamento', 100);
            $table->enum('tipo', ['academico', 'administrativo', 'financeiro']);
            $table->date('data_admissao');
            $table->boolean('pode_arquivar')->default(true);
            $table->boolean('pode_validar')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('secretarios');
    }
};
