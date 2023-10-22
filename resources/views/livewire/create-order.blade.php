<div class="container py-8 grid grid-cols-5 gap-6">

    <!-- Primera columna -->
    <div class="col-span-3">
        <div class="bg-white rounded-lg shadow p-6"> {{--- Card --}}
            <div class="mb-6">
                <x-label value="Nombre de contacto"/>
                <x-input type="text" 
                placeholder="Persona que recibira el producto"
                class="w-full my-1"/>
            </div>

            <div>
                <x-label value="Telefono de contacto"/>
                <x-input type="text" 
                placeholder="Ingrese un numero de telefono de contacto"
                class="w-full my-1"/>
            </div>

        </div>

        <!-- Seccion envios -->
        <div>   
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold ml-1">
                Envios
            </p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input type="radio" name="shipping" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    Recojo en tienda (C. Othón Blanco, Guadalajara, Jal., Mexico)
                </span>
                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="bg-white rounded-lg px-6 py-4 flex items-center">
                    <input type="radio" name="shipping" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Envio a domicilio
                    </span>
                </label>

                <div class="px-6 pb-6 grid grid-cols-2 gap-6">
                    <!-- Paises -->
                    <div>
                        <x-label value="Pais"/>
                                                        {{--Vinculamos con la prpiedad de createOrder--}}
                        <select class="w-full p-2 rounded" wire:model="country_id">
                            <option value="" disabled selected>Seleccione un pais</option>

                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estados -->
                    <div>
                        <x-label value="Estado"/>
                        {{--Vinculamos con la prpiedad de createOrder--}}
                        <select class="w-full p-2 rounded" wire:model="state_id">
                            <option value="" disabled selected>Seleccione un estado</option>

                            @foreach ($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Direccion -->
                    <div class="col-span-2">
                        <x-label value="Direccion"/>
                        <x-input wire:model="address" type="text" placeholder="Av. Matalas, Calle. Sobredosis de ternura" />
                    </div>

                    <!-- Referencia -->
                    <div class="col-span-2">
                        <x-label value="Referencia"/>
                        <x-input wire:model="reference" type="text" placeholder="Porton blanco, en el cerro"/>
                    </div>


                </div>
            </div>
            
        </div>

        <div>
            <x-button class="mt-6 mb-4">
                Continuar con la compra
            </x-button>

            <hr>

            <p class="text-sm text-gray-700 mt-2">Zorra, estupida, bastarda te amo. Al realizar esta compra, estas de acuerdo con la <a class="font-semibold text-blue-400 inline-block" href="https://www.youtube.com/watch?v=3pJ57JAbu-U">Politica de privacidad</a>
            </p>
        </div>
        
    </div>

    <!-- Segunda columna -->
    <div class="col-span-2">

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-lg text-gray-800 font-semibold ml-3 mb-2">Pedidos</p>

            <hr>

            <ul class="flex flex-col divide-y divide-gray-300 mt-1">
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
                                            <p class="text-sm dark:text-gray-400 mr-2">Talla: {{ $item->options->size }}</p>
                                            
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

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{ Cart::subtotal() }} $</span>
                </p>

                <p class="flex justify-between items-center mt-1">
                    Envio
                    <span class="font-semibold">Gratis</span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center mt-1 font-semibold">
                    <span class="text-lg">Total</span>
                   {{ Cart::subtotal() }} $
                </p>


            </div>


        </div>
        
    </div>
</div>
