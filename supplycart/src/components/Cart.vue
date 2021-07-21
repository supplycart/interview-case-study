<template>
    <TopBar />
    <div class="flex ">
        <div class="flex-none w-16 h-16 mx-9 mt-5">
            <div @click="goToMain()" class="mt-8 bg-blue-100 rounded-lg shadow-lg px-1 py-1 hover:bg-blue-200 cursor-pointer">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
            </div>
        <!-- This item will not grow -->
    </div>
    <div class="border-2 flex-grow bg-yellow-100 mx-9 my-5">
        <!-- This item will grow -->
        <div class="text-3xl text-center my-3">Current Shopping Cart</div>
        
    </div>
    <div class="flex-none w-16 h-16 mx-9 mt-5">
        <!-- This item will not grow -->
    </div>
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
        }
    },
    data() {
        return {
        pastOrders: [],
        }
    },
    created() {
    }
}
</script>

<style>

</style>