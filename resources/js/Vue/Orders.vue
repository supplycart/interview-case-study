<template>
    <nav-bar/>
    <div class="flex flex-col items-center max-w-5xl mx-auto relative">
        <h1 class="text-center text-5xl font-bold my-4">My Orders</h1>
        <div class="px-8 mt-4">
            <order-index-item v-for="order in orders" :order="order" :key="order.id"/>
            <h2 class="text-5xl text-gray-400 px-4 text-center font-bold my-4" v-if="orders.length === 0">
                Nothing here, head to the cart and make some orders!
            </h2>
        </div>
    </div>
</template>

<script>
import NavBar from "./components/NavBar";
import OrderIndexItem from "./components/OrderIndexItem";
export default {
    name: "Orders",
    components: {OrderIndexItem, NavBar},
    data() {
        return {
            orders: []
        }
    },
    methods: {
        async getOrders() {
            await axios.get("/api/orders").then(res => {
                this.orders = res.data;
                this.orders.sort((a, b) => {
                    return b.id - a.id
                })
            })
        }
    },
    created() {
        this.getOrders();
    }
}
</script>

<style scoped>

</style>
