<div class="max-w-3xl mx-auto px-12 sm:px-6 lg:px-8 py-12 text-gray-700">
    
    <h1 class="text-3xl text-center font-semibold mb-8">
        Creacion de producto
    </h1>

    <div class="grid grid-cols-2 gap-6 mb-4 ">
        {{-- Categorias --}}
        <div>
            <x-label value="Categorias" /> {{--Cada que haya un cambio en este select, se actualiza category_id--}}
            <select name="" class="w-full rounded-md" wire:model="category_id" wire:change="updateCategoryId($event.target.value)">
                <option value="" selected disabled>Seleccione una categoria</option>

                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <x-input-error for="category_id" />

        </div>


        {{-- Subcategorias --}}
        <div>
            <x-label value="Subcategorias" /> {{--Cada que haya un cambio en este select, se actualiza category_id--}}
            <select name="" class="w-full rounded-md" wire:model="subcategory_id" wire:model="subcategory_id" wire:change="updateSubcategoryId($event.target.value)">
                <option value="" selected disabled>Seleccione una subcategoria</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
            </select>

            <x-input-error for="subcategory_id" />

        </div>

    </div>

    {{-- Nombre --}}
    <div class="mb-4">
        <x-label value="Nombre" />
        <x-input 
            type="text" 
            class="w-full" 
            wire:model.live="name"
            placeholder="Ingrese el nombre del producto" />
        
        <x-input-error for="name" />
    </div>

    {{-- Slug ( no se muestra )--}}
    <div class="mb-4">
        <x-label value="Slug" />
        <x-input 
            type="text" 
            class="w-full"
            disabled 
            wire:model.live="slug"
            placegolder="Slug del producto" />
        
        <x-input-error for="slug" />
    </div>

    {{-- Descripcion --}}
    <div class="mb-4"> {{-- wire:ignore, para q renderize todo menos este componente--}}

        <div wire:ignore>
            <x-label value="Descripcion" />
            <textarea 
                wire:model.live="description"
                x-data {{-- Inicializar CKEditor--}}
                x-init="ClassicEditor.create($refs.myEditor)
                    .then(function(editor){
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData())
                        })
                    })
                    .catch( error => {
                        console.error( error );
                    } );"
                x-ref="myEditor"
                class="w-full border border-gray-400 rounded-md" 
                cols="30" 
                rows="4">
            </textarea>
        </div>
        <x-input-error for="description" />
    </div>

    {{-- Precio --}}
    <div class="mb-4">
            <x-label value="Precio" />
            <x-input 
                wire:model.live="price"
                type="number" 
                step=".01"
                class="w-full"
            />
            <x-input-error for="price" />
    </div>

    {{-- Imprime todo el objeto de subcategoria seleccioanda: 
        {{$this->subcategory}} --}}
    {{$this->subcategory}}

    @if ($subcategory_id)
        {{-- Productos que no necesitan color y talla--}}
        @if (!$this->subcategory->color && !$this->subcategory->size)
            
            <div>
                <x-label value="Cantidad" />
                <x-input 
                    wire:model.live="quantity"
                    type="number" 
                    class="w-full" />
                <x-input-error for="quantity" />
            </div>

        @endif      
    @endif

    <div class="flex mt-4">
        <x-button 
            wire:click="save"
            class="ml-auto">
            Crear producto
        </x-button>
    </div>

    
    
</div>
