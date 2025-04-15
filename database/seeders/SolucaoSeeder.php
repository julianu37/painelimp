<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Solucao;
use App\Models\CodigoErro;
use Illuminate\Support\Facades\Schema;

class SolucaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela
        Schema::disableForeignKeyConstraints();
        Solucao::query()->delete();
        Schema::enableForeignKeyConstraints();

        // Busca códigos de erro criados pelo CodigoErroSeeder
        $codigoE101 = CodigoErro::where('codigo', 'E101')->first();
        $codigoW001 = CodigoErro::where('codigo', 'W001')->first();

        // Cria soluções de exemplo
        if ($codigoE101) {
            Solucao::create([
                'codigo_erro_id' => $codigoE101->id,
                'titulo' => 'Verificar e substituir o cartucho de toner',
                'descricao' => "1. Abra a tampa frontal da impressora.\n2. Remova o cartucho de toner antigo puxando-o para fora.\n3. Desembale o novo cartucho de toner e agite-o suavemente.\n4. Remova o selo de proteção do novo cartucho.\n5. Insira o novo cartucho na impressora até ouvir um clique.\n6. Feche a tampa frontal.",
            ]);
            Solucao::create([
                'codigo_erro_id' => $codigoE101->id,
                'titulo' => 'Verificar contato do chip do toner',
                'descricao' => "1. Desligue a impressora.\n2. Remova o cartucho de toner.\n3. Limpe os contatos metálicos do chip no cartucho com um pano seco e sem fiapos.\n4. Limpe também os contatos correspondentes dentro da impressora.\n5. Reinstale o cartucho e ligue a impressora.",
            ]);
        }

        if ($codigoW001) {
            Solucao::create([
                'codigo_erro_id' => $codigoW001->id,
                'titulo' => 'Limpar os roletes de alimentação de papel',
                'descricao' => "1. Desligue a impressora e desconecte o cabo de força.\n2. Localize os roletes de alimentação (geralmente dentro da área da bandeja de papel).\n3. Umedeça levemente um pano sem fiapos com água ou álcool isopropílico.\n4. Limpe cuidadosamente a superfície de borracha dos roletes.\n5. Espere secar completamente antes de ligar a impressora.",
            ]);
        }
    }
} 