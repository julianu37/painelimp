<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manual;
use App\Models\Modelo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela e o storage (cuidado em produção!)
        Schema::disableForeignKeyConstraints();
        Manual::query()->delete();
        Schema::enableForeignKeyConstraints();
        Storage::disk('public')->deleteDirectory('manuais'); // Limpa a pasta

        // Busca alguns modelos para associar
        $modeloM404dn = Modelo::where('nome', 'LaserJet Pro M404dn')->first();
        $modeloL3250 = Modelo::where('nome', 'EcoTank L3250')->first();
        // Pega mais alguns para variedade
        $outrosModelosIds = Modelo::whereNotIn('id', [$modeloM404dn?->id, $modeloL3250?->id])->limit(3)->pluck('id')->toArray();

        // Cria manuais de exemplo
        $manual1 = Manual::create([
            'nome' => 'Manual de Usuário - HP LaserJet Pro M404dn',
            'descricao' => 'Guia completo para usuários da M404dn.',
            'arquivo_path' => 'manuais/exemplo_manual_hp.pdf', // Caminho fictício
            'arquivo_nome_original' => 'manual_hp_m404dn.pdf',
            'publico' => true,
            // 'modelo_id' => $modeloM404dn?->id, // Removido
        ]);
        // Associa ao modelo HP se encontrado
        if ($modeloM404dn) {
            $manual1->modelos()->attach($modeloM404dn->id);
        }

        $manual2 = Manual::create([
            'nome' => 'Manual de Serviço - Epson EcoTank L3250',
            'descricao' => 'Instruções de manutenção e reparo para técnicos.',
            'arquivo_path' => 'manuais/exemplo_servico_epson.pdf',
            'arquivo_nome_original' => 'servico_epson_l3250.pdf',
            'publico' => false, // Apenas para técnicos/admin
            // 'modelo_id' => $modeloL3250?->id, // Removido
        ]);
        // Associa ao modelo Epson se encontrado
        if ($modeloL3250) {
            $manual2->modelos()->attach($modeloL3250->id);
        }

        $manual3 = Manual::create([
            'nome' => 'Guia Rápido - Configuração de Rede',
            'descricao' => 'Manual genérico para configurar impressoras em rede.',
            'arquivo_path' => 'manuais/exemplo_guia_rede.pdf',
            'arquivo_nome_original' => 'guia_rede.pdf',
            'publico' => true,
            // 'modelo_id' => null, // Removido
        ]);
        // Associa a outros modelos aleatórios, se existirem
        if (!empty($outrosModelosIds)) {
             $manual3->modelos()->attach(array_rand(array_flip($outrosModelosIds), rand(1, count($outrosModelosIds))));
        }

        // NOTA: Este seeder assume que os arquivos PDF mencionados em 'arquivo_path'
        // existem no local correto (storage/app/public/manuais/).
        // Para um seeder funcional, você precisaria copiar arquivos de exemplo para lá
        // ou usar factories para gerar PDFs falsos.
        // Vamos criar a pasta para evitar erros, mas ela estará vazia.
        Storage::disk('public')->makeDirectory('manuais');
    }
}
