<x-app-layout>
    <x-slot name="header"></x-slot>

    <div id="app" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <trail
                return-route="{{ route('product') }}"
                :trail-data="{{ $trail }}"
            ></trail>
        </div>
    </div>
</x-app-layout>