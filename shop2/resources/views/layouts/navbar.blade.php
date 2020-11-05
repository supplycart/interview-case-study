<nav class="flex items-center justify-between flex-wrap bg-blue-400 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      {{-- <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" src="{{asset('img/cart.png')}}"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg> --}}
        <a href="{{ url('/')}}">
            <img class="w-10" src="{{asset('img/cart.png')}}" alt="landing page">
        </a>
      {{-- <img class="w-20 py-5 px-5" src="{{asset('img/cart.png')}}" alt="landing page">
      <span class="font-semibold text-xl tracking-tight">Shop!</span> --}}
    </div>
    {{-- <div class="block lg:hidden">
      <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" src="{{asset('img/cart.png')}}"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
      </button>
    </div> --}}
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
      <div class="text-sm lg:flex-grow">
        <!-- Authentication Links -->
        <a href="{{ url('/')}}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4 text-xl">
          Home
        </a>
        {{-- <a href="{{ url('/user')}}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4 text-xl">
            {{ Auth::user()->name }}
        </a> --}}
      </div>
      <div>
        @guest
            @if ((Route::has('login')))
              <a href="/login" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Login</a>
            @endif
            @if (Route::has('register'))
              <a href="/Register" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Register</a>
            @endif
            @else
              @if ((Auth::user()->hasRole('superadministrator|administrator')))
                <a href="{{ url('/admin') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Dashboard</a>
                <cart-count :cartcount="totalItems"></cart-count>
              @endif
              @if ((Auth::user()->hasRole('user')))
                <a href="{{ url('/user') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Dashboard</a>
                {{-- <a href="{{ url('/cart') }}"><cart-count :cartcount="totalItems"></cart-count></a> --}}
              @endif
              <form class="inline-block justify-end" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0" type="submit">Logout</button>
              </form>
        @endguest
        {{-- <a href="/Register" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Register</a> --}}
      </div>
    </div>
</nav>