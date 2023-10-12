<div> <!-- Dropdown de la bolsita de compras que sera dinamica -->
    <x-dropdown width="96"> <!-- Cambiar ancho del div al abrir la bolsa -->
        <x-slot name="trigger">
            <span class="cursor-pointer mt-3">
                <x-shopping-bag color="black"/>
                {{-- ESTE ICONO DESAPARECE XD MEJOR USAMOS X-SHOPPING-BAG
                    <ion-icon name="bag-handle-outline"></ion-icon> --}}

                <!-- Productos acuales en carrito circulo rojo -->
                @if (Cart::count())
                    <!-- Punto rojo-->
                    <span class="count">{{Cart::count()}}</span>
                @endif
            </span>
        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col max-w-3xl p-5 dark:bg-gray-900 dark:text-gray-100">
                <h2 class="text-xl font-semibold mb-5">Your cart</h2>
                <ul class="flex flex-col divide-y divide-gray-300">
                    @forelse (Cart::content() as $item)
                        <li class="flex flex-col sm:flex-row sm:justify-between p-3">
                            <div class="flex w-full space-x-2 sm:space-x-4">
                                <img class="flex-shrink-0 object-cover w-20 h-20 dark:border-transparent rounded outline-none sm:w-32 sm:h-32 dark:bg-gray-500"
                                    src="{{ $item->options->image }}" alt="">
                                <div class="flex flex-col justify-between w-full pb-4">
                                    <div class="flex w-full pb-2 space-x-2">
                                        <div class="space-y-1 text-left">
                                            <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                                            <p class="text-sm dark:text-gray-400">Cantidad: {{ $item->qty }}</p>

                                            {{-- Validar que el producto agregado tiene color e imprimir sus datos--}}
                                            @if($item->options->color)
                                            <div class="flex items-center">
                                                <p class="text-sm dark:text-gray-400 mr-2">Color: {{ $item->options->color->name }}</p>
                                                <div style="background-color: {{ $item->options->color->hex_code }}; width: 18px; height: 18px; border-radius: 50%; border: 1px solid gray;"></div>
                                            </div>
                                            @endif

                                            {{-- Validar que el producto agregado tenga talla e imprimirla --}}
                                            @if($item->options->size)
                                            <div class="flex items-center">
                                                <p class="text-sm dark:text-gray-400 mr-2">Talla: {{ $item->options->size->name }}</p>
                                                
                                            </div>
                                            @endif
                                            <p class="text-sm dark:text-gray-400">$ {{ $item->price }}</p>
                                        </div>
                                    </div>
                                    <div class="flex text-sm divide-x">

                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li>
                            <p class="text-center text-gray-700 py-6 px4">
                                Ups, aun no hay items
                            </p>
                        </li>
                    @endforelse
                </ul>

                {{-- Hay items en el carrito? Mostrar total a pagar --}}
                @if (Cart::count())
                    <div class="text-left my-3 text-lg">
                        <p class="font-semibold">Total:
                            <span class="font-normal">{{Cart::subtotal()}} $</span>
                        </p>
                    </div>
                    <div class="w-full">
                        <a
                        class="text-lg px-6 py-2 border rounded-md bg-violet-400 text-gray-900 border-violet-400">
                            <span class="text-white font-bold">Ir a pagar</span>
                        </a>
                    </div>
                @endif

            </div>

            {{-- <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex">
                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">

                        <section class="flex-1">
                            <p class="font-bold">{{ $item->name}}</p>
                        </section>
                    </li>

                @empty
                    <li>
                        <p class="text-center text-gray-700 py-6 px4">
                            Ups, aun no hay items
                        </p>
                    </li>
                @endforelse
            </ul> --}}
        </x-slot>
    </x-dropdown>
</div>
