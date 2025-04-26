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
        // Ordem de remoção: tabelas que dependem primeiro
        Schema::dropIfExists('comentario_user_likes');
        Schema::dropIfExists('midia_comentarios'); // Assumindo que esta depende de 'comentarios' ou 'midia'
        Schema::dropIfExists('comentarios');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recria na ordem inversa da remoção
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('comentavel'); // Para associar com CodigoErro, Solucao, etc.
            $table->text('conteudo');
            $table->timestamps();
        });

        Schema::create('midia_comentarios', function (Blueprint $table) {
             $table->id();
             $table->foreignId('comentario_id')->constrained('comentarios')->onDelete('cascade');
             // Assume que 'midia_id' e 'midia_type' apontam para uma tabela/model 'Midia' genérico ou específico
             // Substitua 'midia' pelo nome correto da tabela se for diferente
             // $table->foreignId('midia_id')->constrained('midia')->onDelete('cascade');
             // $table->string('midia_type');
             $table->morphs('midia'); // Alternativa polimórfica se a mídia pode ser Imagem, Video, etc.
             $table->timestamps();
             // $table->primary(['comentario_id', 'midia_id', 'midia_type']); // Chave composta se usar IDs separados
         });

        Schema::create('comentario_user_likes', function (Blueprint $table) {
            $table->foreignId('comentario_id')->constrained('comentarios')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->primary(['comentario_id', 'user_id']);
            $table->timestamps();
        });
    }
};
