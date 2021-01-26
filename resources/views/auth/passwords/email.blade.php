@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow overflow-hidden mx-auto">
        <div class="py-4 px-6">
            <div class="text-center font-bold text-gray-700 text-3xl">Brand</div>
            <div class="mt-1 text-center text-gray-600">Reset Password</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mt-4 w-full">
                    <input type="email" name="email" placeholder="Email address"
                               class="w-full mt-2 py-3 px-4 bg-gray-100 text-gray-700 border border-gray-300 rounded  block appearance-none placeholder-gray-500 focus:outline-none focus:bg-white"/>
                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center mt-6">
                        <a href="/register" class="text-gray-600 text-sm hover:text-gray-500">Register Now?</a>
                        <button type="submit"
                                class="py-2 px-4 bg-gray-700 text-white rounded hover:bg-gray-600 focus:outline-none">
                                Send Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex items-center justify-center py-4 bg-gray-100 text-center">
            <h1 class="text-gray-600 text-sm">Already have account?</h1>
            <a href="/login" class="text-blue-600 font-bold mx-2 text-sm hover:text-blue-500">Login</a>
        </div>
    </div>
</div>
@endsection
