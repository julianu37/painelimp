<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Marca::query()->delete();
        Schema::enableForeignKeyConstraints();

        $marcas = [
            'HP',
            'Epson',
            'Brother',
            'Canon',
            'Lexmark',
            'Samsung',
            'Xerox',
            'Kyocera',
            'Ricoh',
        ];

        foreach ($marcas as $nomeMarca) {
            Marca::create(['nome' => $nomeMarca]);
        }
    }
}
