<div>
    <!-- Nombre de categoria e iconos de filtrado -->
    <div class="bg-white rounded-lg border border-gray-400 p-1 mb-7">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-bold capitalize">
                {{ $category->name }}
            </h1>
        </div>
    </div>

    <!-- PRORUCTOS Y SIDEBAR -->
    <div class="product-container">

        <div class="container">
            
            <div class="sidebar has-scrollbar" data-mobile-menu>
                <!-- SIDEBAR DE SUBCATEGORIAS -->
                <div class="mb-4 pb-4 p-5"">

                    <div class="sidebar-top">
                        <h2 class="mb-3 font-bold text-xl capitalize">
                            {{ $category->name }}
                        </h2>

                        <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>

                    <ul class="sidebar-menu-category-list">
                        @foreach ($category->subcategories as $subcategory)
                        <li class="sidebar-menu-category my-2">
                            <div class="menu-title-flex cursor-pointer font-light">
                                {{-- Método mágico para filtrar las subcategorías (wire:click).
                                    Cuando hagamos clic en un enlace, se almacenará en 
                                    el controlador de Livewire (se compara la subcategoria almacenada con la actual) --}}
                                <a class="{{ $subcategoria == $subcategory->name ? 'text-blue-500 font-semibold' : '' }}" 
                                   wire:click.prevent="$set('subcategoria', '{{$subcategory->name}}')">
                                    {{ $subcategory->name }}
                                </a>
                            </div>
                        </li>
                    @endforeach
                    
                    </ul>

                </div>

                <!-- SIDEBAR DE FILTROS DE TALLAS, COLORES ETC -->
                <div class="mb-4 pb-4 p-5">

                    <div class="sidebar-top">
                        <h2 class="mb-3 font-bold text-xl">
                            Filtrar 'n' Stuff
                        </h2>

                        <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>

                    <ul class="sidebar-menu-category-list">

                        <li class="sidebar-menu-category">
          
                          <button class="sidebar-accordion-menu" data-accordion-btn>
          
                            <div class="menu-title-flex">
                              <img src="./assets/images/icons/dress.svg" alt="clothes" width="20" height="20"
                                class="menu-title-img">
          
                              <p class="menu-title">Clothes</p>
                            </div>
          
                            <div>
                              <ion-icon name="add-outline" class="add-icon"></ion-icon>
                              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                            </div>
          
                          </button>
          
                          <ul class="sidebar-submenu-category-list" data-accordion>
          
                            <li class="sidebar-submenu-category">
                              <a href="#" class="sidebar-submenu-title">
                                <p class="product-name">Shirt</p>
                                <data value="300" class="stock" title="Available Stock">300</data>
                              </a>
                            </li>
          
                            <li class="sidebar-submenu-category">
                              <a href="#" class="sidebar-submenu-title">
                                <p class="product-name">shorts & jeans</p>
                                <data value="60" class="stock" title="Available Stock">60</data>
                              </a>
                            </li>
          
                            <li class="sidebar-submenu-category">
                              <a href="#" class="sidebar-submenu-title">
                                <p class="product-name">jacket</p>
                                <data value="50" class="stock" title="Available Stock">50</data>
                              </a>
                            </li>
          
                            <li class="sidebar-submenu-category">
                              <a href="#" class="sidebar-submenu-title">
                                <p class="product-name">dress & frock</p>
                                <data value="87" class="stock" title="Available Stock">87</data>
                              </a>
                            </li>
          
                          </ul>
          
                        </li>
          
                      </ul>
                    <!-- Boton de eliminar filtos -->
                    {{-- Con el evento wire:click, llamamos a la funcion clean para restablecer--}}
                    <x-button class="mt-4" wire:click='clean'>
                        Eliminar filtro
                    </x-button>

                </div>

            </div>

            <!-- SIDEBAR DE FILTROS, TALLAS, COLORES ETC -->
            


            <!-- GRID DE PRODUCTOS -->
            <div class="product-box">

                <div class="product-grid gap-8">
                    @foreach ($products as $product)
                        <div class="showcase">
                            <div class="showcase-banner">
                                <!-- METERLE IMAGENES MEDIO ALTAS PA Q SE VEA BIEN LOL -->
                                <img src="{{ Storage::url($product->images->first()->url) }}" alt="{{ $product->name }}"
                                    width="300" class="product-img default">
                                <img src="{{ Storage::url($product->images->skip(1)->first()->url) }}"
                                    alt="{{ $product->name }}" width="300" class="product-img hover">
                                <p class="showcase-badge">15%</p>
                                <div class="showcase-actions">
                                    <button class="btn-action">
                                        <ion-icon name="heart-outline"></ion-icon>
                                    </button>
                                    <button class="btn-action">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </button>
                                    <button class="btn-action">
                                        <ion-icon name="repeat-outline"></ion-icon>
                                    </button>
                                    <button class="btn-action">
                                        <ion-icon name="bag-add-outline"></ion-icon>
                                    </button>
                                </div>
                            </div>
                            <div class="showcase-content">
                                <a href="#" class="showcase-category py-3">{{ $product->subcategory->name }}</a>
                                <a href="#">
                                    <h3 class="showcase-title">{{ $product->name }}</h3>
                                </a>
                                <div class="showcase-rating">
                                    {{-- @for ($i = 0; $i < $product->rating; $i++)
                                    <ion-icon name="star"></ion-icon>
                                @endfor
                                @for ($i = $product->rating; $i < 5; $i++)
                                    <ion-icon name="star-outline"></ion-icon>
                                @endfor --}}
                                </div>
                                <div class="price-box">
                                    <p class="price">${{ $product->price }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Paginación FALTA ARREGLARLO PARA QUE SE VEA BIEN-->
                    <div class="w-full">
                        <div class="flex justify-between items-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
