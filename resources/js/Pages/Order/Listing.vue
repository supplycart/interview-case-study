<template>
    <Head title="My Orders" />

    <component :is="$page.props.auth.user ? AuthenticatedLayout : GuestLayout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Orders</h2>
        </template>
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <ul role="list" class="divide-y divide-gray-100">
                <li v-for="order in orders" :key="order.id" class="flex justify-between gap-x-6 py-5">
                    <div class="flex gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <Link :href="route('orders.show', order.id)">
                                <p class="text-sm font-semibold leading-6 text-gray-900">Order {{ order.id }}</p>
                            </Link>
                        </div>
                    </div>
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-gray-900 capitalize">{{ order.status }}</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Placed At {{ dateFormat(order.created_at) }}
                    </p>
                    </div>
                </li>
            </ul>
        </div>
    </component>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
    orders: {
        type: Array,
        required: true,
    },
});

function dateFormat(date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}

</script>