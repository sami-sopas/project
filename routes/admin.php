<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ShowProducts;

//Ver productos, controlado por componente de Livewire
Route::get('/',ShowProducts::class)->name('admin.index');