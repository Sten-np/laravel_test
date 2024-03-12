@extends('layouts.layout')

@section('title',  $product->name)

@section('content')
    <div class="flex">

        <table class="table-auto w-full">
            <div>
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                     class="min-w-75 min-h-75 w-75 h-75 object-cover rounded-lg">
            </div>
            <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-tight">
                <th class="px-6 py-3 text-left">Feature</th>
                <th class="px-6 py-3 text-left">Detail</th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-gray-200 text-gray-700">
                <td class="px-6 py-4">Product Name</td>
                <td class="px-6 py-4">{{ $product->name }}</td>
            </tr>
            <tr class="border-gray-200 text-gray-700">
                <td class="px-6 py-4">Description</td>
                <td class="px-6 py-4">{{ $product->description }}</td>
            </tr>
            <tr class="border-gray-200 text-gray-700">
                <td class="px-6 py-4">Price</td>
                <td class="px-6 py-4">&euro; {{ $product->latest_price->price }}</td>
            </tr>
            </tbody>


        </table>



    </div>

    <br><button
        class="addToCart bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md" data-prod-id="{{ $product->id }}">
        <span class="material-symbols-outlined">shopping_cart</span>
    </button>

@endsection
