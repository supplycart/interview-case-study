<script setup lang="ts">
import {
    Head,
    Link,
    useForm
} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import {
    Product
} from '../../types';

import Dropdown from '@/Components/Dropdown.vue';
import Pagination from '@/Components/Pagination.vue';
import {
    computed,
    onMounted,
    reactive,
    ref
} from 'vue';


import Filters from '@/Components/Filters.vue';
import { initDropdowns } from 'flowbite';
import qs from 'qs';
import {
    useFormat
} from '../../composables/format';

const props = defineProps({
    title: String,
    category: Object,
    brands: Object,
    properties: Object,
    prices: Object,
    goods: Object
})

const {
    formatMoney
} = useFormat()

onMounted(() => {
    initDropdowns()
    if (props.goods?.data) {
        const queries = qs.parse(window.location.search.substring(1))
        filters.brands = Array.isArray(queries?.brands) ? queries.brands.map((brand) => Number.parseInt(brand as string)) : []
            ;[rangePrices.min, rangePrices.max] = [props.prices?.min, props.prices?.max]
        filters.prices = queries?.prices ? Object.values(queries.prices).map((value) => Number.parseInt(value as string)) : Object.values(rangePrices)
        queries.properties ? filters.properties.push(...(queries.properties as string[])) : null
        sort.value = queries?.sort as string
    }
})

const cart = ref<Product[]>([])
const orders = ref<{
    id: number; items: Product[]; total: number
}[]>([])
const showOrderDialog = ref(false)

const cartTotal = computed(() => {
    return cart.value.reduce((total, item: Product) => {
        const itemTotal = item.price * 1;
        return total + itemTotal;
    }, 0.00);
});

const filters = useForm({
    brands: [] as number[],
    prices: [0, 100000] as number[],
    properties: [] as string[]
})

const rangePrices = reactive({
    min: 0,
    max: 100000
})

const formRoute = computed(() => (route('goods.index', props.category)))

const brandFilter = (brand: number) => {
    const brandIndex = filters.brands.indexOf(brand)
    brandIndex === -1 ? filters.brands.push(brand) : filters.brands.splice(brandIndex, 1)
    filters
        .transform((data) => ({
            ...data,
            prices: {
                from: filters.prices[0],
                to: filters.prices[1]
            },
            sort: sort.value,
        }))
        .get(formRoute.value)
}

const priceFilter = () => {
    filters
        .transform((data) => ({
            ...data,
            prices: {
                from: filters.prices[0],
                to: filters.prices[1]
            },
            sort: sort.value,
        }))
        .get(formRoute.value)
}

const propertyFilter = (value: string) => {
    filters.properties.push(value)
    filters.get(formRoute.value)
}

const clearFilters = () => {
    filters
        .transform(() => ({
            brands: [],
            prices: {
                from: rangePrices.min,
                to: rangePrices.max
            },
            sort: sort.value,
        }))
        .get(formRoute.value)
}

const sort = ref('rating')

const sortOptions = [
    // {name: 'Best Rating', key: 'rating'},
    {
        name: 'Newest',
        key: 'created_at'
    },
    {
        name: 'Price: Low to High',
        key: 'price'
    },
    {
        name: 'Price: High to Low',
        key: '-price'
    }
]

const goodsSort = (key: any) => {
    filters
        .transform((data) => ({
            ...data,
            prices: {
                from: filters.prices[0],
                to: filters.prices[1]
            },
            sort: key,
        }))
        .get(formRoute.value)
}
</script>

