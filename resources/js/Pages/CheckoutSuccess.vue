<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

import {useCartStore} from '@/store/Cart'
import {storeToRefs} from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)

// Clear cart items
onMounted(() => {
    cart.value=[]
})
</script>

<template>
    <!-- Page Title -->
    <Head title="Checkout Success" />

    <!-- Authenticated Layout -->
    <AuthenticatedLayout>
        <!-- Main Content -->
        <div class="p-4 mt-10 mx-auto font-extrabold grid gap-4 justify-center">
            <!-- Success Message -->
            <div class="text-center w-full items-center">Checkout Success!</div>

            <!-- Back to Home Link -->
            <div class="text-center w-full items-center">
                <!-- Link to the dashboard -->
                <Link
                    :href="route('dashboard')"  
                    class="border-[1px] hover:bg-[#9f3f52] rounded-sm border-[#80041c] p-1 px-3 bg-[#80041c] text-white font-bold cursor-pointer">
                    Back to Home
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
