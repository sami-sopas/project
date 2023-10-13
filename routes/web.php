<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Livewire\ShoppingBag;

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
Route::get('shopping-bag',ShoppingBag::class);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('prueba',function(){
    Cart::destroy();
});
