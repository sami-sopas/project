<div class="max-w-3xl mx-auto px-12 sm:px-6 lg:px-8 py-12 text-gray-700">
    
    <h1 class="text-3xl text-center font-semibold mb-8">
        Creacion de producto
    </h1>

    {{"Categoria :" . $category_id}}
    {{"Subcategoria :"  .$subcategory_id}}

    <div class="grid grid-cols-2 gap-6">
        <div>
            <x-label value="Categorias" /> {{--Cada que haya un cambio en este select, se actualiza category_id--}}
            <select name="" class="w-full rounded-md" wire:model="category_id" wire:change="updateCategoryId($event.target.value)">
                <option value="" selected disabled>Seleccione una categoria</option>

                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-label value="Subcategorias" /> {{--Cada que haya un cambio en este select, se actualiza category_id--}}
            <select name="" class="w-full rounded-md" wire:model="subcategory_id" wire:model="subcategory_id" wire:change="updateSubcategoryId($event.target.value)">
                <option value="" selected disabled>Seleccione una subcategoria</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
            </select>
        </div>


    </div>
    
</div>
