<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Imagem;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Manual;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
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

        // Cria o diretório se não existir
        if (!Storage::disk('public')->exists('imagens')) {
            Storage::disk('public')->makeDirectory('imagens');
        }

        // Pega alguns registros existentes para associar imagens
        // $codigoErroE101 = CodigoErro::where('codigo', 'E101')->first();
        $marcaHP = Marca::where('nome', 'HP')->first();
        $modeloM404dn = Modelo::where('nome', 'LaserJet Pro M404dn')->first();

        // Cria imagens de exemplo associadas
        if ($modeloM404dn) {
            $placeholderPath = database_path('seeders/placeholders/placeholder_image.jpg'); // Cria um placeholder se não tiver imagem real
            if (file_exists($placeholderPath)) {
                $path = Storage::disk('public')->putFile('imagens', new File($placeholderPath));
                Imagem::create([
                    'imageable_id' => $modeloM404dn->id,
                    'imageable_type' => Modelo::class,
                    'path' => $path,
                    'alt_text' => 'Imagem do Modelo HP M404dn'
                ]);
            }
        }

        if ($marcaHP) {
             $placeholderPath = database_path('seeders/placeholders/placeholder_image.jpg');
            if (file_exists($placeholderPath)) {
                $path = Storage::disk('public')->putFile('imagens', new File($placeholderPath));
                Imagem::create([
                    'imageable_id' => $marcaHP->id,
                    'imageable_type' => Marca::class,
                    'path' => $path,
                    'alt_text' => 'Logo HP'
                ]);
            }
        }

        // Associar imagem a um manual (se existir)
        $manualGenerico = Manual::where('nome', 'Manual de Serviço Genérico')->first();
        if ($manualGenerico) {
            $placeholderPath = database_path('seeders/placeholders/placeholder_image.jpg');
            if (file_exists($placeholderPath)) {
                $path = Storage::disk('public')->putFile('imagens', new File($placeholderPath));
                Imagem::create([
                    'imageable_id' => $manualGenerico->id,
                    'imageable_type' => Manual::class,
                    'path' => $path,
                    'alt_text' => 'Capa do Manual Genérico'
                ]);
            }
        }
    }
} 