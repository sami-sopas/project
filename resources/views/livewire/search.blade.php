<div class="flex-1 relative" x-data>

    {{-- Enviamos a la ruta search, lo que tengamos en el input --}}
    <form action="{{ route('search')}}" autocomplete="off">

        <!-- Barra busqueda -->
        <input wire:model.live="search"
        type="search" 
        name="name"
        class="search-field" 
        placeholder="Enter your product name...">
        <!-- Componente de lupa -->
        <button href="#" class="absolute top-0 right-0 w-10 h-full flex-items-center justify-center">
            <x-search size="25" color="gray"/>
        </button>

    </form>
        
    <!-- Aqui muestran los resultados de acuerdo a lo que escribio -->
    <div class="absolute w-full z-50 hidden"  :class="{ 'hidden' : !$wire.open }" @click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow mt-1">
            <div class="px-4 py-3 space-y-2">
                @forelse ($products as $product)
                    <a href="{{ route('products.show',$product )}}" class="flex">
                        <img src="{{Storage::url($product->images->first()->url)}}" alt="" class="w-16 h-12 object-cover">

                        <div class="ml-4 text-gray-500">
                            <p class="text-lg font-semibold">{{$product->name}}</p>
                            <p class="text-pink-400">{{$product->subcategory->category->name}}</p>
                        </div>
                    </a>
                @empty
                    <p>No hemos encontrado resultados para <span class="font-bold">{{$search}}</span></p>
                @endforelse
            </div>
        </div>
    </div>
</div>
