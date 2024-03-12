@extends('layouts.layoutadmin')
@section('title', 'Categories admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Categories</h1>
                <p>Here you can manage the categories of the application.</p><br>
                <button id="createcategory" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                    Create a category
                </button>
            </div>
        </div>
        <br>

        <table id="categoryTable" class="min-w-full leading-normal shadow rounded overflow-hidden">
            <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    ID
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Name
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody id="tbodyid">
            @foreach ($categories as $category)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $category->id }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $category->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('category.edit', $category->id) }}"
                           class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.categories.modals.create')

@endsection

