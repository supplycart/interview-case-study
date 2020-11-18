@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100" id="register">
    <div class="max-w-full min-w-full md:min-w-2/5 ">
        <h1 class="mt-8 text-center text-gray-800 font-bold text-4xl">
            {{ __('Register') }}
        </h1>

        <form class="m-10" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="rounded-md shadow-sm">
                <div>
                    <input name="name" type="text" value="{{ old('name') }}" required autocomplete="name" class="appearance-none rounded-none relative block w-full border border-gray-300 mt-4 p-3 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5  @error('name') border-red-300  @enderror" placeholder="Full Name">
                </div>
                @error('name')
                <span class="text-red-500 font-normal p-1 w-full text-center text-xs" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="-mt-px">
                    <input name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="appearance-none rounded-none relative block w-full border border-gray-300 mt-2 p-3 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5  @error('email') border-red-300  @enderror" placeholder="Email">
                </div>
                @error('email')
                <span class="text-red-500 font-normal p-1 w-full text-center text-xs" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="-mt-px">
                    <input  v-on:blur="validatePassword" v-model="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full mt-2 p-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5  @error('password') border-red-300  @enderror" placeholder="Password">
                </div>
                @error('password')
                <span class="text-red-500 font-normal p-1 w-full text-center text-xs" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="-mt-px">
                    <input v-on:blur="validatePassword" v-model="password2" name="password_confirmation" type="password" required class="appearance-none rounded-none relative block w-full mt-2 p-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5  @error('password') border-red-300  @enderror" v-bind:class="{'border-red-300': invalidPass}" placeholder="Confirm Password">
                </div>
                <span v-if="invalidPass" class="text-red-500 font-normal p-1 w-full text-center text-xs" role="alert">
                    <strong>The password confirmation does not match.</strong>
                </span>
            </div>

            <div class="mt-10">
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition ease-out duration-200">
                    {{ __('Register') }}
                </button>
            </div>
            <div class="mt-3 text-sm leading-5 text-gray-900 text-center">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none transition ease-out duration-200">
                    {{ __('Login') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
@push('head')
<!-- Scripts -->
<script src="{{ asset('js/register.js') }}" defer></script>
@endpush