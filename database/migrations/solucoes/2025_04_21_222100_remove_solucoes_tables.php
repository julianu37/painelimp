<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Remove as tabelas relacionadas a Soluções.
     */
    public function up(): void
    {
        // Remove a tabela pivot primeiro devido à chave estrangeira
        Schema::dropIfExists('codigo_erro_solucao');
        // Remove a tabela principal de soluções
        Schema::dropIfExists('solucoes');
    }

    /**
     * Reverse the migrations.
     * Recria as tabelas relacionadas a Soluções (esquema básico).
     */
    public function down(): void
    {
        // Recria a tabela solucoes (ajuste os tipos/constraints conforme original)
        Schema::create('solucoes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->timestamps();
            // Adicione outros campos que existiam
        });

        // Recria a tabela pivot codigo_erro_solucao
        Schema::create('codigo_erro_solucao', function (Blueprint $table) {
            $table->foreignId('codigo_erro_id')->constrained('codigos_erro')->onDelete('cascade');
            $table->foreignId('solucao_id')->constrained('solucoes')->onDelete('cascade');
            $table->primary(['codigo_erro_id', 'solucao_id']); // Chave primária composta
        });
    }
};
