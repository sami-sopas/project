<x-app-layout>

    <style>
        /* Estilo para color seleccionado */
        .selected-button {
            border: 1px solid #010f1b; /* Cambia el color del borde al seleccionar */
        }

        /* Estilo para boton de talla seleccionado */
        .selected {
            background-color: #3490dc; /* Cambia el color de fondo para los botones seleccionados */
            color: #fff; /* Cambia el color del texto para los botones seleccionados */
            border-color: #3490dc; /* Cambia el color del borde para los botones seleccionados */
        }

    </style>
    <section class="container">
        <div class="antialiased">
            <div class="py-6">
                <!-- Breadcrumbs -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center space-x-2 text-gray-400 text-sm">
                        <a href="#" class="hover:underline hover:text-gray-600">Home</a>
                        <span>
                            <svg class="h-5 w-5 leading-none text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                        <a href="#" class="hover:underline hover:text-gray-600">Electronics</a>
                        <span>
                            <svg class="h-5 w-5 leading-none text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                        <span>Headphones</span>
                    </div>
                </div>
                <!-- ./ Breadcrumbs -->

                <!-- Imagenes -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="flex flex-col md:flex-row -mx-4">
                        <div class="md:flex-1 px-4">
                            <div x-data="{ image: 1 }" x-cloak>
                                <div class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4">
                                    @foreach ($product->images as $key => $image)
                                        <div x-show="image === {{ $key + 1 }}"
                                            class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                            <img src="{{ Storage::url($image->url) }}" alt="Product Image {{ $key + 1 }}"
                                                class="w-full h-full object-cover rounded-lg">
                                        </div>
                                    @endforeach
                                </div>
                        
                                <div class="flex -mx-2 mb-4">
                                    @foreach ($product->images as $key => $image)
                                        <div class="flex-1 px-2">
                                            <button x-on:click="image = {{ $key + 1 }}"
                                                :class="{ 'ring-2 ring-indigo-300 ring-inset': image === {{ $key + 1 }} }"
                                                class="focus:outline-none w-full rounded-lg h-24 md:h-32 bg-gray-100 flex items-center justify-center">
                                                <img src="{{ Storage::url($image->url) }}" alt="Product Thumbnail {{ $key + 1 }}"
                                                    class="w-full h-full object-cover rounded-lg">
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="px-2 pb-6 mt-6 border-t border-gray-300 dark:border-gray-400 ">
                                <div class="flex flex-wrap items-center mt-6">
                                    <span class="mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="w-4 h-4 text-gray-700 dark:text-gray-400 bi bi-truck"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                                            </path>
                                        </svg>
                                    </span>
                                    <h2 class="text-lg font-medium dark:text-gray-400">Recibelo el {{ now()->addDay(7)->locale('es_ES')->isoFormat('D [de] MMMM [del] YYYY') }}</h2>
                                </div>
                            </div>
                        </div>
                        
                            
                        
                        <!-- Informacion del producto -->
                        <div class="md:flex-1 px-4">
                            <span class="text-lg font-medium text-rose-500 dark:text-rose-200">New</span>
                            <h2 class="max-w-xl mt-2 mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                                {{ $product->name }}</h2>
                            <div class="flex items-center mb-6">
                                <ul class="flex mr-2">
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                                <a href="#" class="text-xs dark:text-gray-400 underline">2 reseñas</a>
                            </div>

                            <div class="flex items-center space-x-4 my-4">
                                <div>
                                    <div class="rounded-lg bg-gray-100 flex py-2 px-4 mx-auto">
                                        <span class="text-indigo-400 mr-1 mt-1">$</span>
                                        <span class="font-bold text-indigo-600 text-3xl">{{ $product->price }}</span>
                                    </div>
                                </div>
                            </div>





                            {{-- <p class="text-green-600 dark:text-green-300 font-bold">8 in stock</p> --}}

                            {{-- <div class="mb-8" x-data="{ selectedColor: '' }">
                                <h2 class="w-16 pb-1 mb-4 text-2xl font-bold border-b border-blue-300 dark:text-gray-400 dark:border-gray-600">
                                    Colores</h2>
                                <div class="flex flex-wrap mb-2">
                                    <button
                                        class="p-1 mb-2 mr-3 rounded-full transition duration-300"
                                        :class="{ 'selected-button': selectedColor === 'stone' }"
                                        x-on:click="selectedColor = 'stone'"
                                    >
                                        <div class="w-6 h-6 rounded-full bg-stone-400"></div>
                                    </button>
                                    <button
                                        class="p-1 mb-2 mr-3 rounded-full transition duration-300"
                                        :class="{ 'selected-button': selectedColor === 'gray' }"
                                        x-on:click="selectedColor = 'gray'"
                                    >
                                        <div class="w-6 h-6 bg-gray-700 rounded-full"></div>
                                    </button>
                                    <button
                                        class="p-1 mb-2 rounded-full transition duration-300"
                                        :class="{ 'selected-button': selectedColor === 'blue' }"
                                        x-on:click="selectedColor = 'blue'"
                                    >
                                        <div class="w-6 h-6 bg-blue-200 rounded-full"></div>
                                    </button>
                                </div>
                                <p class="text-gray-500 mt-2" x-show="selectedColor">
                                    Has seleccionado el color: <span x-text="selectedColor"></span>
                                </p>
                            </div> --}}

                            {{-- Productos que tienen talla --}}
                            @if ($product->subcategory->size)
                                @livewire('add-bag-item-size',['product' => $product])
                            {{-- Productos que no tienen color --}}
                            @elseif ($product->subcategory->color)
                                @livewire('add-bag-item-color',['product' => $product])
                            @else
                                {{-- Aqui el producto NO tiene talla y color--}}
                                @livewire('add-bag-item',['product' => $product])
                            @endif
                            
                            <div class="mb-8">
                                <h2 class="w-16 pb-1 mb-4 text-xl font-semibold border-b border-blue-300 dark:border-gray-600 dark:text-gray-400">
                                    Talla
                                </h2>
                                <div x-data="{ selectedOption: '' }">
                                    <div class="flex flex-wrap -mb-2">
                                        <button
                                            @click="selectedOption = '8GB'"
                                            :class="{ 'bg-blue-400 text-white': selectedOption === '8GB', 'border': selectedOption !== '8GB' }"
                                            class="px-4 py-2 mb-2 mr-4 font-semibold border rounded-md hover:bg-blue-400 hover:text-white dark:border-gray-400 dark:hover:border-gray-300 dark:text-gray-400">
                                            8 GB
                                        </button>
                                        <button
                                            @click="selectedOption = '16GB'"
                                            :class="{ 'bg-blue-400 text-white': selectedOption === '16GB', 'border': selectedOption !== '16GB' }"
                                            class="px-4 py-2 mb-2 mr-4 font-semibold border rounded-md hover:bg-blue-400 hover:text-white dark:border-gray-400 dark:hover:border-gray-300 dark:text-gray-400">
                                            16 GB
                                        </button>
                                        <button
                                            @click="selectedOption = '1TB'"
                                            :class="{ 'bg-blue-400 text-white': selectedOption === '1TB', 'border': selectedOption !== '1TB' }"
                                            class="px-4 py-2 mb-2 font-semibold border rounded-md hover:bg-blue-400 hover:text-white dark:border-gray-400 dark:hover:border-gray-300 dark:text-gray-400">
                                            1 TB
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
