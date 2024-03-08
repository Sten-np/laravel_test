@extends('layouts.layout')

@section('title',  $product->name)

@section('content')
    <div class="container mx-auto p-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div >
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-75 h-75 object-cover rounded-lg">
            </div>
            <div>
                <span id="message"></span>
                <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-xl">&euro; {{ $product->latest_price->price }}</p>
                <p>{{ $product->description }}</p>
                <button
                    class="addToCart bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md" data-prod-id="{{ $product->id }}">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </button>
            </div>
        </div>
    </div>
@endsection
