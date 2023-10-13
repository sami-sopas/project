<x-app-layout>
    <!-- Esto es como el welcome view -->
    <div class="product-container mt-5">

        <div class="container">

            <div class="product-box">
                <!-- PRODUCT GRID -->

                <div class="product-main">

                    <!-- Seccion para mostrar los productos mas nuevo, mas vendido etc -->
                    <div class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
                        <div class="max-w-screen-xl mx-auto px-4 py-2.5">
                            <div class="product-grid">
                                @forelse($products as $product)
                                    <div class="showcase">
                                        <div class="showcase-banner">
                                            <!-- METERLE IMAGENES MEDIO ALTAS PA Q SE VEA BIEN LOL -->
                                            <img src="{{ Storage::url($product->images->first()->url) }}" alt="{{ $product->name }}" width="300" class="product-img default">
                                            <img src="{{ Storage::url($product->images->skip(1)->first()->url) }}" alt="{{ $product->name }}" width="300" class="product-img hover">
                                            <p class="showcase-badge">15%</p>
                                            <div class="showcase-actions">
                                                <button class="btn-action">
                                                    <ion-icon name="heart-outline"></ion-icon>
                                                </button>
                                                <button class "btn-action">
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
                                            <a href="{{ route('products.show',$product) }}">
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
                                @empty
                                <div class="mx-auto w-full">
                                    <div class="text-lg">Ups !</div>

                                    <p class="mt-8 text-center">
                                        No hemos encontrado resultados para
                                        <span class="font-bold block">{{$name}}</span>
                                    </p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>