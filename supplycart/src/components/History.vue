<template>
    <TopBar />
    <div class="flex ">
        <div class="flex-none w-16 h-16 mx-9 mt-5">
            <div @click="goToMain()" class="mt-8 bg-blue-100 rounded-lg shadow-lg px-1 py-1 hover:bg-blue-200 cursor-pointer">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
            </div>
        </div>

        <div class="border-2 flex-grow bg-gray-100 mx-9 my-5">
            <div class="text-3xl text-center my-3">Order History</div>
            <PastOrders :pastOrders = "pastOrders" />
        </div>
        
        <div class="flex-none w-16 h-16 mx-9 mt-5">
        </div>
  </div>
</template>

<script>
import TopBar from './TopBar.vue'
import PastOrders from './PastOrders.vue'

export default {
    name : "History",
    components: {
        TopBar, PastOrders
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
        this.pastOrders = [
            {
                id: 1,
                products: [
                    {
                        name: "Chair",
                        qty: 2,
                        price: 78
                    },
                    {
                        name: "Table",
                        qty: 1,
                        price: 59
                    }
                ],
                price: 137,
                date: "23/5/2021"
            }
        ]
    }
}
</script>

<style>

</style>