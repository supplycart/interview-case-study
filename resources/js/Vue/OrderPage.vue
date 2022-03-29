<template>
    <nav-bar/>
    <div class="flex flex-col items-center max-w-5xl mx-auto relative">
        <div class="w-full text-gray-600 hover:text-gray-500 absolute left-2 top-2">
            <router-link to="/orders">
                <ChevronLeftIcon class="h-5 w-5 inline-block"/>
                Back to Orders
            </router-link>
        </div>
        <h1 class="text-center text-5xl font-bold mt-4">ORDER #{{order_id}}</h1>
        <div v-if="date != ''" class="text-xl mt-1 mb-4">Completed on <span class="font-bold">{{getDate()}}</span> at <span class="font-bold">{{getTime()}}</span></div>
        <div class="px-8 mt-4">
            <order-item v-for="item in items" :key="item.id" :cart="item"/>
            <div v-if="voucher != null" class="w-full px-10 flex flex-row items-center mt-2 text-md">
                <div>
                    <span>Voucher Applied: </span><span class="font-bold">{{ voucher.name }}</span>
                </div>
                <spacer/>
                <div class="font-bold text-2xl">
                    - RM {{ voucher.amount }}
                </div>
            </div>
            <div class="w-full p-10 flex flex-row">
                <spacer/>
                <div class="border-t-2 border-black">
                    <div class="text-3xl font-bold my-2">RM {{getTotal()}}</div>
                </div>
            </div>
        </div>
    </div>
    <information-dialog :is-open="showDialog" :title="'ERROR'" :description="errorMessage" @close="closeDialog()" :error="true"/>
</template>

<script>
import NavBar from "./components/NavBar";
import OrderItem from "./components/OrderItem";
import Spacer from "./components/Spacer";
import {ChevronLeftIcon} from "@heroicons/vue/solid";
import InformationDialog from "./components/InformationDialog";

export default {
    name: "OrderPage",
    components: {InformationDialog, Spacer, OrderItem, NavBar, ChevronLeftIcon},
    data() {
        return {
            order_id: 0,
            items: [],
            total: 0,
            showDialog: false,
            errorMessage: "",
            date: "",
            voucher: null
        }
    },
    methods: {
        async getOrder() {
            await axios.get("/api/order/" + this.order_id)
                .then(res => {
                    this.items = res.data.carts;
                    this.total = res.data.payment;
                    if ('voucher' in res.data) {
                        this.voucher = res.data.voucher;
                    }
                    this.date = res.data.created_at;
                }).catch(e => {
                    this.showDialog = true;
                    if (e.response.status == 404) {
                        this.errorMessage = "Order Not Found!";
                    } else {
                        this.errorMessage = "You are not allowed to view this order!"
                    }
                });
        },
        getTotal() {
            return Number.parseFloat(this.total).toFixed(2);
        },
        closeDialog() {
            this.showDialog = false;
            this.$router.push("/orders")
        },
        getDate() {
            let date = new Date(Date.parse(this.date));
            return `${date.getDate()} / ${date.getMonth()} / ${date.getFullYear()}`;
        },
        getTime() {
            let date = new Date(Date.parse(this.date));
            return `${date.getHours()}:${String(date.getMinutes()).padStart(2, '0')}`;
        }
    },
    created() {
        this.order_id = this.$route.params.order_id;
        this.getOrder();
    }
}
</script>

<style scoped>

</style>
