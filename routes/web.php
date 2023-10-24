<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Livewire\ShoppingBag;
use App\Livewire\CreateOrder;
use App\Livewire\PaymentOrder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Muestra vista cuando dan enter o click al boton de buscar
Route::get('search',SearchController::class)->name('search');

//Para estos metodos solo estoy usando el show en realidad
//Resource controller de categorias 
Route::resource('categories', CategoryController::class);

//Resource controller de productos
Route::resource('products',ProductController::class);

//Ruta para la bolsa de compras, controlada por un componente de livewire
Route::get('shopping-bag',ShoppingBag::class)->name('shopping-bag');

//Rutas protegidas
Route::middleware(['auth'])->group(function(){

    //Creacion de ordenes (controlado por un componente de livewire)
    Route::get('orders/create',CreateOrder::class)->name('orders.create');

    //Despues de pagar, se redirecciona aqui, donde podra ver sus ordenes
    Route::get('orders/{order}',[OrderController::class,'show'])->name('orders.show');

    //Despues de generar la orden aqui se paga, recibe el id de la orden (Tambien controlado por un componente livewire)
    Route::get('orders/{order}/payment',PaymentOrder::class)->name('orders.payment');

});

