@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="flex flex-col items-center justify-center">
  <div class="flex flex-col bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
    <div class="font-medium self-center text-xl sm:text-2xl uppercase text-gray-800">
      {{ __('Login') }}
    </div>  
    <div class="mt-10">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex flex-col mb-6">
          <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">{{ __('E-Mail Address') }}</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>
            <input 
              id="email" 
              type="email" 
              name="email" 
              class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400 @error('email') is-invalid @enderror" 
              value="{{ old('email') }}" 
              required autocomplete="email" 
              placeholder="E-Mail Address" 
              autofocus/>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="flex flex-col mb-6">
          <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">{{ __('Password') }}</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <span>
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
              </span>
            </div>
            <input 
              id="password" 
              type="password" 
              name="password" 
              class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400 @error('password') is-invalid @enderror"  
              required autocomplete="current-password" 
              placeholder="Password" />
          </div>
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="flex items-center mb-6 -mt-4">
          <div class="flex ml-auto">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="inline-flex text-xs sm:text-sm text-blue-500 hover:text-blue-700">
                {{ __('Forgot Your Password?') }}
              </a>
            @endif
          </div>
        </div>
        <div class="flex w-full">
          <button type="submit" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-blue-600 hover:bg-blue-700 rounded py-2 w-full transition duration-150 ease-in">
            <span class="mr-2 uppercase">{{ __('Login') }}</span>
            <span>
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </span>
          </button>
        </div>
      </form>
    </div>
    <div class="flex justify-center items-center mt-6">
      <a href="{{ route('register') }}" class="inline-flex items-center font-bold text-blue-500 hover:text-blue-700 text-xs text-center">
        <span>
          <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </span>
        <span class="ml-2">You don't have an account?</span>
      </a>
    </div>
  </div>
</div>
@endsection