<template>

    <Head title="Goods" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Product List
            </h2>
        </template>

        <section v-if="goods?.data"
            class="bg-gray-100 p-4 text-gray-900 dark:bg-gray-900 dark:text-gray-400 mx-auto">
            <div class="overflow-hidden bg-white px-4 shadow-sm dark:bg-gray-800 sm:rounded-lg sm:px-6 lg:px-8">
                <div
                    class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-5 dark:border-gray-600">
                    <div class="flex items-center">
                        <!-- <filters-drawer
                            v-if="goods.data.length"
                            :brands="brands"
                            :properties="properties"
                            :filters="filters"
                            :range-prices="rangePrices"
                            @brand-filter="brandFilter"
                            @price-filter="priceFilter"
                            @property-filter="propertyFilter"
                        /> -->
                        <h6 v-if="goods.data.length"
                            class="text mr-2 hidden font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:block">
                            {{ goods.meta.total }} good{{ goods.data.length > 1 ? 's' : '' }} found
                        </h6>

                        <div class="hidden lg:block">
                            <button
                                v-if="filters.brands.length || filters.properties.length"
                                @click="clearFilters"
                                class="mx-1 rounded-full bg-purple-700 px-2 text-center text-sm font-medium text-white hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                            >
                                <span>Clear</span>
                            </button>

                            <template v-for="brand in brands">
                                <button
                                    v-if="filters.brands?.includes(brand.id)"
                                    :key="brand.id"
                                    @click.prevent="brandFilter(brand.id)"
                                    class="mx-1 rounded-full bg-purple-100 px-2.5 py-0.5 text-xs font-medium text-purple-800 dark:bg-purple-900 dark:text-purple-300"
                                >
                                    <span class="mr-1">{{ brand . name }}</span>
                                    <font-awesome-icon :icon="['fas', 'xmark']" class="ml-1" />
                                </button>
                            </template>

                            <template v-for="(property, i) in properties" :key="i">
                                <template v-for="value in property.values">
                                    <button
                                        v-if="filters.properties?.includes(value)"
                                        :key="value"
                                        class="mx-1 rounded-full bg-purple-100 px-2.5 py-0.5 text-xs font-medium text-purple-800 dark:bg-purple-900 dark:text-purple-300"
                                    >
                                        <span class="mr-1">{{ value }}</span>
                                    </button>
                                </template>
                            </template>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                        Sort

                                        <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                    aria-labelledby="dropdownNavbarButton">
                                    <li v-for="option in sortOptions" :key="option.name" :class="[
                                        'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white',
                                        { 'bg-gray-100 dark:bg-gray-600 dark:text-white': option.key === sort }
                                    ]">
                                        <button @click.prevent="goodsSort(option.key)" class="flex px-4 py-2 text-sm">
                                            <span>{{ option.name }}</span>
                                        </button>
                                    </li>
                                </ul>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <div class="pb-24 pt-6">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <Filters v-if="goods.data.length" :brands="brands?.data" :filters="filters"
                            :properties="properties" :range-prices="rangePrices" @brand-filter="brandFilter"
                            @price-filter="priceFilter" @property-filter="propertyFilter" />

                        <div class="lg:col-span-3">
                            <div class="flex flex-wrap">
                                <div v-for="good in goods.data" :key="good.id"
                                    class="group relative flex w-full flex-col px-4 pb-4 sm:w-1/2 lg:w-1/3 xl:w-1/4 2xl:w-1/5">
                                    <div
                                        class="aspect-h-1 aspect-w-1 min-h-80 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                        <img src="https://via.placeholder.com/150" :alt="good.title"
                                            class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
                                    </div>
                                    <div class="mt-4 flex flex-col">
                                        <h3 class="text-gray-700 dark:text-gray-200">
                                            <Link :href="route('goods.good.general', good)">
                                            <span aria-hidden="true" class="absolute inset-0" />
                                            {{ good.title }}
                                            </Link>
                                        </h3>
                                        <div class="mt-2 flex flex-col">
                                            <p v-if="good.old_price"
                                                class="mt-1 text-sm font-medium text-gray-500 dark:text-gray-300">
                                                <span class="line-through">{{ formatMoney(good.old_price) }}</span>
                                            </p>
                                            <p :class="[
                                                good.old_price ? 'text-red-600 dark:text-rose-600' :
                                                    'text-gray-900 dark:text-gray-300',
                                                'text-2xl font-medium'
                                            ]">
                                                {{ formatMoney(good.price) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <Pagination :links="goods.links" :meta="goods.meta" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
