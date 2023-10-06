<div>
    <div class="flex items-center justify-between border-b border-gray-300 pb-2 mb-4">
        <label for="ordenarPor" class="text-gray-700 pr-4">Ordenar por:</label>
        <div class=" flex-grow">
            <select wire:model="selectedOption" wire:change="updateProducts" id="ordenarPor"
                class="py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-500 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                <option value="new">Lo más nuevo</option>
                <option value="cheap">Lo más barato</option>
                <option value="expensive">Lo más caro</option>
            </select>
        </div>
    </div>

    <!-- Mostrar productos de manera dinámica -->
    <div>
        @if (count($products) > 0)
            @foreach ($products as $product)
                <div>{{ $product->name }}</div>
            @endforeach
        @else
            <p>No se encontraron productos.</p>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('productsUpdated', function () {
            // Aquí puedes actualizar la vista en el lado del cliente según sea necesario
        });
    });
</script>
@endpush

