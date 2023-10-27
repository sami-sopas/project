<div class="mt-4">
    {{-- Formulario --}}
    <div class="bg-gray-100 shadow-lg rounded-lg p-6">

        {{-- Color --}}
        <div class="mb-6">
            <x-label>
                Color
            </x-label>


            <div class="grid gird-cols-6 gap-4">
                @foreach ($colors as $color)
                    <label>
                        <input type="radio" wire:model.defer="color_id" name="color_id"
                            value="
                        {{ $color->id }}">
                        <span class="ml-2 text-gray-700 capitalize">
                            {{ $color->name }}
                        </span>
                    </label>
                @endforeach
            </div>

            <x-input-error for="color_id" />

        </div>

        {{-- Cantidad --}}
        <div>
            <x-label>
                Cantidad
            </x-label>

            <x-input type="number" wire:model.defer="quantity" placeholder="Ingrese una cantidad" class="w-full">
            </x-input>

            <x-input-error for="quantity" />
        </div>

        <div class="flex mt-4 justify-end items-center">
            {{-- Se llama desde el EditProduct con un dispatch --}}
            <x-action-message class="mr-3" on="saved">
                Agregado
            </x-action-message>

            <x-button wire:click="save">
                Agregar
            </x-button>
        </div>

    </div>

    {{-- Tabla con colores y cantidad asociada a dicha talla --}}
    @if ($size_colors->count())
    <div class="mt-8">
        <table>
            <thead>
                <tr>
                    <th class="px-4 py-2 w-1/3">
                        Color
                    </th>
                    <th class="px-4 py-2 w-1/3">
                        Cantidad
                    </th>
                    <th class="px-4 py-2 w-1/3">

                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($size_colors as $size_color)
                    <tr wire:key="product_color-{{ $size_color->pivot->id }}"> {{-- Nomas pa q no se ondie el livewire --}}
                        <td class="capitalize px-4 py-2">
                            {{-- Obtener nombre del color mientras la tabla pivote --}}
                            {{ $colors->find($size_color->pivot->color_id)->name }} 

                        </td>
                        <td class="px-4 py-2">
                            {{ $size_color->pivot->quantity }} Unidades
                        </td>
                        <td class="px-4 py-2 flex">
                            {{-- Este boton se ecnuentra vinculado al modal --}}
                            <x-secondary-button class="ml-auto mr-2" 
                            {{-- Enviamos la informacion del ID
                                    del registro de la tabla pivote
                                    a la funcion edit para procesarla en el modal --}}
                                wire:click="edit({{ $size_color->pivot->id }})">
                                Actualizar
                            </x-secondary-button>

                            <x-danger-button
                                {{--Evento para eliminar y swetAlert--}}
                                wire:click="$dispatch('deletePivot',{{$size_color->pivot->id}})"
                            >
                                Eliminar
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

    {{-- Modal para editar colores --}}
    <x-dialog-modal wire:model.live="open">

        <x-slot name="title">
            Editar colores
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label>
                    Color
                </x-label>

                <select 
                class="w-full"
                 {{-- Sincronizar con las variables pivot --}} 
                 wire:model.live="pivot_color_id">
                    <option value="">Seleccione un color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">
                            {{ $color->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-label>
                    Cantidad
                </x-label>

                <x-input class="w-full" wire:model.live="pivot_quantity" placeholder="Ingrese una cantidad" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button {{-- Aqui hacemos que la propiedad open se cambie a falso --}} wire:click="$set('open',false)" class="mr-2">
                Cancelar
            </x-secondary-button>

            <x-button wire:click="update">
                Actualizar
            </x-button>
        </x-slot>

    </x-dialog-modal>
</div>
