<div class="container py-8 grid grid-cols-5 gap-6">

    <!-- Estilos para el boton mamalon -->
    <style>
        .truck-button {
            --color: #fff;
            --background: #2b3044;
            --tick: #16bf78;
            --base: #0d0f18;
            --wheel: #2b3044;
            --wheel-inner: #646b8c;
            --wheel-dot: #fff;
            --back: #6d58ff;
            --back-inner: #362a89;
            --back-inner-shadow: #2d246b;
            --front: #a6accd;
            --front-shadow: #535a79;
            --front-light: #fff8b1;
            --window: #2b3044;
            --window-shadow: #404660;
            --street: #646b8c;
            --street-fill: #404660;
            --box: #dcb97a;
            --box-shadow: #b89b66;
            padding: 12px 0;
            width: 172px;
            cursor: pointer;
            text-align: center;
            position: relative;
            border: none;
            outline: none;
            color: var(--color);
            background: var(--background);
            border-radius: var(--br, 5px);
            -webkit-appearance: none;
            -webkit-tap-highlight-color: transparent;
            transform-style: preserve-3d;
            transform: rotateX(var(--rx, 0deg)) translateZ(0);
            transition: transform 0.5s, border-radius 0.3s linear var(--br-d, 0s);
        }

        .truck-button:before,
        .truck-button:after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 6px;
            display: block;
            background: var(--b, var(--street));
            transform-origin: 0 100%;
            transform: rotateX(90deg) scaleX(var(--sy, 1));
        }

        .truck-button:after {
            --sy: var(--progress, 0);
            --b: var(--street-fill);
        }

        .truck-button .default,
        .truck-button .success {
            display: block;
            font-weight: 500;
            font-size: 14px;
            line-height: 24px;
            opacity: var(--o, 1);
            transition: opacity 0.3s;
        }

        .truck-button .success {
            --o: 0;
            position: absolute;
            top: 12px;
            left: 0;
            right: 0;
        }

        .truck-button .success svg {
            width: 12px;
            height: 10px;
            display: inline-block;
            vertical-align: top;
            fill: none;
            margin: 7px 0 0 4px;
            stroke: var(--tick);
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 16px;
            stroke-dashoffset: var(--offset, 16px);
            transition: stroke-dashoffset 0.4s ease 0.45s;
        }

        .truck-button .truck {
            position: absolute;
            width: 72px;
            height: 28px;
            transform: rotateX(90deg) translate3d(var(--truck-x, 4px), calc(var(--truck-y-n, -26) * 1px), 12px);
        }

        .truck-button .truck:before,
        .truck-button .truck:after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: var(--l, 18px);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            z-index: 2;
            box-shadow: inset 0 0 0 2px var(--wheel), inset 0 0 0 4px var(--wheel-inner);
            background: var(--wheel-dot);
            transform: translateY(calc(var(--truck-y) * -1px)) translateZ(0);
        }

        .truck-button .truck:after {
            --l: 54px;
        }

        .truck-button .truck .wheel,
        .truck-button .truck .wheel:before {
            position: absolute;
            bottom: var(--b, -6px);
            left: var(--l, 6px);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--wheel);
            transform: translateZ(0);
        }

        .truck-button .truck .wheel {
            transform: translateY(calc(var(--truck-y) * -1px)) translateZ(0);
        }

        .truck-button .truck .wheel:before {
            --l: 35px;
            --b: 0;
            content: '';
        }

        .truck-button .truck .front,
        .truck-button .truck .back,
        .truck-button .truck .box {
            position: absolute;
        }

        .truck-button .truck .back {
            left: 0;
            bottom: 0;
            z-index: 1;
            width: 47px;
            height: 28px;
            border-radius: 1px 1px 0 0;
            background: linear-gradient(68deg, var(--back-inner) 0%, var(--back-inner) 22%, var(--back-inner-shadow) 22.1%, var(--back-inner-shadow) 100%);
        }

        .truck-button .truck .back:before,
        .truck-button .truck .back:after {
            content: '';
            position: absolute;
        }

        .truck-button .truck .back:before {
            left: 11px;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            border-radius: 0 1px 0 0;
            background: var(--back);
        }

        .truck-button .truck .back:after {
            border-radius: 1px;
            width: 73px;
            height: 2px;
            left: -1px;
            bottom: -2px;
            background: var(--base);
        }

        .truck-button .truck .front {
            left: 47px;
            bottom: -1px;
            height: 22px;
            width: 24px;
            -webkit-clip-path: polygon(55% 0, 72% 44%, 100% 58%, 100% 100%, 0 100%, 0 0);
            clip-path: polygon(55% 0, 72% 44%, 100% 58%, 100% 100%, 0 100%, 0 0);
            background: linear-gradient(84deg, var(--front-shadow) 0%, var(--front-shadow) 10%, var(--front) 12%, var(--front) 100%);
        }

        .truck-button .truck .front:before,
        .truck-button .truck .front:after {
            content: '';
            position: absolute;
        }

        .truck-button .truck .front:before {
            width: 7px;
            height: 8px;
            background: #fff;
            left: 7px;
            top: 2px;
            -webkit-clip-path: polygon(0 0, 60% 0%, 100% 100%, 0% 100%);
            clip-path: polygon(0 0, 60% 0%, 100% 100%, 0% 100%);
            background: linear-gradient(59deg, var(--window) 0%, var(--window) 57%, var(--window-shadow) 55%, var(--window-shadow) 100%);
        }

        .truck-button .truck .front:after {
            width: 3px;
            height: 2px;
            right: 0;
            bottom: 3px;
            background: var(--front-light);
        }

        .truck-button .truck .box {
            width: 13px;
            height: 13px;
            right: 56px;
            bottom: 0;
            z-index: 1;
            border-radius: 1px;
            overflow: hidden;
            transform: translate(calc(var(--box-x, -24) * 1px), calc(var(--box-y, -6) * 1px)) scale(var(--box-s, 0.5));
            opacity: var(--box-o, 0);
            background: linear-gradient(68deg, var(--box) 0%, var(--box) 50%, var(--box-shadow) 50.2%, var(--box-shadow) 100%);
            background-size: 250% 100%;
            background-position-x: calc(var(--bx, 0) * 1%);
        }

        .truck-button .truck .box:before,
        .truck-button .truck .box:after {
            content: '';
            position: absolute;
        }

        .truck-button .truck .box:before {
            content: '';
            background: rgba(255, 255, 255, .2);
            left: 0;
            right: 0;
            top: 6px;
            height: 1px;
        }

        .truck-button .truck .box:after {
            width: 6px;
            left: 100%;
            top: 0;
            bottom: 0;
            background: var(--back);
            transform: translateX(calc(var(--hx, 0) * 1px));
        }

        .truck-button.animation {
            --rx: -90deg;
            --br: 0;
        }

        .truck-button.animation .default {
            --o: 0;
        }

        .truck-button.animation.done {
            --rx: 0deg;
            --br: 5px;
            --br-d: 0.2s;
        }

        .truck-button.animation.done .success {
            --o: 1;
            --offset: 0;
        }

        html {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        * {
            box-sizing: inherit;
        }

        *:before,
        *:after {
            box-sizing: inherit;
        }
    </style>

    <!-- Primera columna -->
    <div class="col-span-3">
        <div class="bg-white rounded-lg shadow p-6"> {{-- - Card --}}
            <div class="mb-6">
                <x-label value="Nombre de contacto" />
                <x-input 
                    wire:model.defer="contact" {{-- Con .defer, se actualiza la info cuando se presiona el boton y no cuando se escribe --}}
                    type="text" 
                    placeholder="Persona que recibira el producto" 
                    class="w-full my-1" />
                <x-input-error for="contact"/> <!-- Mostrar error -->
            </div>

            <div>
                <x-label value="Telefono de contacto" />
                <x-input
                    wire:model.defer="phone" 
                    type="text" 
                    placeholder="Ingrese un numero de telefono de contacto" 
                    class="w-full my-1" />
                <x-input-error for="phone"/>
            </div>

        </div>

        <!-- Seccion envios (inicializamos alpine aqui) -->
        {{-- Con esto vinculamos este div a la variable que declaramos
              en CreateOrder.php, para que este vinculado alpine y livewire
              (Si se cambia aqui, tambien se cambia en el componente de livewire )
         --}}
        <div x-data="{ shipping_type: @entangle('shipping_type') }">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold ml-1">
                Envios
            </p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input 
                x-model="shipping_type" 
                type="radio" 
                name="shipping_type" 
                value="1" 
                class="text-gray-600"
                wire:click="pickupStore">
                <span class="ml-2 text-gray-700">
                    Recoger en tienda (C. Othón Blanco, Guadalajara, Jal., Mexico)
                </span>
                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>


            <div class="bg-white rounded-lg shadow">
                <label class="bg-white rounded-lg px-6 py-4 flex items-center">
                    <input 
                        x-model="shipping_type" 
                        type="radio" 
                        name="shipping_type" 
                        value="2"
                        class="text-gray-600"
                        wire:click="sendHome">
                    <span class="ml-2 text-gray-700">
                        Envio a domicilio
                    </span>
                </label>

                {{-- Este div estara oculto por defecto,
                    cuando cambie el valor de shipping_type al dar click al input radio con value 2
                    Se le quitara esa clase --}}
                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': shipping_type != 2 }">
                    <!-- Paises -->
                    <div>
                        <x-label value="Pais" />
                        {{-- Vinculamos con la prpiedad de createOrder --}}
                        <select 
                        class="w-full p-2 rounded" 
                        wire:model.live="country_id">
                            <option value="" disabled selected>Seleccione un pais</option>

                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="country_id"/>
                    </div>

                    <!-- Estados -->
                    <div>
                        <x-label value="Estado" />
                        {{-- Vinculamos con la prpiedad de createOrder --}}
                        <select class="w-full p-2 rounded" wire:model="state_id">
                            <option value="" disabled selected>Seleccione un estado</option>

                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="state_id"/>
                    </div>

                    <!-- Direccion -->
                    <div class="col-span-2">
                        <x-label value="Direccion" />
                        <x-input wire:model="address" type="text"
                            placeholder="Av. Matalas, Calle. Sobredosis de ternura" />
                            <x-input-error for="address"/>
                    </div>

                    <!-- Referencia -->
                    <div class="col-span-2">
                        <x-label value="Referencia" />
                        <x-input wire:model="reference" type="text" placeholder="Porton blanco, en el cerro" />
                        <x-input-error for="reference"/>
                    </div>


                </div>
            </div>

        </div>

        <div>
            <hr class="mt-4">

            <p class="text-sm text-gray-700 mt-2">Zorra, estupida, bastarda te amo. Al realizar esta compra, estas de
                acuerdo con la <a class="font-semibold text-blue-400 inline-block"
                    href="https://www.youtube.com/watch?v=3pJ57JAbu-U">Politica de privacidad</a>
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

                                        {{-- Validar que el producto agregado tiene color e imprimir sus datos --}}
                                        @if ($item->options->color)
                                            <div class="flex items-center">
                                                <p class="text-sm dark:text-gray-400 mr-2">Color:
                                                    {{ $item->options->color->name }}</p>
                                                <div
                                                    style="background-color: {{ $item->options->color->hex_code }}; width: 18px; height: 18px; border-radius: 50%; border: 1px solid gray;">
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Validar que el producto agregado tenga talla e imprimirla --}}
                                        @if ($item->options->size)
                                            <div class="flex items-center">
                                                <p class="text-sm dark:text-gray-400 mr-2">Talla:
                                                    {{ $item->options->size }}</p>

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
                    <span class="font-semibold">
                        @if ($shipping_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                            {{$shipping_cost}} $                           
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center mt-1 font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($shipping_type == 1)
                        {{ Cart::subtotal() }} $
                    @else
                    {{ Cart::subtotal() + $shipping_cost}} $
                    @endif
                </p>

                <!-- Boton pasadisimo de lanza -->
                <div class="mt-7 flex justify-center">
                    <button 
                    wire:loading.attr="disabled" {{--Boton deshabilitado mientras carga la acction--}}
                    wire:target="create_order"
                    wire:click="create_order" 
                    class="truck-button text-lg">
                        <span class="default">Completar orden</span>
                        <span class="success">
                            Orden realizada
                            <svg viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg>
                        </span>
                        <div class="truck">
                            <div class="wheel"></div>
                            <div class="back"></div>
                            <div class="front"></div>
                            <div class="box"></div>
                        </div>
                    </button>
                </div>

            </div>

        </div>



    </div>

    <!-- Scripts para q jale el boton mamalon -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.0.1/dist/gsap.min.js"></script>
    <script>
        document.querySelectorAll('.truck-button').forEach(button => {
            button.addEventListener('click', e => {

                e.preventDefault();

                let box = button.querySelector('.box'),
                    truck = button.querySelector('.truck');

                if (!button.classList.contains('done')) {

                    if (!button.classList.contains('animation')) {

                        button.classList.add('animation');

                        gsap.to(button, {
                            '--box-s': 1,
                            '--box-o': 1,
                            duration: .3,
                            delay: .5
                        });

                        gsap.to(box, {
                            x: 0,
                            duration: .4,
                            delay: .7
                        });

                        gsap.to(button, {
                            '--hx': -5,
                            '--bx': 50,
                            duration: .18,
                            delay: .92
                        });

                        gsap.to(box, {
                            y: 0,
                            duration: .1,
                            delay: 1.15
                        });

                        gsap.set(button, {
                            '--truck-y': 0,
                            '--truck-y-n': -26
                        });

                        gsap.to(button, {
                            '--truck-y': 1,
                            '--truck-y-n': -25,
                            duration: .2,
                            delay: 1.25,
                            onComplete() {
                                gsap.timeline({
                                    onComplete() {
                                        button.classList.add('done');
                                    }
                                }).to(truck, {
                                    x: 0,
                                    duration: .4
                                }).to(truck, {
                                    x: 40,
                                    duration: 1
                                }).to(truck, {
                                    x: 20,
                                    duration: .6
                                }).to(truck, {
                                    x: 96,
                                    duration: .4
                                });
                                gsap.to(button, {
                                    '--progress': 1,
                                    duration: 2.4,
                                    ease: "power2.in"
                                });
                            }
                        });

                    }

                } else {
                    button.classList.remove('animation', 'done');
                    gsap.set(truck, {
                        x: 4
                    });
                    gsap.set(button, {
                        '--progress': 0,
                        '--hx': 0,
                        '--bx': 0,
                        '--box-s': .5,
                        '--box-o': 0,
                        '--truck-y': 0,
                        '--truck-y-n': -26
                    });
                    gsap.set(box, {
                        x: -24,
                        y: -6
                    });
                }

            });
        });
    </script>

</div>
