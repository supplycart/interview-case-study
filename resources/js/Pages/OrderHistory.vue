<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <div class="p-6 bg-white border-b border-gray-200 relative">
                                            <table v-if="orders.length" class="border-collapse w-full">
                                                <thead>
                                                <tr>
                                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border-b hidden lg:table-cell">Order #</th>
                                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border-b hidden lg:table-cell">Created At</th>
                                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border-b hidden lg:table-cell">Sent To</th>
                                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border-b hidden lg:table-cell">Status</th>
                                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border-b hidden lg:table-cell">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <OrderListItem
                                                    v-for="order in orders"
                                                    :key="order.id"
                                                    :order="order"
                                                ></OrderListItem>
                                                </tbody>
                                            </table>
                                            <div v-else class="my-4 mt-6 -mx-2 lg:flex justify-center">
                                                <div class="mt-3 lg:px-2 lg:w-1/3 text-center sm:mt-0 sm:ml-4 sm:text-left">

                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500 text-center">You have not placed any orders!</p>
                                                    </div>
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                        <a
                                                            :href="route('product.index')"
                                                            class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
                                                        >
                                                            <span class="ml-2 mt-5px">Shop now!</span>
                                                        </a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import OrderListItem from '@/Components/Orders/ListItem'

export default {
    components: {
        OrderListItem,
        BreezeAuthenticatedLayout,
    },
    async created() {
        this.read();
    },
    data() {
        return {
            orders: [],
        };
    },
    methods: {
        async read() {
            await axios
                .get(route('api.order.list'))
                .then(response => {
                    this.orders = response.data;
                });
        },
    },
}
</script>
