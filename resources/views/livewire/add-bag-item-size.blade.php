<div>

<!-- Seleccion de Tallas -->
<div class="relative h-10 w-72 min-w-[200px] mt-5">
    <label for="sizes" class="block text-sm font-medium text-gray-900 dark:text-white">
        Tallas
    </label>
    {{-- EL WIRE:MODAL.LIVE PERMITE MOSTRAR LOS COLORES CORRESPONDIENTES AL MOMENTO DE DAR CLICK TARDE 3 HORAS PARA DARME CUENTA Y NO JALABA DIOS MIO ME QUIERO MATAR--}}
    <select wire:model.live="size_id"
     id="sizes" class="h-full w-full rounded-[7px] border px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border focus:border-t-transparent focus:outline-0 disabled:border-0"> 
        {{-- <option value="" disabled selected>Seleccione una talla...</option> --}}
        @foreach ($sizes as $size)
            <option value="{{$size->id}}">{{$size->name}}</option>  
        @endforeach
    </select>
    
</div>
    <!-- Seleccion de Colores -->
    <div class="my-8" x-data="{ selectedColor: '{{ $colors->first()->id }}' }">
        <h2 class="w-16 pb-1 mb-4 text-2xl font-bold border-b border-blue-300 dark:text-gray-400 dark:border-gray-600">
            Color
        </h2>
        <div class="flex flex-wrap mb-2">
            @foreach ($colors as $color)
            <button value="{{ $color->id }}" class="p-1 mb-2 mr-3 rounded-full transition duration-300"
                x-bind:class="{ 'selected-button': selectedColor === '{{ $color->id }}' }"
                x-on:click="selectedColor = '{{ $color->id }}'; $wire.updateStock('{{ $color->id }}')">
                <div class="w-6 h-6 rounded-full" style="background-color: {{ $color->hex_code }}"></div>
            </button>
            @endforeach
        </div>
        <p class="text-gray-500 mt-2" x-show="selectedColor">
            Stock: {{ $stock }}
    </p>
    </div>

    <!-- Cantidad y boton -->
    <div class="flex items-center">
        
        <div x-data> {{-- con x-data inicializamos alpine en todo este div --}}

            <!-- Cantidad de elementos -->
            <div class="custom-number-input h-10 w-32 mb-1">
                <div class="flex flex-row h-full w-full rounded-lg relative bg-transparent mt-1">

                    <button 
                        disabled
                        {{-- Deshabilitar boton cuando qty sea menor o igual a 1 --}}
                        x-bind:disabled="$wire.qty <= 1" 
                        {{-- El boton se deshabilita cuando se ejecuta el metodo decrement (para cuando den muchos clicks) --}}
                        wire:loading.attr="disabled" 
                        wire:target="decrement"
                        wire:click="decrement"
                        class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-10 rounded-l cursor-pointer outline-none">
                        <span class="m-auto text-2xl font-thin">−</span>
                    </button>

                    <span class="flex items-center justify-center w-12 bg-gray-300 font-semibold text-md hover:text-black focus:text-black md:text-base cursor-default text-gray-700  outline-none"
                        name="custom-input-number">
                        {{ $qty }}
                    </span>

                    <button
                        {{-- Deshabilitar boton cuando la cantidad sea mayor o igual al stock total--}}
                        x-bind:disabled="$wire.qty >= $wire.stock" 
                        {{-- El boton se deshabilita cuando se ejecuta el metodo increment (para cuando den muchos clicks) --}}
                        wire:loading.attr="disabled" 
                        wire:target="increment"
                        wire:click="increment"
                        class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-10 rounded-r cursor-pointer">
                        <span class="m-auto text-2xl font-thin">+</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Botón agregar a carrito -->
        <div class="flex-1 ml-4">
            <button 
            wire:click="addItem"
             {{-- Deshabilitar boton cuando la cantidad sea mayor o stock disponible --}}
             x-bind:disabled="$wire.qty > $wire.stock" 
            {{-- wire:loading.attr="disabled" deshabilitar boton mientras se ejecuta el proceso addItem
            wire:target="addItem" --}}
            type="button"
            class="h-10 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                Add to Cart
            </button>
        </div>
    </div>
</div>
