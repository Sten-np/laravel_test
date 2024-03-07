@extends('layouts.layoutadmin')

@section('title',  'Products')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Products</h1>
                <p>Here you can manage the products of the application.</p><br>
                <button id="createprod" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                    Create a product
                </button>
            </div>
        </div>
        <br>

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
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Price
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr data-prod-id="{{ $product->id }}">
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
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    &euro; {{ $product->latest_price->price }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <a href="{{ route('products.show', $product->id) }}"
                       class="text-blue-500 hover:text-blue-800">View</a>
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="text-blue-500 hover:text-blue-800">Edit</a>
                    <button id="delete" data-prod-id="{{ $product->id }}" class="text-red-500 hover:text-red-800">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="flex items-center justify-center mt-4">
        {{ $products->links() }}
    </div>
    @include('admin.products.modals.create')
    @include('admin.products.modals.delete')
    @include('admin.products.modals.show')
@endsection
