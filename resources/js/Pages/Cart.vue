<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { toRefs, computed } from 'vue';

// Import the cart store and get a reference to the 'cart' state
import { useCartStore } from '@/store/Cart';
import { storeToRefs } from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)

// Define a function to remove a product from the cart
const removeFromCart = (id) => {
    cartStore.removeProductFromCart(id)
}

// Calculate the total price of items in the cart
const total = computed(() => {
    let total = 0
    // Loop through the cart items and sum up their prices
    cart.value.forEach(c => {
        total += c.price
    })
    // Format the total to two decimal places and return it
    if (total > 0) {
        return total.toFixed(2)
    }
    // If the total is not greater than zero, return zero
    return 0
})
</script>

<template>
    <!-- Head component to set the title of the page -->
    <Head title="Cart" />

    <!-- Use the AuthenticatedLayout component for authenticated users -->
    <AuthenticatedLayout>

        <!-- If the cart is empty, display a message -->
        <div v-if="!cart.length" class="text-center font-bold py-20 font-roboto text-[15px]">
            Your Shopping Cart is Empty
        </div>

        <!-- If the cart is not empty, display the cart items -->
        <div v-else class="flex gap-4">
            <!-- Shopping basket container -->
            <div class="w-full bg-white p-4 mt-4">
                <div class="font-roboto font-semibold">Shopping Basket</div>
                <div class="border-b flex justify-between pr-20 mt-10">
                    <div>Product</div>
                    <div>Price</div>
                </div>

                <!-- Loop through cart items and display each product -->
                <div class="flex border-b justify-between pr-10" v-for="product in cart" :key="product.id">

                    <!-- Product details container -->
                    <div class="flex items-center gap-4">
                        <!-- Product image -->
                        <img class="h-[180px] mt-4 mb-4" :src="product.image" alt="Product Image">
                        
                        <!-- Product title -->
                        <div class="text-gray-900 pb-2 -mt-4 font-bold text-[18px] hover:text-[#972A3E] hover:underline">
                            {{ product.title }}
                        </div>
                    </div>
                    
                    <!-- Product price and remove button -->
                    <div class="flex gap-2">
                        <!-- Product price -->
                        <div class="py-10 justify-end">
                            <div class="font-bold pl-20">£{{ product.price }}</div>
                        </div>

                        <!-- Remove product from cart button -->
                        <div @click="removeFromCart(product.id)">
                            <img src="/images/icon/close.png" alt="Remove Product" class="hover:shadow-[rgba(0,0,0,0.24)] cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary container -->
            <div class="bg-white w-[450px] p-4 mt-4 h-48">
                <!-- Summary title -->
                <div class="font-roboto font-semibold">Summary</div>

                <!-- Summary content container with border, padding, and shadow -->
                <div class="border-[1px] p-4 rounded-sm shadow-[rgba(0,0,0,0.24)] mt-10">
                    <!-- Order totals section with a border bottom -->
                    <div class="border-b">
                        <div>Order totals</div>
                    </div>

                    <!-- Subtotal section with flex layout for label and value -->
                    <div class="flex justify-between">
                        <!-- Subtotal label -->
                        <div class="font-extrabold text-[18px] pt-4">
                            Subtotal
                        </div>
                        <!-- Subtotal value -->
                        <div class="font-extrabold text-[18px] pt-4">£{{ total }}</div>
                    </div>

                    <!-- Button for secure checkout -->
                    <div class="w-full flex justify-center mt-5">
                        <!-- Link or button to proceed to checkout -->
                        <Link
                            as="button"
                            :disabled="Number(total) === 0.00"
                            :href="
                            $page.props.auth.user !== null
                                ? route('checkout.index', {
                                    total: total,
                                    items: cart
                                })
                                : route('login')"
                            class="border-[1px] hover:bg-[#9f3f52] rounded-sm border-[#80041c] p-1 px-3 bg-[#80041c] text-white font-bold cursor-pointer"
                        >
                            Secure Checkout
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
