<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Produto;

class Busca extends Component
{
    public string $termoBusca = '';
    public array $categoriasSelecionadas = [];
    public array $marcasSelecionadas = [];

    public function mount(Request $request): void
    {
        $this->termoBusca = $request->query('termoBusca', $this->termoBusca);
        $this->categoriasSelecionadas = $request->query('categoriasSelecionadas', $this->categoriasSelecionadas);
        $this->marcasSelecionadas = $request->query('marcasSelecionadas', $this->marcasSelecionadas);
    }

    public function limparCategorias(): void
    {
        $this->categoriasSelecionadas = [];
        $this->dispatch('updateQueryString', 'categoriasSelecionadas', $this->categoriasSelecionadas)->self();
    }

    public function limparMarcas(): void
    {
        $this->marcasSelecionadas = [];
        $this->dispatch('updateQueryString', 'marcasSelecionadas', $this->marcasSelecionadas)->self();
    }

    public function limparFiltros(): void
    {
        $this->termoBusca = '';
        $this->limparCategorias();
        $this->limparMarcas();
    }

    public function render(): View
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();

        $produtos = Produto::query()
            ->when($this->termoBusca, function ($query) {
                $query->where(function ($query) {
                    $query->where('nome', 'LIKE', '%' . $this->termoBusca . '%')
                        ->orWhereHas('categoria', function ($query) {
                            $query->where('nome', 'LIKE', '%' . $this->termoBusca . '%');
                        })
                        ->orWhereHas('marca', function ($query) {
                            $query->where('nome', 'LIKE', '%' . $this->termoBusca . '%');
                        });
                });
            })
            ->when($this->categoriasSelecionadas, function ($query) {
                if (!empty($this->categoriasSelecionadas)) {
                    $query->whereIn('categoria_id', $this->categoriasSelecionadas);
                }
            })
            ->when($this->marcasSelecionadas, function ($query) {
                if (!empty($this->marcasSelecionadas)) {
                    $query->whereIn('marca_id', $this->marcasSelecionadas);
                }
            })
            ->get();

        return view('livewire.busca', [
            'marcas' => $marcas,
            'categorias' => $categorias,
            'produtos' => $produtos
        ]);
    }
}
