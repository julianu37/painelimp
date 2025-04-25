<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Chama os seeders na ordem de dependência
        $this->call([
            UserSeeder::class,      // Cria usuários (admin, tecnicos)
            MarcaSeeder::class,     // Cria Marcas
            ModeloSeeder::class,    // Cria Modelos (depende de Marcas)
            // CodigoErroSeeder::class, // REMOVIDO
            // SolucaoSeeder::class,   // Removido - Cria Soluções (depende de Códigos de Erro)
            ManualSeeder::class,    // Cria Manuais (pode depender de Modelos)
            ImagemSeeder::class,    // Cria Imagens de exemplo (depende dos anteriores)
            VideoSeeder::class,     // Cria Vídeos de exemplo (depende dos anteriores)
            // Adicionar outros seeders se necessário (ImagemSeeder, VideoSeeder, etc.)
            // ComentarioSeeder::class,
        ]);
    }
}
