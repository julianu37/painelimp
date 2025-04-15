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
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            // Chave estrangeira para marcas
            $table->foreignId('marca_id')->constrained('marcas')->cascadeOnDelete();
            $table->string('nome'); // Nome do modelo
            // Garantir que a combinação de marca e nome do modelo seja única
            $table->unique(['marca_id', 'nome']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
