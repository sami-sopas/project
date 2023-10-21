<header>
    <div class="overlay" data-overlay></div>
    <div class="header-main">

        <div class="container">

            <a href="#" class="header-logo">
                <img src="./assets/images/logo/logo.svg" alt="Anon's logo" width="120" height="36">
            </a>

            <!-- Barra de busqueda -->
            <div class="header-search-container">
                 @livewire('search')

                {{-- <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

                <button class="search-btn">
                    <ion-icon name="search-outline"></ion-icon>
                </button>  --}}
            </div>

            <!-- Botones a lado de la barra de busqueda -->
            <div class="header-user-actions">

                @auth
                <x-dropdown align="right" width="48">

                    <!-- Icono -->
                    <x-slot name="trigger">
                        <ion-icon class="text-3xl cursor-pointer" name="person-outline"></ion-icon>
                    </x-slot>

                    <!-- Contenido -->
                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Cuenta') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link class="text-red-600 font-bold" href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>    
                @endauth

                @guest
                <x-dropdown align="right" width="48">

                    <!-- Icono -->
                    <x-slot name="trigger">
                        <ion-icon class="text-3xl cursor-pointer" name="person-outline"></ion-icon>
                    </x-slot>

                    <!-- Contenido -->
                    <x-slot name="content">

                        <x-dropdown-link href="{{ route('login') }}">
                            {{ __('Iniciar sesión') }}
                        </x-dropdown-link>

                        <x-dropdown-link href="{{ route('register') }}">
                            {{ __('Registrarse') }}
                        </x-dropdown-link>
                       
                    </x-slot>
                </x-dropdown>
                @endguest
                
                <button class="action-btn">
                    @livewire('dropdown-bag')
                    {{-- <ion-icon name="bag-handle-outline"></ion-icon>
                    <span class="count">0</span> --}}
                </button>

            </div>

        </div>

    </div>

    <nav class="desktop-navigation-menu">

        <div class="container">

            <ul class="desktop-menu-category-list">

                <!-- NO QUITAR ESTA COSA, PQ SI NO TRUENA EL CSS LOL -->
                <li class="menu-category">
                    <a href="#" class="menu-title"></a>
                </li>

                <!-- MENU QUE MUESTRA TODAS LAS CATEGORIAS Y SUS SUBCATEGORIAS -->
                <li class="menu-category">
                    <a href="#" class="menu-title">Categorias</a>
                    <div class="dropdown-panel">

                        @foreach ($categories as $category)
                            <ul class="dropdown-panel-list">
                                <li class="menu-title">
                                    <a href="{{ route('categories.show',$category) }}">{{ $category->name }}</a>
                                </li>

                                @foreach ($category->subcategories as $subcategory)
                                    <li class="panel-list-item">
                                        <a href="#">{{ $subcategory->name }}</a>
                                    </li>
                                @endforeach
                                <!-- Imagenes de bajo de cada categoria -->
                                <li class="panel-list-item">
                                    <a href="#">
                                        <img src="{{ $category['banner'] }}" alt="{{ $category['name'] }} banner"
                                            width="250" height="119">
                                    </a>
                                </li>
                            </ul>
                        @endforeach

                    </div>
                </li>

                <!-- MENU POR CADA CATEGORIA Y SUS SUBCATEGORIAS -->
                @foreach ($categories as $category)
                    <li class="menu-category">
                        <a href="{{ route('categories.show',$category) }}" class="menu-title">{{ $category->name }}</a>
                        <ul class="dropdown-list">
                            @foreach ($category->subcategories as $subcategory)
                                <li class="dropdown-item">
                                    <a href="#">{{ $subcategory->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach


            </ul>
            
        </div>
        
    </nav>


    <!-- APARTADO PARA LOS MISMOS MENUS PARA LA VERSION MOBILE -->
    
    <div class="mobile-bottom-navigation">
        <button class="action-btn" data-mobile-menu-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
        </button>
    
        <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count">0</span>
        </button>
    
        <button class="action-btn">
            <ion-icon name="home-outline"></ion-icon>
        </button>
    
        <button class="action-btn" data-mobile-menu-open-btn>
            <ion-icon name="grid-outline"></ion-icon>
        </button>
    </div>
    
    <nav class="mobile-navigation-menu has-scrollbar" data-mobile-menu>
        <div class="menu-top">
            <h2 class="menu-title">Menu</h2>
    
            <button class="menu-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
    
        <!-- SIDEBAR que se abra en mobile -->
        <ul class="mobile-menu-category-list">
            @foreach ($categories as $category)
            <li class="menu-category">
                <button class="accordion-menu" data-accordion-btn>
                    <a href="{{ route('categories.show',$category) }}" class="menu-title">{{ $category->name }}</a>
                    <div>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                </button>
                <ul class="submenu-category-list" data-accordion>
                    @foreach ($category->subcategories as $subcategory)
                    <li class="submenu-category">
                        <a href="#" class="submenu-title">{{ $subcategory->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    
        <!-- Menu de opciones de usuario -->
        <div class="menu-bottom">
            <ul class="menu-category-list">
                <li class="menu-category">
                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">Iniciar sesion</p>
                        <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                    </button>
                </li>
                <li class="menu-category">
                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">Registrate</p>
                        <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                    </button>
                </li>
    
                <!-- Componente dinamico de la bolsa de compras -->
                @livewire('bag-mobile')
            </ul>
    
            <ul class="menu-social-container">
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-linkedin"></ion-icon>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    

</header>
