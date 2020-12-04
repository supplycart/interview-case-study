@extends('site.app')
@section('title', 'Checkout')
@section('content')
<div class="leading-loose">
    @include('site.partials.flash')
    <form action="{{ route('checkout.place.order') }}" method="POST" role="form" class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
        @csrf
        <p class="text-gray-800 font-medium">Customer information</p>
        <div class="">
            <label class="block text-sm text-gray-00" for="first_name">First Name</label>
            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="first_name" name="first_name" type="text" required="" placeholder="Your Name" aria-label="first_name">
        </div>
        <div class="">
            <label class="block text-sm text-gray-00" for="last_name">Last Name</label>
            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="last_name" name="last_name" type="text" required="" placeholder="Your Name" aria-label="last_name">
        </div>
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="email">Email</label>
            <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" required="" placeholder="Your Email" aria-label="Email" value="{{ auth()->user()->email }}" disabled>
        </div>
        <div class="mt-2">
            <label class=" block text-sm text-gray-600" for="address">Address</label>
            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="address" name="address" type="text" required="" placeholder="address" aria-label="address">
        </div>
        <div class="mt-2">
            <label class="hidden text-sm block text-gray-600" for="city">City</label>
            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="city" name="city" type="text" required="" placeholder="City" aria-label="city">
        </div>
        <div class="inline-block mt-2 w-1/2 pr-1">
            <label class="hidden block text-sm text-gray-600" for="country">Country</label>
            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="country" name="country" type="text" required="" placeholder="Country" aria-label="country">
        </div>
        <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
            <label class="hidden block text-sm text-gray-600" for="post_code">postcode</label>
            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="post_code"  name="post_code" type="text" required="" placeholder="postcode" aria-label="postcode">
        </div>
        <div class="inline-block mt-2 w-1/2 pr-1">
            <label class="hidden block text-sm text-gray-600" for="phone_number">Phone Number</label>
            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="phone_number" name="phone_number" type="text" required="" placeholder="Phone number" aria-label="phone_number">
        </div>
        <div class="inline-block mt-2 w-full pr-1">
            <label for="notes">Order Notes</label>
            <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" name="notes"></textarea>
        </div>
        <div class="mt-4">
            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">RM{{ \Cart::getSubTotal() }}</button>
        </div>
    </form>
</div>
@endsection