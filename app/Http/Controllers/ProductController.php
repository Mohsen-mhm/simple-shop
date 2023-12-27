<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function single($slug)
    {
        $product = Product::query()->whereSlug($slug)->first();

        return view('product.single', compact('product'));
    }
}
