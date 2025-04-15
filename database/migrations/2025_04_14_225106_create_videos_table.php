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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            // Tipo do vídeo: 'link' ou 'arquivo'.
            $table->enum('tipo', ['link', 'arquivo']);
            // Título ou descrição do vídeo.
            $table->string('titulo')->nullable();
            // URL do vídeo (se tipo for 'link') ou caminho do arquivo (se tipo for 'arquivo').
            $table->string('url_ou_path');
            // Descrição opcional do vídeo.
            $table->text('descricao')->nullable();
            // Colunas para relacionamento polimórfico (associado a solucoes ou codigos_erro)
            $table->unsignedBigInteger('videoable_id');
            $table->string('videoable_type');
            $table->timestamps();

            // Índice para otimizar buscas polimórficas
            $table->index(['videoable_id', 'videoable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
