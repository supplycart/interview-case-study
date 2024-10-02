<script setup>
import { computed } from 'vue'

import { Button } from '@/Components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/Components/ui/number-field'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import { useFilterStore } from '@/Stores/filterStore'

import Filters from './Filters/Filters.vue'

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
                <TableBody
                    v-for="(product, index) in filteredProducts"
                    :key="product.id"
                >
                    <TableRow>
                        <TableCell class="sm:table-cell">
                            <img
                                alt="Product image"
                                class="aspect-square rounded-md object-cover min-w-[64px]"
                                height="64"
                                src="https://picsum.photos/100"
                                width="64"
                            />
                        </TableCell>
                        <TableCell class="font-medium">
                            {{ product.product_name }}
                        </TableCell>
                        <TableCell>
                            {{ product.product_brand }}
                        </TableCell>
                        <TableCell>
                            {{ product.product_category }}
                        </TableCell>
                        <TableCell>
                            {{
                                new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: product.price.currency,
                                }).format(product.price.amount)
                            }}
                        </TableCell>
                        <TableCell>
                            {{ product.quantity }}
                        </TableCell>
                        <TableCell
                            class="flex flex-col gap-2 justify-center items-center"
                        >
                            <NumberField
                                :id="'quantity-' + product.id"
                                v-model="quantities[index]"
                                :default-value="product.quantity <= 0 ? 0 : 1"
                                :min="product.quantity <= 0 ? 0 : 1"
                                :max="product.quantity"
                                class="max-w-[110px]"
                            >
                                <NumberFieldContent>
                                    <NumberFieldDecrement />
                                    <NumberFieldInput />
                                    <NumberFieldIncrement />
                                </NumberFieldContent>
                            </NumberField>
                            <Button
                                @click="
                                    addToCart(product.id, quantities[index])
                                "
                                :disabled="product.quantity <= 0"
                            >
                                Add to Cart
                            </Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </CardContent>
    </Card>
</template>
