@extends('layouts.layoutadmin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Users</h1>
                <p>Here you can manage the users of the application.</p>
            </div>
        </div>
    </div><br>
    <table class="min-w-full leading-normal shadow rounded overflow-hidden">
        <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                ID
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Image
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Name
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                description
            </th>

        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    {{ $user->id }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    {{ $user->name }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="flex items-center justify-center mt-4">
        {{ $users->links() }}
    </div>

@endsection
