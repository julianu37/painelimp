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
        Schema::table('manual_pagina_referencias', function (Blueprint $table) {
            // 1. Remover a chave primária antiga (nome padrão ou o nome dado na criação)
            // O nome padrão seria: manual_pagina_referencias_manual_id_codigo_erro_id_numero_pagina_primary
            // Mas na migration de criação foi dado o nome: 'manual_codigo_pagina_primary'
            $table->dropPrimary('manual_codigo_pagina_primary');

            // 2. Remover índices antigos se existirem (a FK já deve ter sido removida)
            // $table->dropIndex(['manual_id']); // O Laravel pode recriar ou já ter recriado
            $table->dropIndex(['codigo_erro_id']);

            // 3. Remover a coluna codigo_erro_id (agora sem PK ou FK explícita)
            $table->dropColumn('codigo_erro_id');

            // 4. Adicionar a nova coluna
            $table->string('codigo_encontrado')->after('manual_id');

            // 5. Adicionar a nova chave primária composta
            $table->primary(['manual_id', 'codigo_encontrado', 'numero_pagina'], 'manual_codigo_encontrado_pagina_primary');

            // 6. Readicionar índices úteis (manual_id já deve existir ou ser recriado pela primary)
            $table->index('codigo_encontrado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manual_pagina_referencias', function (Blueprint $table) {
            // Reverte na ordem inversa
            $table->dropPrimary('manual_codigo_encontrado_pagina_primary');
            $table->dropIndex(['codigo_encontrado']);
            $table->dropColumn('codigo_encontrado');

            // Recria a estrutura antiga
            $table->unsignedBigInteger('codigo_erro_id')->nullable()->after('manual_id');
            $table->primary(['manual_id', 'codigo_erro_id', 'numero_pagina'], 'manual_codigo_pagina_primary');
            $table->index('codigo_erro_id');
        });
    }
};
