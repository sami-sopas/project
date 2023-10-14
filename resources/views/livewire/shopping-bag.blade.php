<div>
    <style>
        @layer utilities {
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
      }
    </style>

<section class="container py-8">
    <div class="bg-white rounded-lg border border-gray-200 shadow-lg p-6">
        <div class="min-h-screen">
            @if (Cart::count())
            <h1 class="mb-10 text-center text-2xl font-bold">Mi Bolsa</h1>
            <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
                <div class="rounded-lg md:w-2/3">
                    @foreach (Cart::content() as $item)
                        <div 
                        {{-- Esta wire:key es porque no funcionaba al eliminar de arriba a abajo (problemas de livewire con foreachs) --}}
                        wire:key="{{ $item->rowId }}"
                        class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                            <img src="{{ $item->options->image }}" alt="product-image" class="w-full rounded-lg sm:w-40" />
                            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                <div class="mt-5 sm:mt-0">
                                    <h2 class="text-lg font-bold text-gray-900">{{ $item->name }}</h2>

                                    <!-- Mostrar datos por si tienen talla y color -->
                                    <div class="flex flex-col items-start">
                                        @if ($item->options->size)
                                            <p class="mt-1 text-sm text-gray-700">
                                                <span class="font-bold">Talla:</span> {{ $item->options->size }}
                                            </p>
                                        @endif
                                    
                                        @if ($item->options->color)
                                            <div class="mt-1 flex items-center">
                                                <p class="text-sm text-gray-700">
                                                    <span class="font-bold">Color:</span> {{ $item->options->color->name }}
                                                </p>
                                                <div style="background-color: {{ $item->options->color->hex_code }}; width: 20px; height: 20px; border-radius: 5px; margin-left: 5px; border: 1px solid #ccc;"></div>
                                            </div>
                                        @endif
                                    </div>
                                
                                </div>
                                <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">

                                    <!-- Input Counter -->
                                    <div class="flex items-center border-gray-100">
                                        {{--$item->rowID--}}
                                        {{-- Le pasamos al componente del counter, el Id del carrito perteneciente a cada item 
                                            tambien determinamos si sera para un item con color o talla --}}
                                        @if ($item->options->size)
                                            @livewire('update-bag-item-size',['rowId' => $item->rowId], key($item->rowId))

                                        @elseif ($item->options->color)
                                        @livewire('update-bag-item-color',['rowId' => $item->rowId], key($item->rowId))

                                        @else
                                            @livewire('update-bag-item',['rowId' => $item->rowId], key($item->rowId))    
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <p class="text-sm">$ {{ $item->price * $item->qty }}</p>
                                        
                                        <!-- Eliminar item individual -->
                                        <a
                                         class="hover:text-red-500 cursor-pointer"
                                         wire:click="delete('{{$item->rowId}}')"
                                         {{-- Mientras se ejecuta el metodo, mantenemos en color rojo el icono--}}
                                         wire:loading.class="text-red-500 opacity-20"
                                         wire:target="delete('{{$item->rowId}}')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Eliminar todos los items (vista computadora) -->
                    <a class="cursor-pointer py-3 px-4 hidden md:inline-block justify-center items-center gap-2 rounded-md bg-red-100 border border-transparent font-semibold text-red-500 hover:text-white hover:bg-red-100 focus:outline-none focus:ring-2 ring-offset-white focus:ring-red-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                       wire:click="destroy">
                        <i class="fa-solid fa-trash mx-2"></i>
                        Eliminar bolsa
                    </a>
                </div>

                <!-- A pagar mamawebo -->
                <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                    <div class="mb-2 flex justify-between">
                        <p class="text-gray-700">Subtotal</p>
                        <p class="text-gray-700">$129.99</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-700">Shipping</p>
                        <p class="text-gray-700">$4.99</p>
                    </div>
                    <hr class="my-4" />
                    <div class="flex justify-between">
                        <p class="text-lg font-bold">Total</p>
                        <div class="">
                            <p class="mb-1 text-lg font-bold">$ {{Cart::subTotal()}}</p>
                            {{-- <p class="text-sm text-gray-700">including VAT</p> --}}
                        </div>
                    </div>
                    <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">
                        Continuar
                    </button>

                    <!-- Eliminar todos los items (vista celular) -->
                    <a class="py-3 w-full mt-5 px-4 lg:hidden inline-flex justify-center items-center gap-2 rounded-md bg-red-100 border border-transparent font-semibold text-red-500 hover:text-white hover:bg-red-100 focus:outline-none focus:ring-2 ring-offset-white focus:ring-red-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                       wire:click="destroy">
                        Eliminar bolsa
                    </a>

                </div>
            </div>
            @else
            <div>
                No tienes productos agregados a tu carrito

                Aqui un boton pa regresar al inicio DOBLE R
            </div>
            @endif
        </div>
    </div>
</section>

</div>
