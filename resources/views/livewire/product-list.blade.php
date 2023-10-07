<div>
    <div class="flex items-center justify-between border-b border-gray-300 pb-2 mb-4">
        <label for="ordenarPor" class="text-gray-700 pr-4">Ordenar por:</label>
        <div class="flex-grow">
            <select wire:model="selectedOption" wire:change="updateProducts" id="ordenarPor"
                class="py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-500 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                <option value="new">Lo más nuevo</option>
                <option value="cheap">Lo más barato</option>
                <option value="expensive">Lo más caro</option>
            </select>
        </div>
    </div>

    <!-- Mostrar productos de manera dinámica -->
    <div class="product-grid">
        @foreach ($products as $product)
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


    </div>
</div>


@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('productsUpdated', function () {
            // Aquí se puede actualizar la vista en el lado del cliente según sea necesario
        });
    });
</script>
@endpush

