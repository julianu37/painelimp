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
        Schema::create('codigos_erro', function (Blueprint $table) {
            $table->id();
            // Código do erro (ex: E101), único.
            $table->string('codigo')->unique();
            // Slug para URL amigável, único.
            $table->string('slug')->unique();
            // Descrição do código de erro.
            $table->text('descricao');
            // Equipamentos relacionados (simplificado como texto por enquanto).
            $table->string('equipamentos')->nullable();
            // Flag para indicar se é visível publicamente.
            $table->boolean('publico')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigos_erro');
    }
};
