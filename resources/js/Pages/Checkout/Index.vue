<script setup>
import { Link, usePage, Head, router } from '@inertiajs/vue3'
import { reactive } from 'vue'
import { useFormat } from '@/composables/format'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { toast } from 'vue3-toastify';

const props = defineProps({
    cart: Object,
})

console.log(props.cart)

const { name, email } = reactive(usePage().props.auth.user)

const { formatMoney } = useFormat()

const itemId = (id) => props.cart.items.findIndex((item) => item.good_id === id)

const confirmOrder = async () => {
    // try {
    //     await form.transform((data) => ({
    //         ...data,
    //         items: props.cart.items,
    //         goods_cost: props.cart.total,
    //     })).post(route('checkout.store'))
    //     toast.success('Order confirmed!')
    // }
    // catch (error) {
    //     console.log(error)
    //     toast.error('Failed to confirm order.')
    // }
    try {
        await router.post(route('checkout.store', { items: props.cart.items, goods_cost: props.cart.total, total_cost: props.cart.total }))
        toast.success('Order confirmed!')
    } catch (error) {
        console.log(error)
        toast.error('Failed to confirm order.')
    }
}
</script>

<template>
    <Head title="Checkout" />

    <AuthenticatedLayout title="Checkout">
        <div class="px-4 py-12 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold dark:text-white">Checkout</h1>
            <div class="flex flex-col justify-between lg:flex-row lg:space-x-10">
                <div class="mt-10 flex flex-col space-y-6 lg:basis-3/4">
                    <div class="flex flex-col">
                        <div class="flex space-x-4">
                            <span
                                class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-purple-500 font-semibold text-purple-200 dark:bg-purple-700 dark:text-purple-200">
                                1
                            </span>
                            <p class="text-gray-700 dark:text-gray-400">Your contact details</p>
                        </div>
                        <p class="mt-4 pl-10 text-sm text-gray-500 dark:text-gray-300">
                            {{ `${name}, ${email}` }}
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex space-x-4">
                            <span
                                class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-purple-500 font-semibold text-purple-200 dark:bg-purple-700 dark:text-purple-200">
                                2
                            </span>
                            <p class="text-gray-700 dark:text-gray-400">Product items</p>
                        </div>

                        <div class="relative mt-4 overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                                <thead class="text-xs uppercase text-gray-900 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Item</th>
                                        <th scope="col" class="px-6 py-3 text-center">Price</th>
                                        <th scope="col" class="px-6 py-3 text-center">Quantity</th>
                                        <th scope="col" class="px-6 py-3 text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white dark:bg-gray-800" v-for="good in cart.goods" :key="good.id">
                                        <th scope="row"
                                            class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <Link :href="route('goods.good.general', good.id)" :title="good.title"
                                                class="flex items-center space-x-4">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/150"
                                                :alt="good.title" :title="good.title" />
                                            <span class="text-sm text-gray-900 dark:text-gray-200">
                                                {{ good.title }}
                                            </span>
                                            </Link>
                                        </th>
                                        <td class="px-6 py-4 text-center">
                                            <p class="whitespace-nowrap font-medium" :class="good.old_price ? 'text-red-600 dark:text-red-500' : 'text-gray-800 dark:text-gray-400'
                                                ">
                                                {{ formatMoney(good.price) }}
                                            </p>
                                            <p v-if="good.old_price"
                                                class="text-xs leading-4 text-gray-400 line-through">
                                                {{ formatMoney(good.old_price) }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-400">
                                            <span>{{ cart.items[itemId(good.id)].quantity }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-400">
                                            <span>{{ formatMoney(good.price * cart.items[itemId(good.id)].quantity)
                                                }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div
                    class="mt-10 flex max-h-80 w-full flex-col rounded-lg border border-gray-200 bg-white p-4 shadow dark:border-gray-700 dark:bg-gray-800 lg:max-w-xs">
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Total</h5>
                    <div class="mt-4 flex justify-between text-sm">
                        <p class="text-gray-900 dark:text-gray-300">{{ cart.count }} products for the amount</p>
                        <p class="text-gray-900 dark:text-gray-300">{{ formatMoney(cart.total) }}</p>
                    </div>
                    <div class="flex-grow"></div>
                    <primary-button class="mt-auto w-full" @click.prevent="confirmOrder">Confirm order</primary-button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
