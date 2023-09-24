<header class="bg-white">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="myContainer border-b border-gray-300">
        <div class="flex items-center h-24">

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
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
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
</header>
