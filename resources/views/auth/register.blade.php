@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="flex flex-col items-center justify-center">
    <div class="flex flex-col bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
        <div class="font-medium self-center text-xl sm:text-2xl uppercase text-gray-800">{{ __('Register') }}</div>
            <div class="mt-10">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="flex flex-col mb-6">
                        <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">{{ __('Name') }}</label>
                        <div class="relative">
                            <input id="name" type="text" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400 @error('name') is-invalid @enderror" 
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-6">
                        <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">{{ __('E-Mail Address') }}</label>
                        <div class="relative">
                            <input id="email" type="email" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400 @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail Address">
                        </div>
                    </div>
                    <div class="flex flex-col mb-6">
                        <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">{{ __('Password') }}</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400 @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Password" />
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-6">
                        <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">{{ __('Password Confirmation') }}</label>
                        <div class="relative">                        
                            <input id="password-confirm" type="password" name="password_confirmation" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" required autocomplete="new-password" placeholder="Password Confirmation" />
                        </div>
                    </div>      
                    <div class="flex flex-col mb-6">
                        <label for="phone_number" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">{{ __('Phone Number') }}</label>
                        <div class="relative">                        
                            <input id="phone_number" type="text" name="phone_number" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Phone Number" />
                        </div>
                    </div>      
                    <div class="flex flex-col mb-6">
                        <label for="address" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">{{ __('Address') }}</label>
                        <div class="relative">                            
                            <textarea id="address" name="address" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"  placeholder="Address">
                            </textarea>
                        </div>
                    </div>      
                    <div class="flex w-full">
                        <button type="submit" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-blue-600 hover:bg-blue-700 rounded py-2 w-full transition duration-150 ease-in">
                            <span class="mr-2 uppercase">{{ __('Register') }}</span>
                            <span>
                                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            <div class="flex justify-center items-center mt-6">
                <a href="{{ route('login') }}" class="inline-flex items-center font-bold text-blue-500 hover:text-blue-700 text-xs text-center">
                    <span>
                        <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </span>
                    <span class="ml-2">Members ?</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
