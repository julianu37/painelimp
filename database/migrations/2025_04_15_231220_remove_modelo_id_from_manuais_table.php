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
            // Remove chave estrangeira e coluna modelo_id
            if (Schema::hasColumn('manuais', 'modelo_id')) {
                // Nome da constraint pode variar, Laravel geralmente usa table_column_foreign
                // Verifique o nome exato no seu DB se houver erro.
                try {
                    $table->dropForeign(['modelo_id']);
                } catch (\Exception $e) {
                    // Tenta nome padrão se o array falhar
                    // Log::warning("Não foi possível remover FK 'modelo_id' automaticamente: " . $e->getMessage());
                    $foreignKeys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('manuais');
                    foreach($foreignKeys as $foreignKey) {
                        if (in_array('modelo_id', $foreignKey->getLocalColumns())) {
                            $table->dropForeign($foreignKey->getName());
                            break;
                        }
                    }
                }
                $table->dropColumn('modelo_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manuais', function (Blueprint $table) {
            // Readiciona a coluna e a chave estrangeira
            if (!Schema::hasColumn('manuais', 'modelo_id')) {
                $table->foreignId('modelo_id')->nullable()->constrained('modelos')->nullOnDelete()->after('nome');
            }
        });
    }
};
