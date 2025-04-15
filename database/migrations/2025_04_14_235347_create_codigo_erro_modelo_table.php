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
        // Tabela pivot para relacionamento N:N entre codigos_erro e modelos
        Schema::create('codigo_erro_modelo', function (Blueprint $table) {
            // Chave estrangeira para codigos_erro
            $table->foreignId('codigo_erro_id')->constrained('codigos_erro')->cascadeOnDelete();
            // Chave estrangeira para modelos
            $table->foreignId('modelo_id')->constrained('modelos')->cascadeOnDelete();
            // Definir chave primária composta para evitar duplicatas
            $table->primary(['codigo_erro_id', 'modelo_id']);
            // Timestamps não são usualmente necessários em tabelas pivot simples
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigo_erro_modelo');
    }
};
