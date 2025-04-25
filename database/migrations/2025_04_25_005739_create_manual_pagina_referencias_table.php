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
            // Chaves estrangeiras
            $table->foreignId('manual_id')->constrained('manuais')->onDelete('cascade');
            $table->foreignId('codigo_erro_id')->constrained('codigos_erro')->onDelete('cascade');
            
            // Número da página onde a referência foi encontrada
            $table->unsignedInteger('numero_pagina');

            // Chave primária composta para evitar duplicatas exatas
            $table->primary(['manual_id', 'codigo_erro_id', 'numero_pagina'], 'manual_codigo_pagina_primary');

            // Índices adicionais para otimizar buscas por manual ou código
            $table->index('manual_id');
            $table->index('codigo_erro_id');
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
