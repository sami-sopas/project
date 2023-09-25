<header class="bg-white sticky top-0">
    <style>
        /* estilos para el efecto hover de la linea */
        .link-underline {
            border-bottom-width: 0;
            background-image: linear-gradient(transparent, transparent), linear-gradient(#fff, #fff);
            background-size: 0 3px;
            background-position: 50% 100%;
            /* Comienza desde el centro */
            background-repeat: no-repeat;
            transition: background-size .4s ease-in-out, background-position .4s ease-in-out;
            /* Agregamos background-position aquí */
        }

        .link-underline-black {
            background-image: linear-gradient(transparent, transparent), linear-gradient(rgb(190, 188, 233), rgb(190, 188, 233));
        }

        .link-underline:hover {
            background-size: 100% 3px;
            background-position: 0 100%;
        }
    </style>

    <!-- Primera barra de navegacion -->
    <div class="myContainer border-b border-gray-300">
        <div class="flex items-center h-20">

            <!-- Logo -->
            <div class="shrink-0 flex items-center ms-6 me-10">
                <a href="{{ route('dashboard') }}">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Barra de busqueda -->
            @livewire('search')

            <!-- Dropdown de usuario -->
            <div class="mx-6 relative">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <i class="fa-regular fa-user text-xl cursor-pointer"></i>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('login') }}">
                                {{ __('Login') }}
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('register') }}">
                                {{ __('Register') }}
                            </x-dropdown-link>

                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Dropdown de bolsa de compra -->
            @livewire('dropdown-bag')

        </div>
    </div>

    <!-- Segunda barra de navegacion -->
    <nav class="absolute w-full bg-gray-300">
        <div class="myContainer h-14 flex items-center justify-center relative">
            <!-- Categorías -->
            <ul class="flex space-x-12 justify-center font-semibold">
                @foreach ($categories as $category)
                    <li class="link-underline-black link-underline relative group px-3 py-2">
                        <button class="hover:opacity-50 cursor-default">{{ $category->name }}</button>
                        <!-- Mega Menú -->
                        <div
                            class="absolute top-7 left-1/2 -translate-x-1/2 transform transition group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 ease-in-out z-50 min-w-[200px]">
                            <!-- Contenido del Mega Menú -->
                            <div class="relative p-6 bg-white rounded-md shadow-md w-full">
                                <div
                                    class="w-10 h-10 bg-white transform rotate-45 absolute z-0 -translate-x-4 transition-transform group-hover:translate-x-3 duration-500 ease-in-out rounded-sm left-1/2 -translate-x-2.5">
                                </div>
                                <div class="relative z-10">
                                    <ul class="text-[15px]">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>
                                                <a href="#"
                                                    class="text-gray-600 hover:text-gray-800 py-1 block font-normal">
                                                    {{ $subcategory->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>





</header>
