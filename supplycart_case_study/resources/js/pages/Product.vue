<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import ProductCard from '@/components/ProductCard.vue'
import { Head, usePage, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
// import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import type { BreadcrumbItem } from '@/types';

const page = usePage();

const products = computed(() => page.props.products);
const filters = ref({
  search: page.props.filters?.search || '',
  brand_id: page.props.filters?.brand_id || '',
  category_id: page.props.filters?.category_id || '',
});

const brands = computed(() => page.props.brands);
const categories = computed(() => page.props.categories);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

function applyFilters() {
  router.get('/products', filters.value, {
    preserveState: true,
    replace: true,
  })
}

</script>

<template>
    <Head title="Dashboard" />

        <AppLayout :breadcrumbs="breadcrumbs">
            <div class="flex flex-col gap-4 p-4">
            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input
                v-model="filters.search"
                type="text"
                placeholder="Search products..."
                class="input input-bordered w-full"
                @keyup.enter="applyFilters"
                />

                <select
                v-model="filters.brand_id"
                class="select select-bordered"
                @change="applyFilters"
                >
                <option value="">All Brands</option>
                <option
                    v-for="brand in brands"
                    :key="brand.id"
                    :value="brand.id"
                >
                    {{ brand.name }}
                </option>
                </select>

                <select
                v-model="filters.category_id"
                class="select select-bordered"
                @change="applyFilters"
                >
                <option value="">All Categories</option>
                <option
                    v-for="cat in categories"
                    :key="cat.id"
                    :value="cat.id"
                >
                    {{ cat.name }}
                </option>
                </select>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <ProductCard
                v-for="product in products.data"
                :key="product.id"
                :product="product"
                />
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                <nav class="flex gap-2">
                <span
                    v-for="link in products.links"
                    :key="link.label"
                    v-html="link.label"
                    @click="() => link.url && router.visit(link.url)"
                    :class="[
                    'px-3 py-1 rounded cursor-pointer',
                    { 'bg-gray-200 dark:bg-gray-700 font-semibold': link.active },
                    ]"
                />
                </nav>
            </div>
            </div>
        </AppLayout>
</template>
