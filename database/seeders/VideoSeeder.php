<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\CodigoErro;
use App\Models\Solucao;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela e o storage
        Schema::disableForeignKeyConstraints();
        Video::query()->delete();
        Schema::enableForeignKeyConstraints();
        // Não apaga o diretório inteiro aqui
        // Storage::disk('public')->deleteDirectory('videos');
        // Storage::disk('public')->makeDirectory('videos');

        // Pega alguns registros existentes
        $codigoErroW001 = CodigoErro::where('codigo', 'W001')->first();
        $solucaoW001_1 = Solucao::where('titulo', 'LIKE', '%Limpar roletes%')->first();
        $modeloL3250 = Modelo::where('nome', 'EcoTank L3250')->first();

        // Cria vídeos de exemplo
        if ($codigoErroW001) {
            Video::create([
                'titulo' => 'Demonstração Erro W001',
                'tipo' => 'link',
                'url_ou_path' => 'https://www.youtube.com/watch?v=exemplo1',
                'videoable_id' => $codigoErroW001->id,
                'videoable_type' => CodigoErro::class,
            ]);
        }

        if ($solucaoW001_1) {
            Video::create([
                'titulo' => 'Tutorial Limpeza Roletes',
                'tipo' => 'upload',
                'url_ou_path' => 'videos/exemplo_limpeza_roletes.mp4', // Fictício
                'videoable_id' => $solucaoW001_1->id,
                'videoable_type' => Solucao::class,
            ]);
        }

         if ($modeloL3250) {
            Video::create([
                'titulo' => 'Review Epson L3250',
                'tipo' => 'link',
                'url_ou_path' => 'https://vimeo.com/exemplo2',
                'videoable_id' => $modeloL3250->id,
                'videoable_type' => Modelo::class,
            ]);
        }

         // Garante que a pasta exista
         if (!Storage::disk('public')->exists('videos')) {
            Storage::disk('public')->makeDirectory('videos');
        }
    }
} 