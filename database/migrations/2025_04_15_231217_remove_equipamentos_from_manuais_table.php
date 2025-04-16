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
            // Remove a coluna 'equipamentos' se ela existir
            if (Schema::hasColumn('manuais', 'equipamentos')) {
                $table->dropColumn('equipamentos');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manuais', function (Blueprint $table) {
            // Readiciona a coluna 'equipamentos'
            $table->string('equipamentos')->nullable()->after('descricao');
        });
    }
};
