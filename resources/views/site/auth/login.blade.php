@extends('site.app')
@section('title', 'Supplycart test')
@section('content')
    <form action="{{ route('site.login.post') }}" method="POST" role="form" class="flex flex-col pt-3 md:pt-8">
        @csrf
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" name="email" type="email" placeholder="Email" autofocus value="{{ old('email') }}">
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" name="password" type="password" placeholder="******************">
            </div>

            <div class="flex items-center justify-between">
                <input type="submit" value="Sign In" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">
                <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="#">
                    Forgot Password?
                </a>
            </div>
        </div>
    </form>
@endsection
