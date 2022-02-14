<x-app-layout>
    <x-slot name="header"></x-slot>

    <div id="app" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <cart
                submit-route="{{ route('add.order') }}"
                remove-route="{{ route('remove.cart') }}"
                return-route="{{ route('product') }}"
                :cart-data="{{ $cart }}"
            ></cart>
        </div>
    </div>
</x-app-layout>