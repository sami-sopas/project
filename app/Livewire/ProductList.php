<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public $selectedOption = 'new';
    public $products = [];

    public function mount()
    {
        // Lógica para cargar productos por defecto al cargar la página
        $this->updateProducts();
    }

    public function updateProducts()
    {
        if ($this->selectedOption === 'new') {
            $this->products = Product::orderBy('id', 'desc')->get();
        } elseif ($this->selectedOption === 'cheap') {
            $this->products = Product::orderBy('price')->get();
        } elseif ($this->selectedOption === 'expensive') {
            $this->products = Product::orderBy('price', 'desc')->get();
        }

        // Emitir un evento personalizado para que la vista se actualice
        $this->dispatch('productsUpdated');
    }

    public function render()
    {
        return view('livewire.product-list');
    }
}