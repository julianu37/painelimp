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
        Schema::create('midia_comentarios', function (Blueprint $table) {
            $table->id();
            // Chave estrangeira para o comentário ao qual esta mídia pertence
            $table->foreignId('comentario_id')->constrained('comentarios')->cascadeOnDelete();
            // Tipo da mídia (imagem, video_mp4, video_youtube, pdf)
            $table->string('tipo');
            // Caminho do arquivo (para imagem, mp4, pdf) ou URL/ID (para youtube)
            $table->string('caminho');
            // Nome original do arquivo (opcional, mas útil)
            $table->string('nome_original')->nullable();
            // Tamanho do arquivo em bytes (opcional)
            $table->unsignedBigInteger('tamanho')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midia_comentarios');
    }
};
