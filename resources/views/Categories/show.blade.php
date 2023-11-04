<x-app-layout>
    <div class="container py-8">
        <!-- Imagen de la categoria correspondiente -->
        <figure class="mb-4">
            <img src="{{ Storage::url($category->image) }}" alt="category-image"
                class="w-full h-96 object-cover object-center">
        </figure>


        @livewire('category-filter', ['category' => $category])
    </div>


</x-app-layout>
