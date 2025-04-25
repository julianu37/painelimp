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
            // Status: pending, processing, completed, failed
            $table->string('indexing_status')->after('publico')->nullable()->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manuais', function (Blueprint $table) {
            $table->dropColumn('indexing_status');
        });
    }
};
