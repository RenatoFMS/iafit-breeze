<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercicios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('grupo_muscular');
            $table->string('articulacoes_monitoradas');
            $table->string('angulo_ideal');
            $table->enum('dificuldade', ['Iniciante', 'Intermediário', 'Avançado'])->default('Iniciante');
            $table->text('descricao_correcao');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercicios');
    }
};