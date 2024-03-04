@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">Welcome to Sten's GameShop</h1>
        <p class="text-xl">We have a wide range of games and consoles available for purchase. Check out our products page to see what we have in stock.</p>
    </div>



    <div class="container mx-auto p-4 space-y-14">
        <h1 class="text-4xl font-bold mb-4">Newest Products</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($newestProducts as $product)
                <div class="prod-card bg-white rounded-lg overflow-hidden shadow-lg cursor-pointer object-cover">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                    <div class="p-4">
                        <h2 class="font-bold text-xl mb-2">{{ $product->name }}</h2>
                        <p class="text-gray-700">{{ $product->description }}</p>
                        <div class="mt-4">
                            <a href="{{ route('open.products.show', $product) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View</a>
                        </div>
                    </div>
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

