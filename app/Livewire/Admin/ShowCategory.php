<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class ShowCategory extends Component
{
    public $category, $subcategories, $subcategory;

    //Para los inputs del crear
    public $createForm = [
        'name' => null,
        'slug' => null,
        //Saber si esta subcategoria tendra color o talla
        'color' => false,
        'size' => false,
    ];

    //Para los inputs del modal
    public $editForm = [
        'open' => false, //control modal
        'name' => null,
        'slug' => null,
        //Saber si esta subcategoria tendra color o talla
        'color' => false,
        'size' => false,
    ];

    //Reglas de validacion al crear
    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:subcategories,slug',
        'createForm.color' => 'required',
        'createForm.size' => 'required',
    ];

    //Mensajes de error
    protected $validationAttributes =[
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
    ];


    public function mount(Category $category)
    {
        $this->category = $category;
        $this->getSubcategories();
    }

    public function getSubcategories(){
        $this->subcategories = Subcategory::where('category_id',$this->category->id)->get();
    }

    public function updatedCreateFormName($value)
    {
        //Actualizamos el slug al momento de crear
        $this->createForm['slug'] = Str::slug($value);
    }

    public function updatedEditFormName($value)
    {
        //Actualizamos el slug al momento de crear
        $this->editForm['slug'] = Str::slug($value);
    }

    //Guardar subcategoria
    public function save()
    {
        $this->validate();

        //Crearemos la subcategoria a partir de su relacion con la categoria
        $this->category->subcategories()->create($this->createForm);

        $this->reset('createForm');

        $this->getSubcategories();
    }

    //Modal para editar
    public function edit(Subcategory $subcategory)
    {
        //Resetear mensajes de validaciones
        $this->resetValidation();

        //Guardar la subcategoria seleccionada
        $this->subcategory = $subcategory;

        //Abrir modal
        $this->editForm['open'] = true;

        //LLenarlo con la informacion adecuada
        $this->editForm['name'] = $subcategory->name;
        $this->editForm['slug'] = $subcategory->slug;
        $this->editForm['color'] = $subcategory->color;
        $this->editForm['size'] = $subcategory->size;
    }

    public function update()
    {
        $this->validate([
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:subcategories,slug,' . $this->subcategory->id,
            'editForm.color' => 'required',
            'editForm.size' => 'required',
        ]);

        $this->subcategory->update($this->editForm);

        $this->getSubcategories();
        $this->reset('editForm');
    }

    public function deleteSubcategory(Subcategory $subcategory)
    {
        $subcategory->delete();
        $this->getSubcategories();
    }

    public function render()
    {
        return view('livewire.admin.show-category')->layout('layouts.admin');
    }
}
