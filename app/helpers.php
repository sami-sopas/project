<?php

use App\Models\Size;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

//Calcular el stock del producto
function quantity($productId, $colorId = null, $sizeId = null)
{
    $product = Product::find($productId);

    if($sizeId){
        $size = Size::find($sizeId);
        $quantity = $size->colors->find($colorId)->pivot->quantity;
    }elseif($colorId){
        $quantity = $product->colors->find($colorId)->pivot->quantity;
    }else{
        $quantity = $product->quantity;
    }

    return $quantity;

}

//Esta funcion determina la cantidad de productos agregada al carrito de compras
/*
function qty_added($productId, $colorId = null, $sizeId = null)
{

    $product = Product::find($productId);

    //Recuperar todos los productos en el carrito de compras
    $cart = Cart::content();

    if($sizeId){

        $item = $cart->where('id', $productId)->where('options.sizeId', Size::find($sizeId)->name)->where('options.colorId', Size::find($sizeId)->colors->find($colorId)->name)->first();

    }elseif($colorId){

        $item = $cart->where('id', $productId)->where('options.colorId', $product->colors->find($colorId)->name)->first();

    }else{

        $item = $cart->where('id', $productId)->first();

    }

    if ($item) {

        return $item->qty;

    } else {

        return 0;

    }

}*/

//Productos agregador al carrito
function qty_added($productId, $colorId = null, $sizeId = null){

    $cart = Cart::content();

    $item = $cart->where('id', $productId)
                ->where('options.color_id', $colorId)
                ->where('options.size_id', $sizeId)
                ->first();

    if($item){
        return $item->qty;
    }else{
        return 0;
    }

}

//Calcula la cantidad que aun puedo agregar a mi carrito
function qty_available($productId, $colorId = null, $sizeId = null)
{
    return quantity($productId, $colorId, $sizeId) - qty_added($productId, $colorId, $sizeId);
    
}

//Descontar items del carrito, a la tabla donde se guarde la cantidad
function discount($item)
{
    //Encontrar el producto que tiene en el carrito
    $product = Product::find($item->id);

    $qty_available = qty_available($item->id, $item->options->color->id, $item->options->size_id);


    //Determinar el tipo de producto
    if($item->options->size_id){

        //Recuperar informacion de la talla
        $size = Size::find($item->options->size_id);

        //Eliminar registro de talla en la tabla pivote, para esto se necesita el id color de la talla
        $size->colors()->detach($item->options->color_id);

        //Volver a crear registro de talla, pero con la cantidad nueva
        $size->colors()->attach([
            $item->options->size_id => ['quantity' => $qty_available]
        ]);

    }elseif($item->options->color_id){

        //Lo mismo pero ahora con color, eliminar registro de color_product
        $product->colors()->detach($item->options->color_id);

        //Generar de nuevo, con la nueva qty
        $product->colors()->attach([
            $item->options->color_id => ['quantity' => $qty_available]
        ]);

    }else{
        //Producto sin cantidad ni color
        $product->quantity = $qty_available;
        $product->save();
    }

}