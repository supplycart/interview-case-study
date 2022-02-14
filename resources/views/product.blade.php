<x-app-layout>
    <x-slot name="header"></x-slot>

    <div id="app" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <product
                submit-route="{{ route('add.cart') }}"
                sort-route="{{ route('sort.product') }}"
                :product-data="{{ $product }}"
            ></product>
        </div>
    </div>
</x-app-layout>