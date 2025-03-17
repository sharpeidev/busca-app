<div>
    <div id="filter" class="flex gap-4">
        <label class="input input-bordered flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
              <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
            </svg>
            <input wire:model.live="termoBusca" type="text" class="grow" placeholder="Buscar" />
        </label>
        <x-dropdown label="Marca {{count($marcasSelecionadas) > 0 ? '(' .count($marcasSelecionadas) . ')' : '' }}" class="input input-bordered">
            <x-menu-item title="Limpar" wire:click="limparMarcas" />
            <x-menu-separator />
            @foreach ($marcas as $marca)
            <x-menu-item @click.stop="">
                <x-checkbox wire:model.live="marcasSelecionadas" label="{{ $marca->nome }}" value="{{ $marca->id }}" />
            </x-menu-item>
            @endforeach
        </x-dropdown>
        <x-dropdown label="Categoria {{count($categoriasSelecionadas) > 0 ? '(' .count($categoriasSelecionadas) . ')' : '' }}" class="input input-bordered">
            <x-menu-item title="Limpar" wire:click="limparCategorias" />
            <x-menu-separator />
            @foreach ($categorias as $categoria)
            <x-menu-item @click.stop="">
                <x-checkbox wire:model.live="categoriasSelecionadas" label="{{ $categoria->nome }}" value="{{ $categoria->id }}" />
            </x-menu-item>
            @endforeach
        </x-dropdown>
        <x-button wire:click="limparFiltros" label="Limpar" icon="o-x-mark" />
    </div>
    <hr class="my-5">
    <div id="content" class="grid grid-cols-4 gap-4">
        @foreach ($produtos as $key => $produto)
        <x-card title="$ {{ $produto->preco }}">
            {{ $produto->nome }}
            <p>Marca: {{ $produto->marca->nome }}</p>
            <p>Categoria: {{ $produto->categoria->nome }}</p>
            <x-slot:figure>
                <img src="images/{{ $produto->id }}.jpg" />
            </x-slot:figure>
            <x-slot:menu>
                <x-button icon="o-heart" class="btn-circle btn-sm" />
            </x-slot:menu>
        </x-card>
        @endforeach
    </div>
</div>
