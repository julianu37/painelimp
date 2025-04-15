<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Manual;

class GenerateSlugs extends Command
{
    protected $signature = 'app:generate-slugs';
    protected $description = 'Gera slugs para Marcas, Modelos e Manuais existentes que não possuem um.';

    public function handle()
    {
        $this->info('Gerando slugs...');

        $this->generateSlugsForModel(Marca::class);
        $this->generateSlugsForModel(Modelo::class);
        $this->generateSlugsForModel(Manual::class);

        $this->info('Geração de slugs concluída.');
        return Command::SUCCESS;
    }

    protected function generateSlugsForModel(string $modelClass)
    {
        $modelName = class_basename($modelClass);
        $this->line("Processando {$modelName}...");

        // Busca modelos sem slug
        $models = $modelClass::whereNull('slug')->get();
        $count = $models->count();

        if ($count === 0) {
            $this->info("Nenhum(a) {$modelName} encontrado(a) sem slug.");
            return;
        }

        $progressBar = $this->output->createProgressBar($count);
        $progressBar->start();

        foreach ($models as $model) {
            // Simplesmente salvar o modelo deve acionar o Sluggable trait
            try {
                // Força a regeração caso o slug já exista por algum motivo (raro)
                // $model->resluggify(); 
                $model->save();
            } catch (\Exception $e) {
                 $this->warn("\nNão foi possível salvar {$modelName} ID: {$model->id}. Erro: " . $e->getMessage());
                 // Considerar logar o erro ou pular o modelo
            }
             $progressBar->advance();
        }

        $progressBar->finish();
        $this->info("\nSlugs gerados para {$count} {$modelName}.");
    }
} 