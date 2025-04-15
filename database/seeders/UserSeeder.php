<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria um usuário Administrador
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Chave para verificar se já existe
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'), // Troque 'password' por uma senha segura
                'role' => 'admin', // Define a role como admin
            ]
        );

        // Cria um usuário Técnico de exemplo
        User::firstOrCreate(
            ['email' => 'tecnico@example.com'], // Chave para verificar se já existe
            [
                'name' => 'Tecnico Exemplo',
                'password' => Hash::make('password'), // Troque 'password' por uma senha segura
                'role' => 'tecnico', // Define a role como tecnico (padrão, mas explícito)
            ]
        );

        // Você pode adicionar mais usuários ou usar Factories para gerar dados em massa
        // User::factory(10)->create(); // Exemplo com factory (requer configuração da factory)
    }
}
