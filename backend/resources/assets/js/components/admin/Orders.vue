<template>
    <div class="flex flex-col max-w-full overflow-x-hidden shadow-md">
        <table class="overflow-x-auto w-full bg-white">
            <thead class="bg-blue-100 border-b border-gray-300">
                <tr>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Order Id
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Product
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Quantity
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Cost
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Delivery Address
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Is Delivered?
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
                <tr v-for="(order, index) in orders" :key="index">
                    <td class="p-4 whitespace-nowrap">
                        {{ index + 1 }}
                    </td>
                    <td
                        class="p-4 whitespace-nowrap"
                        v-html="order.product.name"
                    ></td>
                    <td class="p-4 whitespace-nowrap">
                        {{ order.quantity }}
                    </td>
                    <td class="p-4 whitespace-nowrap">
                        {{ order.quantity * order.product.price }}
                    </td>
                    <td class="p-4 whitespace-nowrap">
                        {{ order.address }}
                    </td>
                    <td class="p-4 whitespace-nowrap">
                        {{ order.is_delivered == 1 ? "Yes" : "No" }}
                    </td>
                    <td
                        class="p-4 whitespace-nowrap"
                        v-if="order.is_delivered == 0"
                    >
                        <button
                            class="bg-green-100 text-green-800 text-xs font-semibold px-4 py-2 rounded-md border-0"
                            @click="deliver(index)"
                        >
                            Deliver
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            orders: [],
        };
    },
    beforeMount() {
        axios
            .get("/api/orders/")
            .then((response) => (this.orders = response.data));
    },
    methods: {
        deliver(index) {
            let order = this.orders[index];
            axios.patch(`/api/orders/${order.id}/deliver`).then((response) => {
                this.orders[index].is_delivered = 1;
                this.$forceUpdate();
            });
        },
    },
};
</script>
