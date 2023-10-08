<div>
    <!-- Nombre de categoria e iconos de filtrado -->
    <div class="bg-white rounded-lg border border-gray-400 p-1 mb-5">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-bold capitalize">
                {{ $category->name }}
            </h1>

            <div class="grid grid-cols-2 border border-gray-400 divide-x divide-gray-400 rounded text-gray-800">
                <i class="fa-solid fa-border-all p-3 cursor-pointer"></i>
                <i class="fa-solid fa-list-ul p-3 cursor-pointer"></i>
            </div>
        </div>
    </div>

    <div class="product-container">

        <div class="container">

            <!-- SIDEBAR -->
            <div class="sidebar  has-scrollbar" data-mobile-menu>

                <div class="sidebar-category">

                    <div class="sidebar-top">
                        <h2 class="sidebar-title mb-3 font-bold">Subcategorias</h2>

                        <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>

                    <ul class="sidebar-menu-category-list">

                        @foreach ($category->subcategories as $subcategory)
                            <li class="sidebar-menu-category my-2">
                                <div class="menu-title-flex cursor-pointer">
                                    <a class="menu-title">
                                        {{ $subcategory->name }}
                                    </a>
                                </div>
                            </li>
                        @endforeach


                    </ul>

                </div>

            </div>


            <!-- GRID DE PRODUCTOS -->
            <div class="product-box">

                <div class="product-grid">
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
