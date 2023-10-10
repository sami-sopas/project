{{-- Componente que se llama cuando el producto no tiene talla ni color--}}
<div>
    <style>
        span::-webkit-inner-spin-button,
        span::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .custom-number-input span:focus {
            outline: none !important;
        }

        .custom-number-input button:focus {
            outline: none !important;
        }
    </style>

    <!-- Stock -->
    <p class="text-green-600 dark:text-green-300 font-bold">
        {{ $stock}} en Stock
    </p>

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
            <button type="button"
                class="h-10 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                Add to Cart
            </button>
        </div>
    </div>
</div>
