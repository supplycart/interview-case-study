@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <h1 class="text-white text-3xl">Random E-Shop</h1>
        <h2 class="text-blue-300">Login</h2>

        <form method="POST" action="{{ route('login') }}" class="pt-8">
            @csrf

            <div class="relative">
                <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">E-Mail</label>

                <div class="">
                    <input id="email" type="email" class="pt-8 w-full rounded p-3 text-gray-800 outline-none" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                    @error('email')
                    <span class="text-red-600 text-sm pt-1" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="pt-4 relative">
                <label for="password" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="pt-8 w-full rounded p-3 text-gray-800 outline-none" name="password" autocomplete="current-password">

                    @error('password')
                    <span class="text-red-600 text-sm pt-1" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="pt-8">
                <div class="">
                    <div class="">
                        <input class="text-white" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="text-white" for="remember">Remember Me</label>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full uppercase rounded text-blue-800 font-bold bg-gray-400 ">Login</button>
            </div>

            <div class="flex justify-between pt-8">
                @if (Route::has('password.request'))
                    <a class="text-white text-sm font-bold" href="{{ route('password.request') }}">
                        Forgot Your Password
                    </a>
                @endif
                    @if (Route::has('password.request'))
                        <a class="text-white text-sm font-bold"  href="{{ route('register') }}">
                            Register
                        </a>
                    @endif
            </div>
        </form>
    </div>
</div>
@endsection
