<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $rand; //Pa limpiar el input de la imagen al enviar,

    public $categories; //Cargar aqui todas las categorias

    //Input values, para imprimirlos en blade es con {{$createForm['name']}}
    public $createForm = [
        'name' => null,
        'slug' => null,
        'image' => null,
    ];

    //Reglas de validacion
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
        //Actualizamos el slug
        $this->createForm['slug'] = Str::slug($value);
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


    }

    public function render()
    {
        return view('livewire.admin.create-category');
    }
}
