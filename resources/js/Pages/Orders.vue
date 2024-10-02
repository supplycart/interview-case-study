<script setup>
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'

import OrdersCard from '@/Components/Common/Orders/OrdersCard.vue'
import { Skeleton } from '@/Components/ui/skeleton'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { useOrderStore } from '@/Stores/orderStore'

// Stores
const orderStore = useOrderStore()

// Store Values
const orders = computed(() => orderStore.orders)
const loading = computed(() => orderStore.loading)
</script>

<template>
    <Head title="Orders" />

    <AuthenticatedLayout>
        <!-- No orders available -->
        <Skeleton v-if="loading" class="h-full w-full rounded-xl" />

        <div
            v-if="orders?.orders?.length === 0"
            class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm"
        >
            <div class="flex flex-col items-center gap-1 text-center">
                <h3 class="text-2xl font-bold tracking-tight">
                    You have no orders
                </h3>
            </div>
        </div>

        <div v-else>
            <OrdersCard :orders="orders" />
        </div>
    </AuthenticatedLayout>
</template>
