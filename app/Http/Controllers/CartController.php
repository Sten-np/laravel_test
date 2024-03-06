<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
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

    public function addToCart(Request $request): RedirectResponse
    {
        // Fetch the product details from the request, you'll need to adjust this based on your application
        $productId = $request->post('id');
        $product = Product::find($productId);

        if ($product) {
            // Add the product to the cart
            Cart::add($product->id, $product->name, 1, $product->latest_price->price);

            // Redirect back with success message
            return redirect()->route('cart.index')->with('success', 'Item was added to your cart');
        } else {
            // Redirect back with error message if product not found
            return redirect()->route('cart.index')->with('error', 'Product not found');
        }
    }

    public function removeFromCart($rowId): RedirectResponse
    {
        // Remove the item from the cart
        Cart::remove($rowId);

        // Redirect back with success message
        return redirect()->route('cart.index')->with('success', 'Item has been removed');
    }

    public function updateCart(Request $request, $rowId): RedirectResponse
    {
        // Update the item in the cart
        Cart::update($rowId, $request->input('quantity'));
        // Redirect back with success message
        return redirect()->route('cart.index')->with('success', 'Cart has been updated');
    }

}
