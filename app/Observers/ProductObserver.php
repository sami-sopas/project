<?php

namespace App\Observers;
use App\Models\Product;
use App\Models\Subcategory;

/*
    Cada que se realiza una operacion en el modelo
    producto, aqui se escuchan y se realiza alguna operacion
    NOTA: CREO QUE FALTA ELIMINAR LA CANTIDAD DE LA TABLA PRODUCTOS
*/

class ProductObserver
{
    //Se ejecuta este observer al actualizar un producto
    //Recibe el registro que se acaba actualizar
    public function updated(Product $product)
    {
        //Rescatar informacion de la subcategoria por la cual se esta actualizando
        $subcategory_id = $product->subcategory->id;

        //Determinar el tipo de subcategoria
        $subcategory = Subcategory::find($subcategory_id);

        //Esa subcategoria necesita talla?
        if($subcategory->size){
            //Esa subcategoria tiene un color asociado a ese producto=
            if($product->colors->count()){
                //Eliminamos los registros asociados a ese producto, de la tabla pivote color-product
                $product->colors()->detach();
            }
        //Esa subcategoria tiene color?
        }elseif($subcategory->color){
            //El producto tiene tallas asociadas
            if($product->sizes->count()) {
                //Iteramos las tallas almacenadas y las vamos eliminando
                foreach($product->sizes as $size){
                    $size->delete();
                }
            }
        }
        //La subcategoria no necesita talla ni color
        else{
            //Realizamos entonces una combinacion de ambos casos anteriores

            //De tener colores asociados, los eliminamos
            if($product->colors->count()){
                $product->colors()->detach();
            }
            //De tener tallas asociadas, las eliminamos
            if($product->sizes->count()) {
                foreach($product->sizes as $size){
                    $size->delete();
                }
            }
        }
    }
}
