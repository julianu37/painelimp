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
        Schema::create('manual_pagina_referencias', function (Blueprint $table) {
            $table->foreignId('manual_id')->constrained('manuais')->onDelete('cascade');
            // $table->foreignId('codigo_erro_id')->constrained('codigos_erro')->onDelete('cascade'); // REMOVIDO
            $table->unsignedInteger('numero_pagina');
            $table->string('codigo_encontrado')->nullable(); // Adicionado na migração modify...
            $table->text('texto_contexto')->nullable();

            // Chave primária composta SEM codigo_erro_id
            $table->primary(['manual_id', 'numero_pagina', 'codigo_encontrado']); // Adicionado codigo_encontrado à PK

            $table->timestamps(); // Adiciona created_at e updated_at

            // Índices
            // $table->index('codigo_erro_id'); // REMOVIDO
            $table->index('numero_pagina');
            $table->index('codigo_encontrado'); // Adicionado índice
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_pagina_referencias');
    }
};
