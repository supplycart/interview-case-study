<!DOCTYPE html>
<html>
<head>
    <title>Faiez Yacob: Case Study</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="mb-10">

    <nav class="bg-gray-100">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between">
                <div class="flex">
                    <div>
                        <a href="{{ route('dashboard') }}" class="flex items-center py-4 px-3 text-gray-700 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        <span class="font-bold">Faiez Yacob<span>
                        </a>
                    </div>
                </div>
                @if (Auth::check())
                <div class="flex items-center space-x-1">
                    <a href="{{ route('view-order') }}" class="py-2 px-3 rounded text-white transition duration-300 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </a>
                    <a href="{{ route('view-cart') }}" class="py-2 px-3 rounded text-white transition duration-300 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="absolute right-3 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm  leading-tight text-center">
                            @if (Session::get('cart') !== null)
                            {{ count(Session::get('cart')) }}
                            @else
                            0
                            @endif
                        </span>
                    </a>
                    <a href="{{ route('signout') }}" class="py-2 px-3 hover:bg-indigo-700 bg-indigo-600 rounded text-white transition duration-300">Logout</a>
                </div>
                @else
                <div class="flex items-center space-x-1">
                    <a href="{{ route('login') }}" class="py-3 px-3 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="py-2 px-3 hover:bg-indigo-700 bg-indigo-600 rounded text-white transition duration-300">Signup</a>
                </div>
                @endif
            </div>
        </div>
    </nav>
    @yield('content')

</body>
<script>
  function closeAlert(){
    let alertEl = document.getElementById('alert');
    alertEl.remove();
  }
</script>
</html>