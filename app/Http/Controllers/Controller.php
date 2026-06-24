<?php

namespace App\Http\Controllers;
use App\Models\Product;

abstract class Controller
{
public function index()
    {
        $products = Product::all();
        return view('product.index')->with('products',$products);
    }
}
