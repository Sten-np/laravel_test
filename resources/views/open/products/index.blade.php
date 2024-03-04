@extends('layouts.layout')

@section('title', 'Our Products')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">Our Products</h1>
        <p class="text-xl">Here you can find all the products we have available for purchase.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @if($products->isEmpty())
                <h2 class="text-10xl font-extrabold">No products found.</h2>
            @endif
            @foreach($products as $product)
                <div class="prod-card bg-white rounded-lg overflow-hidden shadow-lg cursor-pointer object-cover">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-640 h-790 object-cover">
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
    </div>


    <div class="flex items-center justify-center mt-4">
        {{ $products->links() }}
    </div>
@endsection

