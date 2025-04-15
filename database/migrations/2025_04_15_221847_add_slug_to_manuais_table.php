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
            $table->string('slug')->nullable()->unique()->after('nome');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manuais', function (Blueprint $table) {
            $table->dropUnique('manuais_slug_unique');
            $table->dropColumn('slug');
        });
    }
};
