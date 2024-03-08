@extends('layouts.layout')

@section('title', 'Shopping Cart')

@section('content')
    <span id="message"></span>
    <body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                @if(Cart::content()->count() == 0)
                    <h1 class="text-3xl font-semibold">Your cart is empty!</h1>
                    <p><a href="{{ route('open.products.index') }}">Add items now... click here!</a> </p>
                @endif

                @foreach(Cart::content() as $item)
                    <div class="items bg-gray-100 p-3">
                        <strong>{{ $item->name }}</strong>
                        <p>Price: &euro; {{ $item->price }}</p>
                        <form id="qtyform" action="{{ url('/cart/update/' . $item->rowId) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="qty"></label><input type="number" min="1" max="9" name="quantity" id="qty" value="{{ $item->qty }}" data-row-id="{{ $item->rowId }}">
                        </form>
                        <button data-prod-id="{{ $item->rowId }}"  class="removeItem font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</button>
                    </div>

                @endforeach
            </div>

            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Items: {{ Cart::content()->count()  }}</span>
                    <span id="subtotal" class="font-semibold text-sm">&euro; {{ $subtotal }}</span>
                </div>
                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total cost with tax <p>(21%)</p></span>
                        <span id="totalWithTax">&euro; {{ $totalWithTax }}</span>
                    </div>
{{--                    <form action="{{ route('checkout.placeOrder') }}" method="post">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="total" value="{{ $totalWithTax }}">--}}
{{--                        <button type="submit" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>--}}
{{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
