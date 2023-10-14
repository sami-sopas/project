<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingBag extends Component
{
    //Al dar click en el enlace de shopping-bag, se activa este metodo
    public function destroy()
    {
        Cart::destroy();

        //Renderizamos de nuevo el DropdownBag, para que se apliquen ahi los cambios tambien
        $this->dispatch('render')->to(DropdownBag::class);
    }

    //Eliminar item individual
    public function delete($rowId)
    {
        Cart::remove($rowId);

        //Renderizamos de nuevo el DropdownBag, para que se apliquen ahi los cambios tambien
        $this->dispatch('render')->to(DropdownBag::class);
    }


    //Esta propiedad escucha al evento que se llama desde UpdateBagItem
    #[On('render')]
    public function render()
    {
        return view('livewire.shopping-bag');
    }
}
