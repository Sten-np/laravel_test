<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $subtotal = Cart::subtotal();
        $totalWithTax = Cart::total();
        return view('general.cart.index', compact('subtotal', 'totalWithTax'));
    }

    public function addToCart(Request $request): JsonResponse
    {
        // Fetch the product details from the request, you'll need to adjust this based on your application
        $productId = $request->post('id');
        $product = Product::find($productId);

        if ($product) {
            // Add the product to the cart
            Cart::add($product->id, $product->name, 1, $product->latest_price->price);

            if (Cart::count() > 0) {
                // Redirect back with success message
                return response()->json(['success' => 'Product has been added to cart']);
            } else {
                // Redirect back with error message if product not found
                return response()->json(['error' => 'Product not found']);
            }

        } else {
            // Redirect back with error message if product not found
            return response()->json(['error' => 'Product not found']);
        }
    }

    public function removeFromCart(Request $request, string $id): JsonResponse
    {
        // Remove the item from the cart
        Cart::remove($id, $request->input($id));

        // Redirect back with success message
        return response()->json(['success' => 'Product has been removed from cart']);
    }

    public function updateCart(Request $request, $rowId): RedirectResponse
    {
        // Update the item in the cart
        Cart::update($rowId, $request->input('quantity'));
        // Redirect back with success message
        return to_route('cart.index')->with('success', 'Cart has been updated');
    }

    public function getCartCount(): JsonResponse
    {
        // Get the cart count
        $count = Cart::count();
        return response()->json(['count' => $count]);
    }

}
