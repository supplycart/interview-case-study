<script setup>
import { computed } from 'vue'

import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import { Table, TableHead, TableHeader, TableRow } from '@/Components/ui/table'
import { useFilterStore } from '@/Stores/filterStore'

import Filters from './Filters/Filters.vue'
import ProductItem from './ProductItem.vue'

// Define Props
const props = defineProps({
    brands: Array,
    categories: Array,
    products: Array,
    quantities: Array,
})

const { brands, categories, products, quantities } = props

// Stores
const filterStore = useFilterStore()

// Store States
const selectedBrand = computed(() => filterStore.selectedBrand)
const selectedCategory = computed(() => filterStore.selectedCategory)

// Filter products based on brand and category
const filteredProducts = computed(() => {
    return products.filter((product) => {
        const matchesCategory =
            selectedCategory.value === 'all' ||
            product.product_category === selectedCategory.value

        const matchesBrand =
            selectedBrand.value === 'all' ||
            product.product_brand === selectedBrand.value

        return matchesCategory && matchesBrand
    })
})
</script>

<template>
    <Card>
        <CardHeader
            class="flex flex-col md:flex-row justify-between gap-4 md:gap-1.5 items-center"
        >
            <div class="flex flex-col gap-2">
                <CardTitle>Products</CardTitle>
                <CardDescription>
                    Here are a list of products that you may add to your cart.
                </CardDescription>
            </div>
            <Filters :brands="brands" :categories="categories" />
        </CardHeader>
        <CardContent>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px] sm:table-cell">
                            <span class="sr-only">img</span>
                        </TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Brand</TableHead>
                        <TableHead>Category</TableHead>
                        <TableHead>Price</TableHead>
                        <TableHead>Quantity</TableHead>
                        <TableHead>
                            <span class="sr-only">Actions</span>
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <ProductItem
                    :filteredProducts="filteredProducts"
                    :quantities="quantities"
                />
            </Table>
        </CardContent>
    </Card>
</template>
