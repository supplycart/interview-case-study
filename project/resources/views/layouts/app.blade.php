<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Supply Cart')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-4 min-h-screen">
        <h1 class="text-2xl font-bold mb-6">Supply Cart</h1>
        <nav class="space-y-4">
            <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Products</a>
            <a href="{{ route('cart.view') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Cart</a>
            <a href="{{ route('orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Orders</a>
            <a href="{{ route('activity.logs') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Activity Logs</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-600 bg-red-500">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        <header class="bg-blue-600 text-white p-4">
            <div class="container mx-auto">
                <h1 class="text-2xl font-bold">@yield('header')</h1>
            </div>
        </header>

        <main class="container mx-auto p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
