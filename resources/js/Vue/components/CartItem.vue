<template>
    <div class="grid grid-cols-6 p-4 gap-6">
        <img :src="cart.product.picture" class="cart-img col-span-1" :alt="cart.product.name"/>
        <div class="col-span-4 flex flex-col">
            <h4 class="font-bold text-xl">{{cart.product.name}}</h4>
            <div class="text-gray-700 mt-2">{{cart.product.description}}</div>
            <spacer/>
            <div>RM{{ getPrice() }}</div>
        </div>
        <div class="flex flex-row items-center">
            <number-input :value="quantity" @change="change" :min="1"/>
            <button class="ml-1" @click="deleteItem"><XIcon class="text-red-400 w-6 h-6 hover:text-red-800"/></button>
        </div>
    </div>
</template>

<script>
import NumberInput from "./NumberInput";
import Spacer from "./Spacer";
import {XIcon} from "@heroicons/vue/solid";

export default {
    name: "CartItem",
    components: {Spacer, NumberInput, XIcon},
    props: ["cart"],
    emits: ["delete", "change"],
    data() {
        return {
            quantity: 0,
        }
    },
    created() {
        this.quantity = this.cart.quantity;
    },
    methods: {
        deleteItem() {
            this.$emit("delete");
        },
        change(e) {
            if (this.quantity !== e) {
                this.quantity = e;
                this.$emit("change", e);
            }
        },
        getPrice() {
            return Number.parseFloat(this.cart.product.price).toFixed(2);
        },
        delete() {
            this.$emit("delete");
        }
    },
}
</script>

<style scoped>
.cart-img {
    width: 100%;
    aspect-ratio: 1;
    object-fit: cover;
    object-position: center;
}
</style>
