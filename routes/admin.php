<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ShowProducts;
use App\Livewire\Admin\CreateProduct;
use App\Livewire\Admin\EditProduct;

//Ver productos, controlado por componente de Livewire
Route::get('/',ShowProducts::class)->name('admin.index');

//Editar producto
Route::get('products/{product}/edit',EditProduct::class)->name('admin.products.edit');

//Crear producto
Route::get('products/create',CreateProduct::class)->name('admin.products.create');