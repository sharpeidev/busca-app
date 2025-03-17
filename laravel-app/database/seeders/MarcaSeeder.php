<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            'Apple',
            'Lenovo',
            'Motorola',
            'Samsung',
        ];

        foreach ($marcas as $marca) {
            Marca::factory()
                ->create(['nome' => $marca]);
        }
    }
}
