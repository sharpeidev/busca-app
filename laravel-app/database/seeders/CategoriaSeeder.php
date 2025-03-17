<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Celulares',
            'Computadores',
            'Eletrônicos',
        ];

        foreach ($categorias as $categoria) {
            Categoria::factory()
                ->create(['nome' => $categoria]);
        }
    }
}
