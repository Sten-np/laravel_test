<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
                    Account <span class="material-symbols-outlined">
arrow_drop_down
</span>

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
<script defer type="text/javascript">
    function dropdown() {
        document.getElementById('myDropdown').classList.toggle("show");
    }
</script>
</html>
