<div class="max-w-3xl mx-auto px-12 sm:px-6 lg:px-8 py-12 text-gray-700">

    <h1 class="text-3xl text-center font-semibold mb-8">
        Creacion de producto
    </h1>

    <div class="bg-white shadow-xl rounded-lg p-6">

        {{ $product }}

        <div class="grid grid-cols-2 gap-6 mb-4 ">
            {{-- Categorias --}}
            <div>
                <x-label value="Categorias" /> {{-- Cada que haya un cambio en este select, se actualiza category_id --}}
                <select name="" class="w-full rounded-md" wire:model.live="category_id">
                    <option value="" selected disabled>Seleccione una categoria</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <x-input-error for="category_id" />

            </div>
            {{-- Subcategorias --}}
            <div>
                <x-label value="Subcategorias" />
                <select name="" class="w-full rounded-md" wire:model.live="subcategory_id">
                    <option value="" selected disabled>Seleccione una subcategoria</option>

                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>

                <x-input-error for="subcategory_id" />

            </div>
        </div>

        {{-- Nombre --}}
        <div class="mb-4">
            <x-label value="Nombre" />
            <x-input type="text" class="w-full" wire:model="name" placeholder="Ingrese el nombre del producto" />

            <x-input-error for="name" />
        </div>

        {{-- Slug (no se muestra) --}}
        <div class="mb-4">
            <x-label value="Slug" />
            <x-input type="text" class="w-full" disabled wire:model="slug" placeholder="Slug del producto" />

            <x-input-error for="product.slug" />
        </div>

        {{-- Descripción --}}
        <div class="mb-4" wire:ignore.self>
            <div wire:ignore>
                <x-label value="Descripción" />
                <textarea wire:model="description" x-data x-init="ClassicEditor.create($refs.myEditor)
                    .then(function(editor) {
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData())
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });" x-ref="myEditor"
                    class="w-full border border-gray-400 rounded-md" cols="30" rows="4">
            </textarea>
            </div>
            <x-input-error for="description" />
        </div>

        {{-- Precio --}}
        <div class="mb-4">
            <x-label value="Precio" />
            <x-input wire:model="price" type="number" step=".01" class="w-full" />
            <x-input-error for="price" />
        </div>


        {{-- Imprime todo el objeto de subcategoria seleccioanda: --}}
        {{$this->subcategory}}

        @if($this->subcategory)
            @if (!$this->subcategory->color && !$this->subcategory->size)
                <div>
                    <x-label value="Cantidad" />
                    <x-input wire:model="quantity" type="number" class="w-full" />
                    <x-input-error for="quantity" />
                </div>
            @endif
        @endif

        <div class="flex mt-4 justify-end items-center">
            {{-- Se llama desde el EditProduct con un dispatch--}}
            <x-action-message class="mr-3" on="saved">
                Actualizado
            </x-action-message>

            <x-button wire:click="save">
                Actualizar producto
            </x-button>
        </div>

    </div>

    {{-- Saber si tenemos una subcategoria seleccionada--}}
    @if($this->subcategory)

        {{-- La subcategoria tiene talla--}}
        @if($this->subcategory->size)
            
            {{-- LLave unica para cada producto--}}
            @livewire('admin.size-product',['product' => $product],key('size-product-' . $product->id))

        {{-- Tiene color--}}
        @elseif($this->subcategory->color)

            @livewire('admin.color-product',['product' => $product],key('color-product-' . $product->id))

        @endif
    @endif

    <script>
        Livewire.on('refreshPage', function () {
            location.reload();
        });
    </script>
</div>
