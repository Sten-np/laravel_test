@extends('layouts.layoutadmin')
@section('title', 'Create a new product')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create a new product</h1>

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

        <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Product name</label>
                <input type="text" id="name" name="name" placeholder="Enter product name" required
                       value="{{ old('name') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Product description</label>
                <textarea id="description" name="description" rows="4" required
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Product image</label>
                <input type="text" id="image" name="image" placeholder="Enter product image url" required
                       value="{{ old('image') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline">
            </div>

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create product
            </button>
        </form>
    </div>
@endsection
