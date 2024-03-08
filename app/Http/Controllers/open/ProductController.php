<?php

namespace App\Http\Controllers\open;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::with('prices')->paginate(10);
        return view('open.products.index', compact('products'));
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        $product = Product::with('prices')->find($product->id);
        return view('open.products.show', compact('product'));
    }

    /**
     * @param string $term
     */
    public function search(string $term)
    {
        $products = Product::search($term)->get();
        return $products;
    }

}
