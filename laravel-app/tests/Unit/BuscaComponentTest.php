<?php

namespace Tests\Unit;

use App\Livewire\Busca;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BuscaComponentTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function pesquisa_pelo_nome_do_produto()
    {
        $produtoA = Produto::factory()->create(['nome' => 'Produto A']);
        $produtoB = Produto::factory()->create(['nome' => 'Produto B']);

        Livewire::test(Busca::class)
            ->set('termoBusca', 'Produto A')
            ->assertSee($produtoA->nome)
            ->assertDontSee($produtoB->nome);
    }

    #[Test]
    public function busca_por_nome_categoria_e_marca()
    {
        $categoria = Categoria::factory()->create(['nome' => 'Categoria']);
        $marca = Marca::factory()->create(['nome' => 'Marca']);

        $produto = Produto::factory()->create([
            'nome' => 'Produto',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);

        Livewire::test(Busca::class)
            ->set('termoBusca', 'Produto')
            ->set('categoriasSelecionadas', [$categoria->id])
            ->set('marcasSelecionadas', [$marca->id])
            ->assertSee($produto->nome);
    }

    #[Test]
    public function limpa_os_filtros()
    {
        $categoria = Categoria::factory()->create(['nome' => 'Categoria']);
        $marca = Marca::factory()->create(['nome' => 'Marca']);

        Produto::factory()->create([
            'nome' => 'Produto',
            'categoria_id' => $categoria->id,
            'marca_id' => $marca->id,
        ]);

        Livewire::test(Busca::class)
            ->set('termoBusca', 'Produto')
            ->set('categoriasSelecionadas', [$categoria->id])
            ->set('marcasSelecionadas', [$marca->id])
            ->call('limpaFiltros')
            ->assertSet('termoBusca', '')
            ->assertSet('categoriasSelecionadas', [])
            ->assertSet('marcasSelecionadas', []);
    }
}
