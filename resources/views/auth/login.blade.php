@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-green-900 rounded-lg shadow-xl p-6">
    <!-- <svg class="fill-current w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">

    <g>
    <text stroke="#000" transform="matrix(1.3830636739730835,0,0,1.6684831380844116,-129.8166878875345,-176.8764603175223) " font-style="normal" font-weight="normal" xml:space="preserve" text-anchor="start" font-family="'Montserrat Black'" font-size="24" id="svg_1" y="290.2" x="338.9" opacity="undefined" stroke-width="0" fill="#077a8c">Supplycart</text>
    </g>
    </svg> -->
    <h1 class="text-white text-3xl pt-8">Welcome Back, Traveller</h1>
    <h2 class="text-green-300">Enter the credentials below</h2>
    <form method="POST" action="{{ route('login') }}" class="pt-8">
                        @csrf

                        <div class="relative">
                            <label for="email" class="uppercase text-green-500 text-xs font-bold absolute pl-3 pt-2">{{ __('E-Mail') }}</label>

                            <div>
                                <input id="email" type="email" class="pt-8 w-full rounded p-4 bg-green-200 text-black outline-none focus:bg-green-50" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="yourname@email.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="relative pt-3">
                            <label for="password" class="uppercase text-green-500 text-xs font-bold absolute pl-3 pt-2t">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="pt-8 w-full rounded p-4 bg-green-200 text-black outline-none focus:bg-green-50" name="password" required autocomplete="current-password" placeholder="yourpassword">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="pt-2">
                            <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="text-white" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="pt-8">
                            <button type="submit" class="w-full bg-gray-300 py-2 px-3 text-left text-green-800 uppercase rounded text-gray-200 font-bold">
                                        {{ __('Login') }}
                                    </button>
                        </div>

                        <div class="flex pt-8 justify-between text-white text-sm font-bold">
                            <a class="" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                            <a class="" href="{{ route('register') }}">
                                            Register
                                        </a>
                        </div>
                    </form>
    </div>
</div>
@endsection
