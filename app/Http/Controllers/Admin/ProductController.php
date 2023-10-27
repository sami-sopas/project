<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

//Facade para subir imagen al server
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //Recibimos el producto y los parametros de la imagen
    public function files(Product $product, Request $request)
    {
        //Validar
        $request->validate([
            'files.*' => 'required|max:2048',
            'files' => 'max:4' //Valida que los numeros de archivos no sean mas que 4
        ]);

        //La imagen se guarda en la carpeta products y se envia atraves de file
        $url = Storage::put('products',$request->file('file'));

        //Relacionar imagenes con el producto, se agrega en la tabla Image
        //Aqui no es necesario usar imageable id o type
        $product->images()->create([
            'url' => $url
        ]);
    }   
}
