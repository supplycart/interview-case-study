<template>
    <layout>
        <div class="w-full bg-gray-100">
            <loader v-if="loading"></loader>
            <div v-if="orders.length !== 0 && !loading">
                <button class="mx-6 my-4 focus:outline-none" @click="$router.go(-1)">
                    &larr; Back
                </button>
                <div class="flex flex-col items-center">
                    <div class="text-4xl mb-4">Order History</div>
                    <div class="w-3/5 mt-5">
                        <div class="bg-white shadow-lg border-2 border-gray-100 mb-4 p-3" v-for="(order, index) in orders" :key="index">
                            <div class="mb-2">Date: {{ order.created_at }}</div>
                            <table class="table-fixed w-full">
                                <tr class="border-t-2 border-b-2 border-gray-100" v-for="(product, index) in order.products" :key="index">
                                    <td class="w-1/6 p-2">
                                        <img class="w-20 h-20 cursor-pointer" :src="product.image" @click="viewDetails(product.id)" />
                                    </td> 
                                    <td class="w-2/3 cursor-pointer p-2" @click="viewDetails(product.id)">
                                        <div>{{ product.name }}</div>
                                        <div class="text-sm text-gray-500">x {{ product.pivot.quantity }}</div>
                                    </td>
                                    <td class="w-1/6 p-2 text-right" style="width:12.5%">RM {{ product.price.toFixed(2) }}</td>
                                </tr>
                            </table>
                            <div class="text-right mt-2 p-2 flex justify-end items-center">
                                <div>Order Total: &nbsp; </div>
                                <div class="text-2xl text-yellow-500">RM {{ order.total_cost.toFixed(2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center" v-if="orders.length === 0 && !loading">
                <div class="mt-10 w-2/5 flex flex-col justify-center">
                    <img class="h-3/4 mb-4 w-1/2 self-center" src="https://www.keyboor.com/images/no-records.svg" alt="">
                    <button class="bg-green-600 py-2 px-10 text-white w-1/2 self-center" @click="$router.push({ path: '/products' })">Make Order Now</button>
                </div>
            </div>
        </div>
    </layout>
</template>
<script>
    export default {
        data() {
            return {
                orders: [],
                loading: true
            }
        },
        async mounted() {
            await this.$store.dispatch('fetchOrders')
            this.orders = this.$store.state.orders
            this.loading = false
        },
        methods: {
            viewDetails(id) {
                router.push({ path: `/products/${id}` })
            }
        }
    }
</script>