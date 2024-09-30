<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import axios from 'axios'
import { onMounted, ref } from 'vue'

import { Button } from '@/Components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/Components/ui/number-field'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { toast } from '@/Components/ui/toast'

// Setup reactive products list and user tier
const products = ref([])
const loading = ref(true)
const quantities = ref([])

console.log(quantities.value)

const user = usePage().props.auth.user

// Fetch products from backend
const fetchProducts = async () => {
    try {
        const response = await axios.get(
            '/products/get?user_tier=' + user.user_tier
        )
        products.value = response.data
    } catch (error) {
        console.error('Error fetching products:', error)
    } finally {
        loading.value = false
    }
}

// Add product to cart
const addToCart = async (productId, quantity = 1) => {
    try {
        const response = await axios.post(`/cart/${productId}`, {
            quantity,
        })
        toast('Product added to cart successfully') // Show success message
    } catch (error) {
        console.error('Error adding to cart:', error)
        toast('Failed to add product to cart') // Show error message
    }
}

// Fetch products when component is mounted
onMounted(fetchProducts)
</script>

<template>
    <Head title="Inventory" />

    <AuthenticatedLayout>
        <!-- Loading state -->
        <div v-if="loading" class="text-center">
            <p>Loading products...</p>
        </div>

        <!-- No products available -->
        <div
            v-else-if="products.length === 0"
            class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm"
        >
            <div class="flex flex-col items-center gap-1 text-center">
                <h3 class="text-2xl font-bold tracking-tight">
                    You have no products
                </h3>
                <p class="text-sm text-muted-foreground">
                    You can start selling as soon as you add a product.
                </p>
                <Button class="mt-4"> Add Product </Button>
            </div>
        </div>

        <div v-else>
            <Card>
                <CardHeader>
                    <CardTitle>Products</CardTitle>
                    <CardDescription>
                        Here are a list of products that you may add to your
                        cart.
                    </CardDescription>
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
                            v-for="(product, index) in products"
                            :key="product.id"
                        >
                            <TableRow>
                                <TableCell class="sm:table-cell">
                                    <img
                                        alt="Product image"
                                        class="aspect-square rounded-md object-cover"
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
                                        product.price.currency +
                                        ' ' +
                                        product.price.amount
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
                                        :default-value="1"
                                        :min="1"
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
                                            addToCart(
                                                product.id,
                                                quantities[index]
                                            )
                                        "
                                    >
                                        Add to Cart
                                    </Button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </AuthenticatedLayout>
</template>
