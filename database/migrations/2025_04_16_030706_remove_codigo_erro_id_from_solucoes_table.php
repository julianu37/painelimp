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
        Schema::table('solucoes', function (Blueprint $table) {
            // Primeiro, remove a chave estrangeira (o nome da constraint pode variar,
            // Laravel geralmente cria como 'nomeTabela_nomeColuna_foreign')
            // Se o nome padrão não funcionar, pode ser necessário inspecionar o DB ou
            // definir um nome explícito na migration original.
            $table->dropForeign(['codigo_erro_id']); // Tenta remover a constraint padrão

            // Depois, remove a coluna
            $table->dropColumn('codigo_erro_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Recria a coluna e a chave estrangeira no método down.
     */
    public function down(): void
    {
        Schema::table('solucoes', function (Blueprint $table) {
            // Adiciona a coluna novamente (ajuste o tipo se necessário)
            // Garante que seja nullable se antes não era, ou adicione após outra coluna
            $table->foreignId('codigo_erro_id')->nullable()->after('id')->constrained('codigos_erro')->nullOnDelete();
        });
    }
};
