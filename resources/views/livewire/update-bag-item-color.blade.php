<div class="flex" x-data>
    <button 
    class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"
    disabled
    {{-- Deshabilitar boton cuando qty sea menor o igual a 1 --}}
    x-bind:disabled="$wire.qty <= 1" 
    {{-- El boton se deshabilita cuando se ejecuta el metodo decrement (para cuando den muchos clicks) --}}
    wire:loading.attr="disabled" 
    wire:target="decrement"
    wire:click="decrement">
     - 
    </button>

    <span 
    class="h-8 w-8 border-none bg-gray-100 text-center text-xs" type="number" value="" min="1">
    {{$qty}}
    </span>


    <button 
    {{-- Deshabilitar boton cuando la cantidad sea mayor o igual al stock total--}}
    x-bind:disabled="$wire.qty >= $wire.stock" 
    {{-- El boton se deshabilita cuando se ejecuta el metodo increment (para cuando den muchos clicks) --}}
    wire:loading.attr="disabled" 
    wire:target="increment"
    wire:click="increment"
    class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50">
     + 
    </button>
    
</div>
