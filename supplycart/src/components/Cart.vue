<template>
    <TopBar />
    <div class="flex ">
        <div class="flex-none w-16 h-16 mx-9 mt-5">
            <div @click="goToMain()" class="mt-8 bg-blue-100 rounded-lg shadow-lg px-1 py-1 hover:bg-blue-200 cursor-pointer">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
            </div>
        </div>

        <div class="border-2 flex-grow bg-yellow-100 mx-9 my-5">
            <div class="text-3xl text-center my-3">Current Shopping Cart</div>
            <div class = "p-5 m-5 product bg-white shadow-md rounded-lg item ">
                <ol class="list-decimal pl-3 text-lg">
                    <li v-for="product in products" 
                        :key="product.id">
                        {{product.name}} 
                        <i @click="removeFromCart(product)" class="fa fa-trash mx-5 text-sm hover:text-gray-500 cursor-pointer" aria-hidden="true"></i>
                    </li>
                </ol>
                <div class="text-right">
                    <span class="text-xl mr-3">Total: {{total}}</span>
                    <button @click="checkout()" class="mt-8 bg-yellow-200 rounded-lg shadow-lg px-4 py-1 hover:bg-yellow-300">Checkout</button>
                </div>
            </div>
        </div>

        <div class="flex-none w-16 h-16 mx-9 mt-5"></div>
    </div>
</template>

<script>
import TopBar from './TopBar.vue'

export default {
    name : "Cart",
    components: {
        TopBar
    },
    methods: {
        goToMain(){
            this.$router.push({name:'Main'})
            console.log("switch to main success")
        },
        removeFromCart(product){
            this.$store.commit("removeFromCart", product)
            console.log("remove product from cart")
        },
        checkout(){
            if (this.$store.getters.getTotalPrice === 0)
                alert("Nothing to checkout")

            console.log("checkout clicked")
        }
    },
    data() {
        return {
        }
    },
    created() {
    },
    computed: {
        products(){
            return this.$store.getters.getProducts;
        },
        total(){
            return this.$store.getters.getTotalPrice;
        }
    }
}
</script>

<style>

</style>