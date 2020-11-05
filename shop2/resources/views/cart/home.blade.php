@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="flex justify-between font-semibold bg-blue-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <p class="flex text-xl py-2 px-4">{{ Auth::user()->name }} Dashboard</p>
                <form class="flex inline-block justify-end" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm py-2 px-4 leading-none border rounded text-gray-800 border-gray-800 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0" type="submit">Logout</button>
                </form>
            </header>

            <div class="w-full p-6">
                <cart-info :cart="cart"></cart-info>
            </div>
        </section>
    </div>
</main>
@endsection
