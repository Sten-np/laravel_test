<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Price;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index products', ['only' => ['index']]);
        $this->middleware('permission:show products', ['only' => ['show']]);
        $this->middleware('permission:create products', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit products', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete products', ['only' => ['delete', 'destroy']]);
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::with('prices')->paginate(10);
        return view('admin.products.index', compact('products'));
    }


    /**
     * @return JsonResponse
     * @param ProductStoreRequest $request
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $request->image;

        $product->save();

        $price = new Price([
            'price' => $request->price,
        ]);

        $product->prices()->save($price);
        $product = Product::with('latest_price')->findOrFail($product->id);

        return response()->json(['product' => $product]);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): jsonResponse
    {
        $product = Product::with('latest_price')->findOrFail($id);
        return response()->json(['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('prices')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        $price = new Price([
            'price' => $request->price,
        ]);

        $product->prices()->save($price);

        return to_route('products.index')->with('status', 'Product updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['status' => 'Product deleted!']);
    }
}
