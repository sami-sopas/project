<div> <!-- Dropdown de la bolsita de compras que sera dinamica -->
    <x-dropdown width="96"> <!-- Cambiar ancho del div al abrir la bolsa -->
        <x-slot name="trigger">
            <span class="cursor-pointer">
                <x-shopping-bag color="gray"/>
            </span>
        </x-slot>

        <x-slot name="content">
            <div>
                <p class="text-center text-gray-700 py-6 px4">
                    Ups, aun no hay items
                </p>
            </div>
        </x-slot>
    </x-dropdown>
</div>
