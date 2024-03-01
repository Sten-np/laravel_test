<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="flex justify-between items-center bg-gray-800 p-6">
        <div>
            <a href="{{ route('home') }}" class="text-white
            text-2xl font-bold">Laravel Tailwind</a>
        </div>

        @hasrole('admin')
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-white
            text-2xl font-bold">Admin Dashboard</a>
        </div>
        @endhasrole

        @auth
        <div>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="text-white text-2xl font-bold">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        @endauth

        @guest
        <div>
            <a href="{{ route('login') }}" class="text-white
            text-2xl font-bold">Login</a>
        </div>
        <div>
            <a href="{{ route('register') }}" class="text-white
            text-2xl font-bold">Register</a>
        </div>
        @endguest

{{--        <div>--}}
{{--            <a href="{{ route('/products') }}" class="text-white--}}
{{--            text-2xl font-bold">Products</a>--}}
{{--        </div>--}}
    </nav>
</header>
<div class="section">
    @yield('content')
</div>


</body>
</html>
