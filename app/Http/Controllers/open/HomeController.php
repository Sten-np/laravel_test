<?php

namespace App\Http\Controllers\open;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newestProducts = Product::orderBy('created_at', 'desc')->take(3)->get();
        return view('general.home', compact('newestProducts'));
    }
}
