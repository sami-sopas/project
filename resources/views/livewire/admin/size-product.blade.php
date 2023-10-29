<div>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-12">

        <div>
            <x-label>
                Talla
            </x-label>

            <x-input 
                wire:model.live="name"
                placeholder="Ingrese una talla"
                type="text"
                class="w-full"
                />

            <x-input-error for="name"/>
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-button wire:click="save">
                Agregar
            </x-button>
        </div>
    </div>

    {{-- Mostrar tallas agregadas --}}
    <ul class="mt-12 space-y-4">
        @foreach ($sizes as $size)
            <li 
                wire:key="size-{{$size->id}}"
                class="bg-white shadow-lg rounded-lg p-6">

                <div class="flex items-center">
                    <span class="text-xl font-medium">
                        {{$size->name}}
                    </span>

                    <div class="ml-auto">

                        {{-- Mostrar modal de ditar--}}
                        <x-button wire:click="edit({{$size}})">
                            <i class="fas fa-edit"></i>
                        </x-button>

                        {{--Este llama al swwetAlert y elimina la talla--}}
                        <x-danger-button wire:click="$dispatch('deleteSize',{{$size->id}})">
                            <i class="fas fa-trash"></i>
                        </x-danger-button>

                    </div>
                </div>

                {{-- Componente para formulario de color-talla, recibe la talla actual --}}
                @livewire('admin.color-size',['size' => $size],key('color-size' . $size->id))
            </li>
        @endforeach
    </ul>

    {{-- Modal que se llama cuando open = true--}}
    <x-dialog-modal wire:model.live="open">

        <x-slot name="title">
            Editar talla
        </x-slot>

        <x-slot name="content">
            <x-label>
                Talla
            </x-label>

            <x-input 
                wire:model.live="name_edit"
                type="text" 
                class="w-full">
            </x-input>

            <x-input-error for="name_edit"/>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="$set('open',false)">
                Cancelar
            </x-secondary-button>

            <x-button wire:click="update">
                Actualizar
            </x-button>
        </x-slot>


    </x-dialog-modal>

</div>
