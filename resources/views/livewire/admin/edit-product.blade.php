<div>
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>

                {{-- Emitimos evento para que jale el sweet alert de eliminar--}}
                <x-danger-button wire:click="$dispatch('deleteProduct')">
                    Eliminar producto
                </x-danger-button>
            </div>
        </div>
    </header>

    <div class="max-w-3xl mx-auto px-12 sm:px-6 lg:px-8 py-12 text-gray-700">
    
        <h1 class="text-3xl text-center font-semibold mb-8">
            Creacion de producto
        </h1>
    
        {{--Dropzone MANEJADA POR EL CONTROLADOR ProductController--}}
        <div class="mb-4" wire:ignore>
            <form action="{{route('admin.products.files',$product)}}" method="POST" class="dropzone" id="my-awesome-dropzone">@csrf</form>
        </div>
    
        {{-- EL producto tiene imagenes? Aqui se muestran--}}
        @if ($product->images->count())
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-2">
                    Imagenes de producto
                </h1>
    
                <ul class="flex flex-wrap">
                   @foreach ($product->images as $image)
                        <li class="relative" wire:key="image-{{$image->id}}">
                            <img
                                class="w-32 h-20 object-cover" 
                                src="{{ Storage::url($image->url) }}" alt=""
                            >
    
                            <x-danger-button 
                                wire:click="deleteImage({{$image->id}})"
                                class="absolute right-2 top-2 font-bold text-3xl"
                            >
                                X
                            </x-danger-button>
                        </li>
                   @endforeach 
                </ul>
            </section>
        @endif
    
        <div class="bg-white shadow-xl rounded-lg p-6">
    
            {{ $product }}
    
            <div class="grid grid-cols-2 gap-6 mb-4 ">
                {{-- Categorias --}}
                <div>
                    <x-label value="Categorias" /> {{-- Cada que haya un cambio en este select, se actualiza category_id --}}
                    <select name="" class="w-full rounded-md" wire:model.live="category_id">
                        <option value="" selected disabled>Seleccione una categoria</option>
    
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
    
                    <x-input-error for="category_id" />
    
                </div>
                {{-- Subcategorias --}}
                <div>
                    <x-label value="Subcategorias" />
                    <select name="" class="w-full rounded-md" wire:model.live="subcategory_id">
                        <option value="" selected disabled>Seleccione una subcategoria</option>
    
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
    
                    <x-input-error for="subcategory_id" />
    
                </div>
            </div>
    
            {{-- Nombre --}}
            <div class="mb-4">
                <x-label value="Nombre" />
                <x-input type="text" class="w-full" wire:model="name" placeholder="Ingrese el nombre del producto" />
    
                <x-input-error for="name" />
            </div>
    
            {{-- Slug (no se muestra) --}}
            <div class="mb-4">
                <x-label value="Slug" />
                <x-input type="text" class="w-full" disabled wire:model="slug" placeholder="Slug del producto" />
    
                <x-input-error for="product.slug" />
            </div>
    
            {{-- Descripción --}}
            <div class="mb-4" wire:ignore.self>
                <div wire:ignore>
                    <x-label value="Descripción" />
                    <textarea wire:model="description" x-data x-init="ClassicEditor.create($refs.myEditor)
                        .then(function(editor) {
                            editor.model.document.on('change:data', () => {
                                @this.set('description', editor.getData())
                            })
                        })
                        .catch(error => {
                            console.error(error);
                        });" x-ref="myEditor"
                        class="w-full border border-gray-400 rounded-md" cols="30" rows="4">
                </textarea>
                </div>
                <x-input-error for="description" />
            </div>
    
            {{-- Precio --}}
            <div class="mb-4">
                <x-label value="Precio" />
                <x-input wire:model="price" type="number" step=".01" class="w-full" />
                <x-input-error for="price" />
            </div>
    
    
            {{-- Imprime todo el objeto de subcategoria seleccioanda: --}}
            {{$this->subcategory}}
    
            @if($this->subcategory)
                @if (!$this->subcategory->color && !$this->subcategory->size)
                    <div>
                        <x-label value="Cantidad" />
                        <x-input wire:model="quantity" type="number" class="w-full" />
                        <x-input-error for="quantity" />
                    </div>
                @endif
            @endif
    
            <div class="flex mt-4 justify-end items-center">
                {{-- Se llama desde el EditProduct con un dispatch--}}
                <x-action-message class="mr-3" on="saved">
                    Actualizado
                </x-action-message>
    
                <x-button wire:click="save">
                    Actualizar producto
                </x-button>
            </div>
    
        </div>
    
        {{-- Saber si tenemos una subcategoria seleccionada--}}
        @if($this->subcategory)
    
            {{-- La subcategoria tiene talla--}}
            @if($this->subcategory->size)
                
                {{-- LLave unica para cada producto--}}
                @livewire('admin.size-product',['product' => $product],key('size-product-' . $product->id))
    
            {{-- Tiene color--}}
            @elseif($this->subcategory->color)
    
                @livewire('admin.color-product',['product' => $product],key('color-product-' . $product->id))
    
            @endif
        @endif
    
        
    </div>

    {{-- Configuraciones de dropzone--}}
    @push('script')
    <script>
        Dropzone.options.myAwesomeDropzone = {
            acceptedFiles: 'image/*',
            dictDefaultMessage: "Arraste una imagen",
            paramName: "file",
            maxFilesize: 2, //MB
            init: function() {
                var myDropzone = this;
    
                // Elimina la imagen del dropzone una vez subida
                myDropzone.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });
    
                // Se ejecuta este método cuando todas las imágenes en cola se subieron
                myDropzone.on("queuecomplete", function() {
                    console.log('Todas las imágenes se han subido');
                    // Llama al método del componente Livewire
                    @this.call('refreshProduct');
                });
            }
        };

        //Alerta para eliminar producto, se ejecuta al emitir el evento deleteProduct
        Livewire.on('deleteProduct', () => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    //Emitir evento al componente, para que elimine el registro
                    @this.call('delete')
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })

        //El codigo que estaba en size-product 
        //Cuando se llama a la evento deletePivot, se ejecuta el sweetAlert
        Livewire.on('deleteSize', sizeId => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //Emitir evento al componente, para que elimine el registro
                    @this.call('delete', sizeId);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })

        //El que se llamaba desde edit-product
        //Cuando se llama a la evento deletePivot, se ejecuta el sweetAlert
        Livewire.on('deletePivot', pivot => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //Emitir evento al componente, para que elimine el registro
                        
                        @this.call('delete', pivot);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })

                    
        //Dupicado
        Livewire.on('deleteColorSize', pivot => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        /* Aqui tuve que hacer un desmadre, queria emitir un evento
                           al ColorSize Livewire Component, pero no me dejo, asi que
                           primero lo envio al componente actual (EditProduct), al 
                           metodo deleteColorSize y en ese metodo emito el de ColorSize
                           para mandarlo y ejecutar el metodo que deberia */
                        @this.call('deleteColorSize',pivot);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
    </script>
    
    @endpush

</div>
