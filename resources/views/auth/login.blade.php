@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-full min-w-full md:min-w-2/5 ">
        <h1 class="mt-8 text-center text-gray-800 font-bold text-4xl">
            {{ __('Login') }}
        </h1>

        <form class="m-10" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="rounded-md shadow-sm">
                <div>
                    <input aria-label="Email address" name="email" type="email" value="{{ old('email') }}" required class="appearance-none rounded-none relative block w-full border border-gray-300 mt-4 p-3 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5  @error('email') border-red-300  @enderror" placeholder="Email">
                </div>
                @error('email')
                <span class="text-red-500 font-normal p-1 w-full text-center text-xs" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="-mt-px">
                    <input aria-label="Password" name="password" type="password" required class="appearance-none rounded-none relative block w-full mt-2 p-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5  @error('password') border-red-300  @enderror" placeholder="Password">
                </div>
                @error('password')
                <span class="text-red-500 font-normal p-1 w-full text-center text-xs" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} class="form-checkbox h-4 w-4 text-blue-600 transition ease-out duration-200">
                    <label for="remember" class="ml-2 block text-sm leading-5 text-gray-900">
                        {{ __('Remember Me') }}

                    </label>
                </div>

                @if (Route::has('password.request'))
                <div class="flex text-sm leading-5">
                    <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none transition ease-out duration-200">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
                @endif
            </div>

            <div class="mt-10">
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition ease-out duration-200">
                    {{ __('Login') }}
                </button>
            </div>
            <div class="mt-3 text-sm leading-5 text-gray-900 text-center">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none transition ease-out duration-200">
                    {{ __('Register now') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection