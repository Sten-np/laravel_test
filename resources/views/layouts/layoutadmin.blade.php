<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<body>
<!--Container -->
<div class="mx-auto bg-grey-400">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav">
            <div class="flex justify-between">
                <div class="p-1 mx-3 inline-flex items-center">
                    <h1 class="text-white p-2">Logo</h1>
                </div>
                <div class="p-1 flex flex-row items-center">
                    <p>{{ Auth()->user()->name }}</p>
                    @auth()
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </div>

            </div>
        </header>
        <!--/Header-->

        <div class="flex flex-1">
            <!--Sidebar-->
            <aside id="sidebar"
                   class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                <ul class="list-reset flex flex-col">
                    <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                        <a href="{{ route('home') }}">Public Site</a>
                    </li>
                    <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    </li>
                    <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                        <a href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                        <a href="{{ route('users.index') }}">Users</a>
                    </li>
                </ul>
            </aside>
            <!--/Sidebar-->
            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                @yield('content')
            </main>
            <!--/Main-->
        </div>
        <!--Footer-->
        <footer class="bg-grey-darkest text-white p-2">
            <div class="flex flex-1 mx-auto">&copy; My Design</div>
        </footer>
        <!--/footer-->
    </div>

</div>
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
