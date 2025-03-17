<?php

namespace Database\factories;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produto>
 */
class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word,
            'preco' => $this->faker->randomFloat(2, 10, 10000),
            'categoria_id' => Categoria::all()->random()->id,
            'marca_id' => Marca::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
