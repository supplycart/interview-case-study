@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <div class="flex ">
            <div class="flex-none justify-center">
                <div class="text-2xl py-3">
                    <h1>Hello welcome to the <span class="text-red-700">Shop</span>!</h1>
                </div>
                <div class="text-1xl">
                    <h4>Feel <span class="text-red-700">free</span> to browse the products</h4>
                </div>
                @guest
                    @if ((Route::has('login')))
                    <div class="text-2xl py-5">
                        <h5>Login to purchase anything</h5>
                        <br>
                        <a href="/login" class="inline-block text-sm px-4 py-2 leading-none border rounded text-gray bg-blue-300 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Login</a>
                    </div>
                    @endif
                    @else  
                        @if ((Auth::user()->hasRole('superadministrator|administrator')))
                        <div class="text-2xl py-5">
                            <h5>Click dashboard to see your profile</h5>
                            <br>
                            <a href="/admin" class="inline-block text-sm px-4 py-2 leading-none border rounded text-gray bg-blue-300 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Dashboard</a>
                        </div>
                        @endif
                        @if ((Auth::user()->hasRole('user')))
                        <div class="text-2xl py-5">
                            <h5>Click dashboard to see your profile</h5>
                            <br>
                            <a href="/user" class="inline-block text-sm px-4 py-2 leading-none border rounded text-gray bg-blue-300 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Dashboard</a>
                        </div>
                        @endif
                    
                @endguest
            </div>
            <div class="col-6">
                <div class="flex justify-end items-center">
                    <img class="w-1/2 py-5 px-5" src="{{asset('img/laravel.png')}}" alt="landing page">
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <h2 class="font-medium text-2xl py-5">Products</h2>
        </div>
        <cart-info :cart="cart" :carttotal="cartTotal"></cart-info>
        <show-product :products='{{$products}}' :categories='{{$categories}}' :subcategories='{{$subcategories}}'></show-product>
    </div>
@endsection