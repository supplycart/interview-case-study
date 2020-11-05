@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">
        <div class="p-5">
            <h3 class="text-center"><strong>Enter your own product here</strong></h3>
        </div>
        <div class="">
            <create-product :categories='{{$categories}}' :subcategories='{{$subcategories}}'></create-product>
        </div>
    </div>
</main>
@endsection


