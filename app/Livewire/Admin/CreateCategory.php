<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $rand; //Pa limpiar el input de la imagen al enviar,

    public $categories; //Cargar aqui todas las categorias

    public $category; //Para el edit, tener la categoria actual

    //Input values, para imprimirlos en blade es con {{$createForm['name']}}
    public $createForm = [
        'name' => null,
        'slug' => null,
        'image' => null,
    ];

    //Inputs para cuando se este editando
    public $editForm = [
        'open' => false, //Para controlar el modal
        'name' => null,
        'slug' => null,
        'image' => null,
    ];

    //Almacenar la posible imagen a reemplazar
    public $editImage;


    //Reglas de validacion al crear
    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:categories,slug',
        'createForm.image' => 'required|image|max:1024',
    ];

    //Mensajes de error
    protected $validationAttributes =[
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.image' => 'imagen',
        'editForm.name' => 'nombre',
        'editForm.slug' => 'slug',
        'editImage' => 'imagen',
    ];

    public function mount()
    {
        //Generar numero aleatorio, para asignarselo al id del input
        $this->rand = rand();

        //Cargar categorias
        $this->getCategories();
    }

    //Cargar todas las categorias
    public function getCategories(){
        $this->categories = Category::all();
    }

    //Esta funcion escucha cada que cambia el valor de name, para asi cambiar el slug
    public function updatedCreateFormName($value)
    {
        //Actualizamos el slug al momento de crear
        $this->createForm['slug'] = Str::slug($value);
    }

    //Actualizar slug pero ahora para editar
    public function updatedEditFormName($value)
    {
        $this->editForm['slug'] = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        //Primero, almacenar imagen en servidor, y rescatar su URL en image
        $image = $this->createForm['image']->store('categories');

        Category::create([
            'name' => $this->createForm['name'],
            'slug' => $this->createForm['slug'],
            'image' => $image,
        ]);

        //Resetear el arreglo createForm
        $this->reset('createForm');

        //MEXICANADA:
        //Generar otro id para la imagen y asi que no aparezca con la info anterior en el campo de file
        $this->rand = rand();

        //Actualizar categorias
        $this->getCategories();

        //Emitir evento para el mensaje de Categoria agregada
        $this->dispatch('saved');


    }

    //Mostrar modal
    public function edit(Category $category)
    {
        //Resetear mensajes de error que hayan salido en otras partes
        $this->resetValidation();

        //Resetear imagen si es que se subio una nueva
        $this->reset('editImage');

        $this->category = $category;

        //Abrir modal
        $this->editForm['open'] = true;

        //Obtener los campos
        $this->editForm['name'] = $category->name;
        $this->editForm['slug'] = $category->name;
        $this->editForm['image'] = $category->image;
    
    }

    //Actualizar en base a los campos de editForm
    public function update()
    {
        $rules = [
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:categories,slug,' . $this->category->id,
        ];

        //Se almaceno una nueva imagen?
        if($this->editImage){
            //Agregamos una validacion neuva para esa imagen
            $rules['editImage'] =  'image|max:1024';
        }

        $this->validate($rules);

        //Se subio una nueva imagen? Eliminamos a la anterior
        if($this->editImage) {
            //Le pasamos la url de la img
            Storage::delete([$this->editForm['image']]); 

            //Reemplazarmos por la nueva imagen (la cual es la que esta en editImage), se guarda en disco
            $this->editForm['image'] = $this->editImage->store('categories');
        }   

        //Actualizamos con los nuevos datos de los inputs
        $this->category->update($this->editForm);

        //Reseteamos los inputs
        $this->reset(['editForm','editImage']);

        //Actualizamos las categorias
        $this->getCategories();

    }

    //Evento que se emite desde el sweet aler, recibe el ID desde ahi
    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId);

        if ($category) {
            $category->delete();
            $this->getCategories();
        }
    }

    public function render()
    {
        return view('livewire.admin.create-category');
    }
}
