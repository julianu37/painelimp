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
        Schema::table('codigos_erro', function (Blueprint $table) {
            // Remove a coluna 'equipamentos'
            $table->dropColumn('equipamentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('codigos_erro', function (Blueprint $table) {
            // Adiciona a coluna de volta no rollback (após 'descricao')
            $table->string('equipamentos')->nullable()->after('descricao');
        });
    }
};
