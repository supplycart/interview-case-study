@extends('app')

@section('title', 'Register')

@section('content')

<div class="bg-white rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
    <form method="POST" action="{{ route('register.custom') }}"> 
        @csrf  
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" placeholder="Name" id="name" name="name" required autofocus>
            @if ($errors->has('name'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" placeholder="Email" id="email" name="email" required>
            @if ($errors->has('email'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="mb-6">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input class="shadow appearance-none border border rounded w-full py-2 px-3 text-grey-darker mb-3" type="password" placeholder="Password" id="password" name="password" required>
            @if ($errors->has('password'))
                <span class="text-red-500 text-xs italic">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class='mb-4'>
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-700 hover:bg-black text-white font-bold py-2 px-4 rounded" type="submit">
                Sign up
            </button>
        </div>
    </form>
</div>

@endsection