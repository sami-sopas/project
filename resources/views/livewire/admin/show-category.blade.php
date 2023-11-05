<div class="container py-12">
    {{-- Formulario para subcategoria --}}
    <x-form-section submit="save" class="mb-6"> {{-- Ejecuta el metodo save del controlador Createsubcategory --}}
        <x-slot name="title">
            Nueva subcategoria
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
                <div class="flext">
                    <p>¿Esta subcategoria necesita color?</p>

                    <div class="ml-auto">
                        <label for="">
                            <input type="radio" name="color" value="1" wire:model.defer="createForm.color">
                            Si
                        </label>

                        <label for="">
                            <input type="radio" name="color" value="0" wire:model.defer="createForm.color">
                            No
                        </label>
                    </div>

                </div>
                <x-input-error for="createForm.color" />
            </div>


            <div class="col-span-6 sm:col-span-4">
                <div class="flext items-center">
                    <p>¿Esta subcategoria necesita talla?</p>

                    <div class="ml-auto">
                        <label for="">
                            <input type="radio" name="size" value="1" wire:model.defer="createForm.size">
                            Si
                        </label>

                        <label for="">
                            <input type="radio" name="size" value="0" wire:model.defer="createForm.size">
                            No
                        </label>
                    </div>

                </div>
                <x-input-error for="createForm.size" />
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
            Subategorias
        </x-slot>

        <x-slot name="description">
            Aqui tiene las subcategorias pertenecientes a <strong>{{ $category->name }}</strong>
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
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td class="py-2">
                                <span class="capitalize">
                                    {{ $subcategory->name }}
                                </span>
                            </td>
                            <td class="py-2 ">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    {{-- Aqui emitimos un evento para abrir un modal --}}
                                    <a class="pr-2 text-blue-600 cursor-pointer"
                                        wire:click="edit('{{ $subcategory->id }}')">Editar</a>

                                    {{-- Emitir evento al controlador, le pasamos el id de la categoria --}}
                                    <a class="pl-2 text-red-600 cursor-pointer"
                                        wire:click="deleteSubcategory({{ $subcategory->id }})">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>

    </x-action-section>

    {{-- MODAL --}}
    <x-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar Subcategoria
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">
                <div>

                    <x-label>
                        Nombre
                    </x-label>

                    <x-input wire:model="editForm.name" type="text" class="w-full mt-1" />

                    <x-input-error for="editForm.name" />
                </div>

                <div>

                    <x-label>
                        Slug
                    </x-label>

                    <x-input disabled type="text" wire:model="editForm.slug" class="w-full bg-gray-100 mt-1" />

                    <x-input-error for="editForm.slug" />
                </div>

                <div>
                    <div class="flext">
                        <p>¿Esta subcategoria necesita color?</p>
    
                        <div class="ml-auto">
                            <label for="">
                                <input type="radio" name="color" value="1" wire:model.defer="editForm.color">
                                Si
                            </label>
    
                            <label for="">
                                <input type="radio" name="color" value="0" wire:model.defer="editForm.color">
                                No
                            </label>
                        </div>
    
                    </div>
                    <x-input-error for="editForm.color" />
                </div>
    
    
                <div>
                    <div class="flext items-center">
                        <p>¿Esta subcategoria necesita talla?</p>
    
                        <div class="ml-auto">
                            <label for="">
                                <input type="radio" name="size" value="1" wire:model.defer="editForm.size">
                                Si
                            </label>
    
                            <label for="">
                                <input type="radio" name="size" value="0" wire:model.defer="editForm.size">
                                No
                            </label>
                        </div>
    
                    </div>
                    <x-input-error for="editForm.size" />
                </div>

                

            </div>
        </x-slot>

        <x-slot name="footer">
            {{-- Ejecutar la funcion update del controlador --}}
            <x-button wire:click="update">
                Actualizar
            </x-button>
        </x-slot>

    </x-dialog-modal>
</div>
