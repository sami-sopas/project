<div>
    {{-- Formulario de categorias --}}
    <x-form-section submit="save" class="mb-6"> {{-- Ejecuta el metodo save del controlador CreateCategory --}}
        <x-slot name="title">
            Nueva categoria
        </x-slot>

        <x-slot name="description">
            LLene los campos inge
        </x-slot>

        <x-slot name="form">

            <div class="col-span-6 sm:col-span-4">

                <x-label>
                    Nombre
                </x-label>

                <x-input wire:model="createForm.name" type="text" class="w-full mt-1" />

                <x-input-error for="createForm.name" />
            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-label>
                    Slug
                </x-label>

                <x-input disabled type="text" wire:model="createForm.slug" class="w-full bg-gray-100 mt-1" />

                <x-input-error for="createForm.slug" />
            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-label>
                    Imagen
                </x-label>

                <input type="file" class="mt-1" name="" wire:model="createForm.image"
                    accept="image/png, image/jpeg" id="{{ $rand }}" />

                <x-input-error for="createForm.image" />
            </div>


        </x-slot>

        <x-slot name="actions">

            <x-action-message class="mr-3" on="saved"> {{-- Escucha al evento saved --}}
                Categoria agregada
            </x-action-message>

            <x-button>
                Agregar
            </x-button>
        </x-slot>

    </x-form-section>

    {{-- Listado y botones para editar/eliminar --}}
    <x-action-section>

        <x-slot name="title">
            Categorias
        </x-slot>

        <x-slot name="description">
            Aqui tiene las categorias mi inge
        </x-slot>

        <x-slot name="content">
            <table>
                <thead class="border-b border-gray-400">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Accion</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2 ">
                                <span class="capitalize">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="py-2 ">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 text-blue-600 cursor-pointer">Editar</a>

                                    {{-- Emitir evento a script de sweetAlert, le enviamos el Id de la categoria --}}
                                    <a class="pl-2 text-red-600 cursor-pointer" 
                                    wire:click="deleteCategory({{ $category->id }})">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>

    </x-action-section>

</div>
