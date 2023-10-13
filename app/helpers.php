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

}

//Calcula la cantidad que aun puedo agregar a mi carrito
function qty_available($productId, $colorId = null, $sizeId = null)
{
    return quantity($productId, $colorId, $sizeId) - qty_added($productId, $colorId, $sizeId);
    
}