<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import { computed, onMounted } from 'vue'

import getProducts from '@/API/getProducts'
import DashboardCard from '@/Components/Common/Dashboard/DashboardCard.vue'
import { Skeleton } from '@/Components/ui/skeleton'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { useProductsStore } from '@/Stores/productStore'

// Local States
const { user_tier } = usePage().props.auth.user

// Stores
const productsStore = useProductsStore()

// Store Values
const products = computed(() => productsStore.products)
const brands = computed(() => productsStore.brands)
const categories = computed(() => productsStore.categories)
const quantities = computed(() => productsStore.quantities)
const loading = computed(() => productsStore.loading)

// Fetch products when component is mounted
onMounted(() => getProducts(user_tier))
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <Skeleton v-if="loading" class="h-full w-full rounded-xl" />

        <div
            v-else-if="products.length === 0"
            class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm"
        >
            <div class="flex flex-col items-center gap-1 text-center">
                <h3 class="text-2xl font-bold tracking-tight">
                    There are no products
                </h3>
            </div>
        </div>

        <div v-else>
            <DashboardCard
                :brands="brands"
                :categories="categories"
                :products="products"
                :quantities="quantities"
            />
        </div>
    </AuthenticatedLayout>
</template>
