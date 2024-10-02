<template>
    <Head title="Products"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-flow-row-dense grid-cols-4">
                    <div class="mx-2 col-span-1">
                        <ProductFilter
                            v-for="filter in filters"
                            :items="filter.items"
                            :selectedItems="filter.selectedItems"
                            :filter-name="filter.filterName"
                            :filter-type="filter.filterType"
                        />
                    </div>
                    <div class="mx-2 col-span-3">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 justify-center overflow-hidden bg-white shadow-sm sm:rounded-lg p-3">
                            <ProductCard
                                v-for="product in products.data"
                                :product="product"
                                class="flex-grow p-2 "
                            />
                        </div>
                        <div class="my-4">
                            <Pagination :pagination="products" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import ProductCard from "../../Components/Product/ProductCard.vue";
import {computed} from "vue";
import Pagination from "@/Components/Pagination.vue";
import ProductFilter from "@/Components/Product/ProductFilter.vue";

const props = defineProps({
    search: String,
    products: Object,
    categories: Object,
    selectedCategories: Array,
    brands: Object,
    selectedBrands: Array
});

const filters = computed(() => {
    return {
        search: {
            items: props.search ?? '',
            filterName: 'search',
            filterType: 'text'
        },
        categories: {
            items: props.categories,
            selectedItems: props.selectedCategories,
            filterName: 'categories',
            filterType: 'checkbox'
        },
        brands: {
            items: props.brands,
            selectedItems: props.selectedBrands,
            filterName: 'brands',
            filterType: 'checkbox'
        },
    }
});
</script>
