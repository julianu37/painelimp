<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\Modelo;
use App\Models\Manual;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\File;

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
        $modeloL3250 = Modelo::where('nome', 'EcoTank L3250')->first();
        $modeloM404dn = Modelo::where('nome', 'LaserJet Pro M404dn')->first();
        $manualGenerico = Manual::where('nome', 'Manual de Serviço Genérico')->first();

        // Cria vídeos de exemplo
        if ($modeloL3250) {
            Video::create([
                'titulo' => 'Review Epson L3250',
                'tipo' => 'link',
                'url_ou_path' => 'https://vimeo.com/exemplo2',
                'videoable_id' => $modeloL3250->id,
                'videoable_type' => Modelo::class,
            ]);
        }

        if ($modeloM404dn) {
            Video::create([
                'videoable_id' => $modeloM404dn->id,
                'videoable_type' => Modelo::class,
                'titulo' => 'Unboxing HP M404dn',
                'descricao' => 'Vídeo mostrando o unboxing e configuração inicial.',
                'url_ou_path' => 'https://www.youtube.com/watch?v=exemplo_unboxing_m404dn',
                'tipo' => 'link'
            ]);
        }

        if ($manualGenerico) {
            // Exemplo de vídeo local (requer arquivo de vídeo em storage/app/seeders/placeholders)
            $placeholderPath = storage_path('app/seeders/placeholders/placeholder_video.mp4');
            if (file_exists($placeholderPath)) {
                $path = Storage::disk('public')->putFile('videos', new File($placeholderPath));
                Video::create([
                    'videoable_id' => $manualGenerico->id,
                    'videoable_type' => Manual::class,
                    'titulo' => 'Introdução ao Manual Genérico',
                    'descricao' => 'Visão geral do conteúdo do manual.',
                    'url_ou_path' => $path,
                    'tipo' => 'file'
                ]);
            }
        }

         // Garante que a pasta exista
         if (!Storage::disk('public')->exists('videos')) {
            Storage::disk('public')->makeDirectory('videos');
        }
    }
} 