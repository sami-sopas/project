<?php

use App\Models\Order;
use App\Models\Category;
use App\Livewire\CreateOrder;
use App\Livewire\ShoppingBag;
use App\Livewire\PaymentOrder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;

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

//Vista inicio
Route::get('/', WelcomeController::class);

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

    //Ruta para mostrar las ordenes del usuario
    Route::get('orders',[OrderController::class,'index'])->name('orders.index');

    //Creacion de ordenes (controlado por un componente de livewire)
    Route::get('orders/create',CreateOrder::class)->name('orders.create');

    //Despues de pagar, se redirecciona aqui, donde podra ver sus ordenes
    Route::get('orders/{order}',[OrderController::class,'show'])->name('orders.show');

    //Despues de generar la orden aqui se paga, recibe el id de la orden (Tambien controlado por un componente livewire)
    Route::get('orders/{order}/payment',PaymentOrder::class)->name('orders.payment');

});


//ELIMINA LAS ORDENES, PASADAS 1 HORA, FUNCIONA DE MANERA MANUAL, PERO AUN NO EN KERNEL.PHP
Route::get('prueba',function(){

    //La hora actual menos 60 min
    $time = now()->subMinutes(1);

    $orders = Order::where('status',1)->where('created_at','<=',$time)->get();

    foreach($orders as $order)
    {
        $items = json_decode($order->content);

        foreach($items as $item){
            //Recuperar cantidad de items en caso de no pagar la orden
            increase($item);
        }
    }

    //Cambiar status de la orden a cancelado
    $order->status = 5;

    $order->save();

    return "exito";
});
