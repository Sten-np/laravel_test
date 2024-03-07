<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    <style>
        .prod-card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body>
<header>
    <nav class="flex justify-between items-center bg-gray-800 p-6">
        <div>
            <a href="{{ route('home') }}" class="text-white
            text-2xl font-bold">Sten's GameShop</a>
        </div>

        <div>
            <a href="{{ route('open.products.index') }}" class="text-white
            text-2xl font-bold">Products</a>
        </div>

        <div>


            <button type="button"
                    class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <a href="{{ route('cart.index') }}">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <div
                        class="absolute -top-5  flex items-center justify-center w-10 h-10 text-xl font-extrabold text-white bg-red-500 border-2 border-white rounded-full dark:border-gray-900">
                        {{ Cart::content()->count() }}
                    </div>
                </a>
            </button>
        </div>

        <div>
            <form action="{{ route('open.products.search', ['term' => "minecraft"]) }}" method="post">
                @csrf
                <input type="text" name="search" placeholder="Search for products" class="rounded-lg p-2">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Search
                </button>
            </form>
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
                <button class="dropdown-btn relative text-3xl"
                        style="background-color: #0d6efd; border-radius: 5px; padding: 5px;" onmouseover="dropdown()"
                        onmouseout="dropdown()">
                    Account <span class="material-symbols-outlined">arrow_drop_down</span>
                </button>
                <div id="myDropdown" class="dropdown-content absolute bg-gray-100 p-10" onmouseout="dropdown()" style="float: right; display: none;
                border-radius: 3px;">
                    <ul class="space-y-6">
                        <li>
                            <button style="background-color: #0d6efd; border-radius: 5px; padding: 5px;">
                                <a href="{{ route('login') }}" class="text-black text-2xl font-bold">Login</a>
                            </button>
                        </li>
                        <li>
                            <button style="background-color: #0d6efd; border-radius: 5px; padding: 5px;">
                                <a href="{{ route('register') }}" class="text-black text-2xl font-bold">Register</a>
                            </button>
                        </li>
                    </ul>

                </div>
            </div>

        @endguest
    </nav>
</header>
<main class="bg-white-300 flex-1 p-3 overflow-hidden">
    @yield('content')
</main>
<footer class="bg-grey-darkest text-white p-2">
    <div class="flex flex-1 mx-auto">&copy; My Design</div>
</footer>
</body>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
</html>
