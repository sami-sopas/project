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
                            <td class="py-2">
                                <a href="{{route('admin.categories.show',$category)}}" class="capitalize underline hover:text-blue-500">
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td class="py-2 ">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    {{-- Aqui emitimos un evento para abrir un modal --}}
                                    <a class="pr-2 text-blue-600 cursor-pointer" wire:click="edit('{{$category->slug}}')">Editar</a>

                                    {{-- Emitir evento al controlador, le pasamos el id de la categoria --}}
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

    {{-- MODAL --}}
    <x-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar categoria
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

                    <x-label>
                        Imagen
                    </x-label>

                    <input type="file" class="mt-1" name="" 
                    wire:model="editImage"
                        accept="image/png, image/jpeg" id="{{ $rand }}" />

                    <x-input-error for="editImage" />
                </div>

                {{--Mostrar imagen actual--}}
                <div>
                    @if ($editImage)
                        {{-- Mostrar imagen que subio--}}     {{-- Accediendo a la carpeta temporal donde se guarda la imagen--}}
                        <img class="w-full h-64 object-cover object-center" src="{{$editImage->temporaryUrl()}}" alt="">    
                    @else
                        {{-- Mostrar imagen antes de actualizar (la original) --}}
                        <img class="w-full h-64 object-cover object-center" src="{{ Storage::url($editForm['image']) }}" alt="">    
                    @endif
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
