@extends('layouts.app')
@section('header')
    <base-header title="Checkout"></base-header>
@endsection

@section('content')
<div class="mx-auto w-full py-6">
    <div class="flex-row">
        <div class="flex">
            @if (Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
            @endif
        </div>
    </div>
    <form action="{{ route('place.order') }}" method="POST">
    @csrf
        <div class="grid grid-cols-4 gap-6">
            <div class="col-span-3 shadow sm:rounded-md sm:overflow-hidden">
                <div class="py-3 px-4 bg-gray-400">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Billing Details</h3>
                </div>
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                            <input type="text" name="first_name" id="first_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border border-gray-400 py-1 px-2">
                            @error('first_name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                            <input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border border-gray-400 py-1 px-2">
                            @error('last_name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border border-gray-400 py-1 px-2">
                            @error('address')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" name="city" id="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border border-gray-400 py-1 px-2">
                            @error('city')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <input type="text" name="country" id="country" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md py-1 px-2">
                            @error('country')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="post_code" class="block text-sm font-medium text-gray-700">Post Code</label>
                            <input type="text" name="post_code" id="post_code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border border-gray-400  py-1 px-2">
                            @error('post_code')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border border-gray-400 py-1 px-2">
                            @error('phone_number')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="text" name="email" id="email" value="{{ auth()->user()->email }}" disabled class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md py-1 px-2">
                        </div>
                        <input type="hidden" name="total" value="{{$total}}"/>
                    </div>
                </div>
            </div>
            <div>
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="py-3 px-4 bg-gray-400">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Your Order</h3>
                    </div>
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <span class="text-sm font-medium text-gray-700">Total Cost : </span>
                        <span class="text-sm font-medium text-gray-700 font-bold text-right">${{$total}}</span>
                    </div>
                </div>
                <button type="submit" class="mt-3 w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Place Order
                </button>
            </div>
        </div>
    </form>
</div>
@endsection