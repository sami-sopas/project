<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ShowProducts;
use App\Livewire\Admin\CreateProduct;
use App\Livewire\Admin\EditProduct;
use App\Livewire\Admin\ShowCategory;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Models\Order;

//Ver productos, controlado por componente de Livewire
Route::get('/',ShowProducts::class)->name('admin.index');

//Editar producto
Route::get('products/{product}/edit',EditProduct::class)->name('admin.products.edit');

//Crear producto
Route::get('products/create',CreateProduct::class)->name('admin.products.create');

//Almacenar imgs
Route::post('products/{product}/files',[ProductController::class,'files'])->name('admin.products.files');

//Categorias, en el index se llama a un componente de livewire
Route::get('categories',[CategoryController::class,'index'])->name('admin.categories.index');

//Ver categorias con componente de livewire (para de ahi manejar las subcategorias)
Route::get('categories/{category}',ShowCategory::class)->name('admin.categories.show');

//Administrar ordenes
Route::get('orders',[OrderController::class,'index'])->name('admin.orders.index');
Route::get('orders/{order}',[OrderController::class,'show'])->name('admin.orders.show');