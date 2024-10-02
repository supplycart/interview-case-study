<script setup>
import { computed } from 'vue'

import addToCart from '@/API/addToCart'
import { Button } from '@/Components/ui/button'
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/Components/ui/number-field'
import { TableBody, TableCell, TableRow } from '@/Components/ui/table'

// Define Props
const props = defineProps({
    filteredProducts: Array,
    quantities: Array,
})

const { quantities } = props

const filteredProducts = computed(() => props.filteredProducts)
</script>

<template>
    <TableBody v-for="(product, index) in filteredProducts" :key="product.id">
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
            <TableCell class="flex flex-col gap-2 justify-center items-center">
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
                    @click="addToCart(product.id, quantities[index])"
                    :disabled="product.quantity <= 0"
                >
                    Add to Cart
                </Button>
            </TableCell>
        </TableRow>
    </TableBody>
</template>
