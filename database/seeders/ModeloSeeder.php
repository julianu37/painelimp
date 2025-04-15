<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Para checar constraints

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Modelo::query()->delete(); // Usar delete() em vez de truncate()
        Schema::enableForeignKeyConstraints();

        // Busca IDs das marcas criadas no MarcaSeeder
        $hpId = Marca::where('nome', 'HP')->firstOrFail()->id;
        $epsonId = Marca::where('nome', 'Epson')->firstOrFail()->id;
        $brotherId = Marca::where('nome', 'Brother')->firstOrFail()->id;
        // Adicione buscas para outras marcas se necessário

        $modelos = [
            $hpId => ['LaserJet Pro M404dn', 'OfficeJet Pro 9015e', 'DeskJet 2755e'],
            $epsonId => ['EcoTank L3250', 'WorkForce Pro WF-4820', 'Expression Home XP-4100'],
            $brotherId => ['HL-L2390DW', 'MFC-L3770CDW', 'DCP-L2550DW'],
            // Adicione modelos para outras marcas
        ];

        foreach ($modelos as $marcaId => $nomesModelos) {
            foreach ($nomesModelos as $nomeModelo) {
                Modelo::create([
                    'marca_id' => $marcaId,
                    'nome' => $nomeModelo,
                ]);
            }
        }
    }
}
