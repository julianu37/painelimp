<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CodigoErro;
// use App\Models\Solucao; // Removido
use App\Models\Comentario;
use App\Models\User;
use App\Models\Modelo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CodigoErroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpar tabelas relacionadas antes de popular
        Schema::disableForeignKeyConstraints();
        CodigoErro::query()->delete();
        // Solucao::query()->delete(); // Removido
        Comentario::query()->delete();
        DB::table('codigo_erro_modelo')->truncate();
        Schema::enableForeignKeyConstraints();

        // Busca o usuário técnico criado anteriormente
        $tecnico = User::where('email', 'tecnico@example.com')->first();

        // Busca alguns IDs de modelos para associar (garantindo que existam)
        $modeloIds = Modelo::query()->limit(5)->pluck('id')->toArray();

        // Cria alguns códigos de erro de exemplo
        $erro1 = CodigoErro::create([
            'codigo' => 'E101',
            'descricao' => 'Erro relacionado ao cartucho de toner.',
            'publico' => true,
        ]);
        if (!empty($modeloIds)) {
            $erro1->modelos()->attach(array_rand(array_flip($modeloIds), rand(1, min(3, count($modeloIds)))));
        }

        $erro2 = CodigoErro::create([
            'codigo' => 'W001',
            'descricao' => 'Falha na alimentação de papel.',
            'publico' => true,
        ]);
        if (!empty($modeloIds)) {
            $erro2->modelos()->attach(array_rand(array_flip($modeloIds), rand(1, min(2, count($modeloIds)))));
        }

        CodigoErro::create([
            'codigo' => 'ERRO-GEN-01',
            'slug' => Str::slug('ERRO-GEN-01-erro-generico-comunicacao'),
            'descricao' => 'Erro genérico de comunicação com a impressora.',
            'publico' => false,
        ]);

        // Cria soluções para o erro E101 - REMOVIDO
        /*
        Solucao::create(
            [
                'codigo_erro_id' => $erro1->id,
                'titulo' => 'Verificar conexão do cabo do sensor',
                'descricao' => "1. Desligue a impressora.\n2. Verifique se o cabo flat do sensor de temperatura está bem conectado na placa principal.\n3. Ligue a impressora e teste."
            ]
        );
        Solucao::create(
            [
                'codigo_erro_id' => $erro1->id,
                'titulo' => 'Substituir sensor de temperatura',
                'descricao' => 'Se a verificação do cabo não resolver, o sensor pode estar danificado. Siga o manual para substituição (PN: 12345-TEMP).'
            ]
        );
        */

        // Cria solução para o erro W001 - REMOVIDO
        /*
        Solucao::create(
            [
                'codigo_erro_id' => $erro2->id,
                'titulo' => 'Limpar rolos de alimentação',
                'descricao' => 'Limpe os rolos de alimentação de papel com um pano úmido.'
            ]
        );
        */

        // Adiciona comentários do técnico (se o técnico existir)
        if ($tecnico && isset($erro1)) {
            Comentario::create(
                [
                    'user_id' => $tecnico->id,
                    'comentavel_id' => $erro1->id,
                    'comentavel_type' => CodigoErro::class,
                    'conteudo' => 'Verifiquei o cabo e estava solto na placa. Reconectei e o erro sumiu.'
                ]
            );
            Comentario::create(
                [
                    'user_id' => $tecnico->id,
                    'comentavel_id' => $erro1->id,
                    'comentavel_type' => CodigoErro::class,
                    'conteudo' => 'Em outro caso, tive que trocar o sensor mesmo. O cabo estava ok.'
                ]
            );
        }
    }
}
