<template>
    <div class="grid grid-cols-6 p-4 gap-6">
        <img :src="cart.product.picture" class="cart-img col-span-1" :alt="cart.product.name"/>
        <div class="col-span-4 flex flex-col">
            <h4 class="font-bold text-2xl">{{cart.product.name}}</h4>
            <div class="text-gray-700 mt-2">{{cart.product.description}}</div>
            <spacer/>
            <div class="text-xl font-bold my-2">RM {{ getPrice() }}</div>
        </div>
        <div class="flex flex-col justify-center">
            <div class="text-xl">×{{cart.quantity}}</div>
            <div class="text-lg mt-6 font-bold">RM {{cart.quantity * cart.product.price}}</div>
        </div>
    </div>
</template>

<script>
import Spacer from "./Spacer";
export default {
    name: "OrderItem",
    components: {Spacer},
    props: ["cart"],
    methods: {
        getPrice() {
            return Number.parseFloat(this.cart.product.price).toFixed(2);
        },
    }
}
</script>

<style scoped>

</style>
