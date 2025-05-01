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
        Schema::create('manuais', function (Blueprint $table) {
            $table->id();
            // Nome do manual.
            $table->string('nome');
            // Descrição do manual.
            $table->text('descricao')->nullable();
            // Equipamentos relacionados (simplificado como texto por enquanto).
            $table->string('equipamentos')->nullable();
            // Caminho do arquivo no storage.
            $table->string('arquivo_path')->nullable();
            // Nome original do arquivo.
            $table->string('arquivo_nome_original')->nullable();
            // Flag para indicar se é visível publicamente (listagem).
            $table->boolean('publico')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manuais');
    }
};
