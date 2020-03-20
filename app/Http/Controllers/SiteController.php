<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SiteController extends Controller
{
    public function main()
    {
        $product = new Product;

        $product->setColorFilter(request()->query('color'));
        $product->setSorting(request()->query('price'));

        return view('welcome',[
            'products' => $product->getAll(),
            'category' => $product->getCategory(),
            'colors' => $product->getColors(),
            'brands' => $product->getBrands()
        ]);
    }
}
