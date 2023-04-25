<template>
    <Head :title="`Order ${order.id}`" />

    <component :is="$page.props.auth.user ? AuthenticatedLayout : GuestLayout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Orders</h2>
        </template>
        <nav aria-label="Breadcrumb">
            <ol role="list" class="mt-5 mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <li>
                    <div class="flex items-center">
                        <Link :href="route('orders.index')">
                            <a class="mr-2 text-sm font-medium text-gray-900">My Orders</a>
                        </Link>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300"><path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z"></path></svg>
                    </div>
                </li>
                <li class="text-sm"><a aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">Order {{ order.id }}</a></li>
            </ol>
        </nav>
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="bg-gray-200 p-5 rounded my-5">
                <div class="flex gap-4">
                    <p class="text-base font-semibold text-gray-900">
                        Placed at: <br/>
                        {{ dateFormat(order.created_at) }}
                    </p>

                    <p class="text-base font-semibold text-gray-900 capitalize">
                        Status: <br/>
                        {{ order.status }}
                    </p>
                </div>
            </div>

            <h2 class="text-base font-semibold leading-7 text-gray-900 mb-5">Items</h2>
            <ul role="list" class="my-6 divide-y divide-gray-200">
                <li v-for="item in items" :key="item.id" class="flex py-6 border-b">
                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img :src="item.image" :alt="item.name" class="h-full w-full object-cover object-center" />
                    </div>

                    <div class="ml-4 flex flex-1 flex-col">
                        <div>
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <h3>
                                <a :href="item.product?.href">{{ item.name }}</a>
                                </h3>
                                <p class="ml-4">${{ item.price }}</p>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">{{ item.color }}</p>
                        </div>
                        <div class="flex flex-1 items-end justify-between text-sm">
                            <p class="text-gray-500">Qty {{ item.quantity }}</p>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="flex justify-between text-base font-medium text-gray-900">
                <p>Subtotal</p>
                <p>$214</p>
            </div>

        </div>
    </component>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
    order: {
        type: Object,
        required: true,
    },
    items: {
        type: Array,
        required: true,
    },
})

function dateFormat(date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}

</script>