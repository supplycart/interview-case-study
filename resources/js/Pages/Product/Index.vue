<template>
    <Head title="Products"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-[100rem] sm:px-6 lg:px-8">
                <div class="grid grid-flow-row-dense auto-rows-max md:grid-cols-4">
                    <div class="mx-2 md:my-0 my-2 md:col-span-1 row-span-1 bg-white rounded-lg md:bg-transparent">
                        <ProductFilter
                            v-for="filter in filters"
                            :items="filter.items"
                            :selectedItems="filter.selectedItems"
                            :filter-name="filter.filterName"
                            :filter-type="filter.filterType"
                        />
                    </div>
                    <div class="mx-2 md:col-span-3 row-span-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 justify-center overflow-hidden bg-white rounded-lg md:rounded-none shadow-sm p-3">
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
