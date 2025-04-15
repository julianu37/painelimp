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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna 'role' que pode ser 'admin' ou 'tecnico',
            // com 'tecnico' como padrão.
            $table->string('role')->default('tecnico')->after('email');
            // Adiciona a coluna para o caminho do avatar, opcional.
            $table->string('avatar')->nullable()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove as colunas se a migration for revertida.
            $table->dropColumn(['role', 'avatar']);
        });
    }
};
