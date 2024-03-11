<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function removeFromCart(Request $request): JsonResponse
    {
        Cart::remove($request->post('id'));
        return response()->json(['success' => 'Product has been removed from cart']);
    }

    public function getCartCount(): JsonResponse
    {
        $count = Cart::count();
        return response()->json(['count' => $count]);
    }

    public function updateCart()
    {
        $rowId = request('rowId');
        $qty = request('qty');
        Cart::update($rowId, $qty);
        return back();
    }

    public function getCartPrice(): JsonResponse
    {
        $subtotal = Cart::subtotal();
        $totalWithTax = Cart::total();
        return response()->json(['subtotal' => $subtotal, 'totalWithTax' => $totalWithTax]);
    }

    public function checkout()
    {
        $pdf = PDF::loadView('pdf.cart_invoice');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('invoice.pdf');
    }

}
