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
        Schema::create('codigo_erro_solucao', function (Blueprint $table) {
            // Chave estrangeira para codigos_erro
            $table->foreignId('codigo_erro_id')->constrained('codigos_erro')->cascadeOnDelete();
            // Chave estrangeira para solucoes
            $table->foreignId('solucao_id')->constrained('solucoes')->cascadeOnDelete();

            // Definir a chave primária composta para evitar duplicatas
            $table->primary(['codigo_erro_id', 'solucao_id']);

            // Não precisamos de timestamps para esta tabela pivot simples
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigo_erro_solucao');
    }
};
