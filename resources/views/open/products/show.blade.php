@extends('layouts.layout')

@section('title',  $product->name)

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex items
        -center justify-between mb-4">
            <h1 class="text-4xl font-bold">{{ $product->name }}</h1>
            <a href="{{ route('open.products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="prod-card bg-white rounded-lg overflow-hidden shadow-lg cursor-pointer object-cover">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h2 class="font-bold text-xl mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-700">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

