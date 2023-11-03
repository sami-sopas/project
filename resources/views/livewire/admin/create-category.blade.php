<div>

    <x-form-section submit="save"> {{-- Ejecuta el metodo save del controlador CreateCategory--}}
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

                <x-input-error for="createForm.name"/>
            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-label>
                    Slug
                </x-label>
                
                <x-input disabled type="text" wire:model="createForm.slug" class="w-full bg-gray-100 mt-1" />

                <x-input-error for="createForm.slug"/>
            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-label>
                    Imagen
                </x-label>
                
                <input type="file" class="mt-1" name="" wire:model="createForm.image" accept="image/png, image/jpeg" id="{{$rand}}"/>

                <x-input-error for="createForm.image"/>
            </div>
            

        </x-slot>

        <x-slot name="actions">
            <x-button>
                Agregar
            </x-button>
        </x-slot>

    </x-form-section>
</div>
