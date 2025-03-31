@extends("layouts.default")
@section("title", "Login")
@section("content")
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    @if(session()->has("success"))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" 
        role="alert">
            {{session()->get("success")}}
        </div>
    @elseif(session()->has("error"))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" 
        role="alert">
            {{session()->get("error")}}
        </div>
    @endif
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{route("login.post")}}" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" autocomplete="email" required 
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base 
                    text-gray-900 outline-1 -outline-offset-1 outline-gray-300 
                    placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 
                    sm:text-sm/6">

                    @if($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="text-sm">
                        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                </div>
                <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="current-password" required 
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base 
                    text-gray-900 outline-1 -outline-offset-1 
                    outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 
                    focus:outline-indigo-600 sm:text-sm/6">

                    @if($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </div>
            </div>

            <div>
                <button type="submit" 
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold 
                text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Sign in
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            Don't have an account?
            <a href="{{route("register")}}" class="font-semibold text-indigo-600 hover:text-indigo-500">Create one now</a>
        </p>
    </div>
</div>


@endsection