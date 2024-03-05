@extends('layouts.layout')

@section('title', 'Our Products')

@section('content')
    <div class="container mx-auto p-4 space-y-14">
        <h1 class="text-4xl font-bold mb-4">Our Products</h1>
        <p class="text-xl">Here you can find all the products we have available for purchase.</p>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($products as $product)
                <div>
                    <a href="{{ route('open.products.show', $product->id) }}">
                        <div class="prod-card bg-white rounded-lg overflow-hidden shadow-lg cursor-pointer object-cover">
                            <div>
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                     class="w-full h-64 object-cover">
                                <div class="p-4 flex justify-between items-center">
                                    <div>
                                        <h2 class="font-bold text-xl mb-2">{{ $product->name }}</h2>
                                        <p class="text-gray-700">&euro; {{ $product->latest_price->price }}</p>
                                    </div>
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md"><a
                                            href="#"><span class="material-symbols-outlined">shopping_cart</span></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    <div class="flex items-center justify-center mt-4">
        {{ $products->links() }}
    </div>
@endsection

