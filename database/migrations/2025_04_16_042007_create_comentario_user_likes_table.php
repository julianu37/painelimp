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
        Schema::create('comentario_user_likes', function (Blueprint $table) {
            // Chave estrangeira para comentarios
            $table->foreignId('comentario_id')->constrained('comentarios')->cascadeOnDelete();
            // Chave estrangeira para users
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Chave primária composta para garantir que um usuário só curta uma vez
            $table->primary(['comentario_id', 'user_id']);

            // Timestamps não são estritamente necessários para likes simples
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario_user_likes');
    }
}; 