@extends('layouts.layoutadmin')

@section('title', 'Edit ' . $product->name )

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit {{ $product->name }}</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Er is iets fout gegaan!</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li><span class="block sm:inline">{{ $error }}</span></li>
                    @endforeach
                </ul>
            </div><br>
        @endif

        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Product name</label>
                <input type="text" id="name" name="name" placeholder="Enter product name" required
                       value="{{ old('name', $product->name) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Product description</label>
                <textarea id="description" name="description" rows="4" placeholder="{{ old('description', $product->description) }}"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-bold mb-2">Product price</label>
                <input type="text" id="price" name="price" placeholder="Enter product price" required
                       value="{{ old('price', $product->latest_price->price) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Product image</label>
                <input type="text" id="image" name="image" placeholder="Enter product image url" required
                       value="{{ old('image', $product->image) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline">
            </div>

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Edit product
            </button>
        </form>
    </div>


    <script>
        document.getElementById("message").textContent = {{ old('description', $product->description) }};
    </script>

@endsection

