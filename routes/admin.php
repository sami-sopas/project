<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ShowProducts;

//Ver productos, controlado por componente de Livewire
Route::get('/',ShowProducts::class)->name('admin.index');

//Editar producto
Route::get('products/{product}/edit',function(){
    
})->name('admin.products.edit');

//Crear producto
Route::get('products/create',function(){

})->name('admin.products.create');