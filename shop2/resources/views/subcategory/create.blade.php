@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="flex justify-between font-semibold bg-blue-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <p class="flex text-xl py-2 px-4">{{ Auth::user()->name }} Dashboard</p>
                <form class="flex inline-block justify-end" action="{{ route('admin') }}">
                    @csrf
                    <button class="text-sm py-2 px-4 leading-none border rounded text-gray-800 border-gray-800 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0" type="submit">Back</button>
                </form>
            </header>

            <div class="flex flex-col p-2">
                <p class="text-gray-700 mb-5 text-xl">
                    Add new Subcategory!
                </p>
                <form action="{{route('subcategory.store')}}" method="POST">
                    @csrf
                    <div>
                        <label for="selectCategory" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Select Category</label>
                        <select name="category_id" id="selectCategory" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline mb-5">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->categoryname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="productsubcategory" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Subcategory Name</label>
                    <input type="text" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Category Name" name="productsubcategory">
                    <button type="submit" class="px-4 py-2 text-center bg-blue-500 hover:bg-blue-700 text-white font-bold rounded w-full">Submit new subcategory</button>
                    @error('productsubcategory')
                        <div class="text-red-800">
                            {{$message}}
                        </div>
                    @enderror
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
