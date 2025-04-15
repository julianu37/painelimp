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
        Schema::create('imagens', function (Blueprint $table) {
            $table->id();
            // Título da imagem.
            $table->string('titulo');
            // Caminho do arquivo da imagem no storage.
            $table->string('path');
            // Descrição opcional da imagem.
            $table->text('descricao')->nullable();
            // Colunas para relacionamento polimórfico (associado a solucoes ou codigos_erro)
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');
            $table->timestamps();

            // Índice para otimizar buscas polimórficas
            $table->index(['imageable_id', 'imageable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagens');
    }
};
