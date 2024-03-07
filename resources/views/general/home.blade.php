@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">Welcome to Sten's GameShop</h1>
        <p class="text-xl">We have a wide range of games and consoles available for purchase. Check out our products
            page to see what we have in stock.</p>
    </div>



    <div class="container mx-auto p-4 space-y-14">
        <h1 class="text-4xl font-bold mb-4">Recently Added</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($newestProducts as $product)
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
                                        <form action="{{ route('cart.add') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                                <span class="material-symbols-outlined">shopping_cart</span>
                                            </button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <img src="{{ asset('img/banner.jpg') }}" alt="webbanner" class="w-full h-full object-cover">


    </div>

    <footer>
        <div class="container mx-auto p-4 bottom-0 relative">
            <p class="text-center">© 2024 Sten's GameShop</p>
        </div>
    </footer>

@endsection

