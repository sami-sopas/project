<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ShowProducts;
use App\Livewire\Admin\CreateProduct;
use App\Livewire\Admin\EditProduct;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

//Ver productos, controlado por componente de Livewire
Route::get('/',ShowProducts::class)->name('admin.index');

//Editar producto
Route::get('products/{product}/edit',EditProduct::class)->name('admin.products.edit');

//Crear producto
Route::get('products/create',CreateProduct::class)->name('admin.products.create');

//Almacenar imgs
Route::post('products/{product}/files',[ProductController::class,'files'])->name('admin.products.files');

Route::get('categories',[CategoryController::class,'index'])->name('admin.categories.index');