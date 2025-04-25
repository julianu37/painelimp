<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Imagem;
use App\Models\CodigoErro;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class ImagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela e o storage (cuidado em produção!)
        Schema::disableForeignKeyConstraints();
        Imagem::query()->delete();
        Schema::enableForeignKeyConstraints();
        // Não apaga o diretório inteiro aqui, pois pode conter imagens de outros seeders
        // Storage::disk('public')->deleteDirectory('imagens');
        // Storage::disk('public')->makeDirectory('imagens');

        // Pega alguns registros existentes para associar imagens
        $codigoErroE101 = CodigoErro::where('codigo', 'E101')->first();
        $marcaHP = Marca::where('nome', 'HP')->first();
        $modeloM404dn = Modelo::where('nome', 'LaserJet Pro M404dn')->first();

        // Cria imagens de exemplo associadas
        if ($codigoErroE101) {
            Imagem::create([
                'titulo' => 'Localização do Toner',
                'path' => 'imagens/exemplo_toner.jpg', // Caminho fictício
                'imageable_id' => $codigoErroE101->id,
                'imageable_type' => CodigoErro::class,
            ]);
        }

        if ($marcaHP) {
             Imagem::create([
                'titulo' => 'Logo HP Antigo',
                'path' => 'imagens/exemplo_logo_hp.gif', // Caminho fictício
                'imageable_id' => $marcaHP->id,
                'imageable_type' => Marca::class,
            ]);
        }

         if ($modeloM404dn) {
             Imagem::create([
                'titulo' => 'Painel Frontal M404dn',
                'path' => 'imagens/exemplo_painel_m404.webp', // Caminho fictício
                'imageable_id' => $modeloM404dn->id,
                'imageable_type' => Modelo::class,
            ]);
        }

        // Garante que a pasta exista, mesmo que os arquivos sejam fictícios
         if (!Storage::disk('public')->exists('imagens')) {
            Storage::disk('public')->makeDirectory('imagens');
        }

    }
} 