<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedApple();
        $this->seedLenovo();
        $this->seedMotorola();
        $this->seedSamsung();
    }

    public function seedApple(): void
    {
        $marca = Marca::where('nome','Apple')->first();
        $categoria = Categoria::where('nome','Celulares')->first();

        $produtos = [
            ['nome' => 'iPhone 16 Pro', 'preco' => 5400.00],
            ['nome' => 'MacBook Pro', 'preco' => 29999.99],
            ['nome' => 'iPad Pro', 'preco' => 27809.10],
            ['nome' => 'Apple Watch Ultra 2', 'preco' => 8294.49],
        ];

        $this->createProducts($produtos, $marca->id, $categoria->id);
    }

    public function seedLenovo(): void
    {
        $marca = Marca::where('nome','Lenovo')->first();
        $categoria = Categoria::where('nome','Computadores')->first();

        $produtos = [
            ['nome' => 'IdeaPad 1i Intel Core i3-1215U 4GB 256GB SSD', 'preco' => 2200.99],
            ['nome' => 'IdeaPad 1 AMD Ryzen 3 7320U 8GB 256GB SSD ', 'preco' => 2376.99],
            ['nome' => 'LOQ Intel Core i7-13650HX 16GB 512GB SSD ', 'preco' => 7919.99],
            ['nome' => 'Lenovo V14 AMD Ryzen 3 7320U 8GB 256GB SSD', 'preco' => 2375.99],
        ];

        $this->createProducts($produtos, $marca->id, $categoria->id);
    }

    public function seedMotorola(): void
    {
        $marca = Marca::where('nome','Motorola')->first();
        $categoria = Categoria::where('nome','Eletrônicos')->first();

        $produtos = [
            ['nome' => 'Walkie talkie', 'preco' => 184.55],
            ['nome' => 'Talkabout T210BR', 'preco' => 395.00],
            ['nome' => 'Cable Modem MB8611', 'preco' => 1074.62],
            ['nome' => 'Roteador Gigabit MR1700', 'preco' => 240.00],
        ];

        $this->createProducts($produtos, $marca->id, $categoria->id);
    }

    public function seedSamsung(): void
    {
        $marca = Marca::where('nome', 'Samsung')->first();
        $categoria = Categoria::where('nome','Celulares')->first();

        $produtos = [
            ['nome' => 'Galaxy A55', 'preco' => 2069.10],
            ['nome' => 'Galaxy A25', 'preco' => 1549.00],
            ['nome' => 'Galaxy S24+', 'preco' => 3969.00],
            ['nome' => 'Galaxy S24 Ultra', 'preco' => 6999.00],
        ];

        $this->createProducts($produtos, $marca->id, $categoria->id);
    }

    private function createProducts(array $produtos, $marcaId, $categoriaId): void
    {
        foreach ($produtos as $produto) {
            Produto::factory()->create([
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'categoria_id' => $categoriaId,
                'marca_id' => $marcaId,
            ]);
        }
    }
}
