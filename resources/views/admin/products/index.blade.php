@extends('layouts.layoutadmin')

@section('title', 'Admin Products')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Products</h1>
                <p>Here you can manage the products of the application.</p><br>
                <button class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                    <a href="{{ route('products.create') }}">Create a new product</a>
                </button>
            </div>
        </div><br>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Succes!</strong>
                <span class="block sm:inline">{{ session('status') }}</span>
            </div><br>

        @endif
    </div><br>
    <table class="min-w-full leading-normal shadow rounded overflow-hidden">
        <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                ID
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Name
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Image
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                description
            </th>

        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    {{ $product->id }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    {{ $product->name }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    {{ $product->image }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    {{ $product->description }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="flex items-center justify-center mt-4">
        {{ $products->links() }}
    </div>

@endsection
