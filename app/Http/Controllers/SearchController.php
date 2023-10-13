<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    //En $request se queda almacenada la informacion enviada por la url mediante GET
    public function __invoke(Request $request)
    {
        $name = $request->name;

        $products = Product::where('name','LIKE', "%" . $name . "%")->paginate(8);
        return view('search',compact('products','name'));
    }
}
