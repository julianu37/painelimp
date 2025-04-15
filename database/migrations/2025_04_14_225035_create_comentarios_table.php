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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            // Chave estrangeira para o usuário que fez o comentário (técnico)
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // Campos polimórficos para associar o comentário a outros modelos (Ex: OrdemServico, Chamado)
            $table->morphs('comentavel'); // Cria comentavel_id e comentavel_type
            // Conteúdo do comentário
            $table->text('conteudo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
