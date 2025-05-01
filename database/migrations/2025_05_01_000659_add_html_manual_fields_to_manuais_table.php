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
        Schema::table('manuais', function (Blueprint $table) {
            // Adiciona a coluna para o tipo de manual ('pdf' ou 'html')
            $table->string('tipo')->default('pdf')->after('arquivo_path');
            // Adiciona a coluna para o caminho do index.html (para tipo 'html')
            $table->string('caminho_html')->nullable()->after('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manuais', function (Blueprint $table) {
            // Remove as colunas se a migração for revertida
            $table->dropColumn('caminho_html');
            $table->dropColumn('tipo');
        });
    }
};
