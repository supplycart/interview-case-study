<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import axios from 'axios'
import { computed, onMounted, ref } from 'vue'

import { Button } from '@/Components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import { Label } from '@/Components/ui/label'
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/Components/ui/number-field'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import { useToast } from '@/Components/ui/toast/use-toast'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { useCartStore } from '@/Stores/cartStore'

// Setup reactive products list and user tier
const products = ref([])
const loading = ref(true)
const quantities = ref([])
const categories = ref([])
const brands = ref([])
const selectedCategory = ref('all')
const selectedBrand = ref('all')

const cartStore = useCartStore()
const user = usePage().props.auth.user

const { toast } = useToast()

// Fetch products from backend
const fetchProducts = async () => {
    try {
        const response = await axios.get(
            '/products/get?user_tier=' + user.user_tier
        )
        products.value = response.data
        quantities.value = products.value.map((product) =>
            product.quantity <= 0 ? 0 : 1
        )

        const uniqueCategories = [
            ...new Set(
                products.value.map((product) => product.product_category)
            ),
        ]
        categories.value = uniqueCategories

        const uniqueBrands = [
            ...new Set(products.value.map((product) => product.product_brand)),
        ]
        brands.value = uniqueBrands
    } catch (error) {
        toast({
            title: 'There was an issue when trying to fetch the products.',
            variant: 'destructive',
        })
    } finally {
        loading.value = false
    }
}

// Fetch cart from backend
const fetchCart = async () => {
    try {
        const response = await axios.get('/cart/')
        cartStore.setCart(response.data)
    } catch (error) {
        toast({
            title: 'There was an issue when trying to fetch the cart.',
            variant: 'destructive',
        })
    }
}

// Add product to cart
const addToCart = async (productId, quantity = 1) => {
    try {
        const response = await axios.post(`/cart/add/${productId}`, {
            quantity: quantity || 1,
        })
        toast({
            title: 'Product added to cart successfully',
        })
    } catch (error) {
        toast({
            title: 'Failed to add product to cart',
            variant: 'destructive',
        })
    } finally {
        fetchCart()
    }
}

// Filter products based on category and brand
const filteredProducts = computed(() => {
    return products.value.filter((product) => {
        const matchesCategory =
            selectedCategory.value === 'all' ||
            product.product_category === selectedCategory.value

        const matchesBrand =
            selectedBrand.value === 'all' ||
            product.product_brand === selectedBrand.value

        return matchesCategory && matchesBrand
    })
})

// Fetch products and cart when component is mounted
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
            </div>
        </div>

        <div v-else>
            <Card>
                <CardHeader
                    class="flex flex-col md:flex-row justify-between gap-4 md:gap-1.5 items-center"
                >
                    <div class="flex flex-col gap-2">
                        <CardTitle>Products</CardTitle>
                        <CardDescription>
                            Here are a list of products that you may add to your
                            cart.
                        </CardDescription>
                    </div>
                    <div class="flex flex-row gap-4">
                        <div class="flex flex-col gap-2">
                            <Label>Category</Label>
                            <Select v-model="selectedCategory">
                                <SelectTrigger>
                                    <SelectValue
                                        placeholder="Filter by Category"
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Categories</SelectLabel>
                                        <SelectItem value="all">
                                            All Categories
                                        </SelectItem>
                                        <SelectItem
                                            v-for="category in categories"
                                            :key="category"
                                            :value="category"
                                        >
                                            {{ category }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                        </div>

                        <div class="flex flex-col gap-2">
                            <Label>Brand</Label>
                            <Select v-model="selectedBrand">
                                <SelectTrigger>
                                    <SelectValue
                                        placeholder="Filter by Brand"
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Brands</SelectLabel>
                                        <SelectItem value="all">
                                            All Brands
                                        </SelectItem>
                                        <SelectItem
                                            v-for="brand in brands"
                                            :key="brand"
                                            :value="brand"
                                        >
                                            {{ brand }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                        </div>
                    </div>
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
                                        :default-value="
                                            product.quantity <= 0 ? 0 : 1
                                        "
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
                                            addToCart(
                                                product.id,
                                                quantities[index]
                                            )
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
        </div>
    </AuthenticatedLayout>
</template>
