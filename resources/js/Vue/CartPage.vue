<template>
    <nav-bar/>
    <h1 class="text-center text-5xl font-bold my-4">My Cart</h1>
    <div class="flex flex-col items-center max-w-5xl mx-auto relative">
        <div class="px-8 mt-4">
            <cart-item v-for="(cart, idx) in items" :cart="cart" @change="change($event, idx)"
                       @delete="deleteItem(idx)"/>
            <h2 class="text-5xl text-gray-400 px-4 text-center font-bold my-4" v-if="items.length === 0">
                Nothing here, head to the shop to put some items into your cart!
            </h2>
        </div>
        <div class="w-full px-10 flex flex-row items-center mt-2" v-if="voucher == null">
            <label for="voucher" class="text-right mr-2">Voucher: </label>
            <input class="text-md inline-block max-w-xl px-2 py-1 border-2 border-sky-500" id="voucher"
                   v-model="voucherCode"/>
            <button class="small-button ml-2" :disabled="loading || voucher != null || voucherCode == ''" @click="applyVoucher">
                <span v-if="!loading && voucher == null">APPLY</span>
                <spinner class="fill-blue-500 w-5 h-5" v-else/>
            </button>
        </div>
        <div v-else class="w-full px-10 flex flex-row items-center mt-2 text-md">
            <div>
                <span>Voucher Applied: </span><span class="font-bold">{{ voucher.name }}</span>
            </div>
            <spacer/>
            <div class="font-bold text-2xl">
                - RM {{ voucher.amount }}
            </div>
            <button class="ml-1" @click="voucher = null"><XIcon class="text-red-400 w-6 h-6 hover:text-red-800"/></button>
        </div>
        <div class="w-full p-10 flex flex-row items-start">
            <button class="small-button" :disabled="!changed || items.length === 0" @click="update">Update Cart</button>
            <spacer/>
            <div class="border-t-2 border-black">
                <div class="text-3xl font-bold my-2">RM{{ getTotal() }}</div>
                <button class="button" :disabled="changed || items.length === 0" @click="order">ORDER</button>
            </div>
        </div>
        <loading-overlay v-if="loading"/>
        <information-dialog :is-open="showDialog" title="Order Status"
                            :description="message"
                            :error="!success" @close="close"/>
    </div>

</template>

<script>
import NavBar from "./components/NavBar";
import LoadingOverlay from "./components/LoadingOverlay";
import CartItem from "./components/CartItem";
import Spacer from "./components/Spacer";
import InformationDialog from "./components/InformationDialog";
import Spinner from "./components/Spinner";
import {XIcon} from "@heroicons/vue/solid";

export default {
    name: "CartPage",
    components: {Spinner, InformationDialog, Spacer, CartItem, LoadingOverlay, NavBar, XIcon},
    data() {
        return {
            items: [],
            total: 0,
            changed: false,
            loading: false,
            showDialog: false,
            success: false,
            orderTarget: null,
            voucher: null,
            voucherCode: "",
            message: ""
        }
    },
    created() {
        this.loading = true;
        axios.get("/api/carts").then((res) => {
            this.items = res.data.carts;
            this.total = res.data.total;
            this.loading = false;
        });
    },
    methods: {
        async applyVoucher() {
            this.loading = true;
            await axios.get("/api/voucher/" + this.voucherCode).then((res) => {
                this.voucher = res.data;
                this.success = true;
                this.message = "Voucher applied successfully!"
            }).catch((e) => {
                this.success = false;
                this.message = "Voucher not found!"
            }).finally(() => {
                this.loading = false;
                this.showDialog = true;
            })
        },
        change(e, idx) {
            this.changed = true;
            this.items[idx].quantity = e;
        },
        getTotal() {
            let amount = this.total;
            if (this.voucher != null) {
                amount -= this.voucher.amount;
            }
            return Number.parseFloat(amount).toFixed(2);
        },
        async update() {
            this.loading = true;
            await axios.post("/api/cart/update", {
                carts: this.items,
            }).then(res => {
                this.items = res.data.carts;
                this.total = res.data.total;
                this.changed = false;
            }).catch(e => {
                this.success = false;
                this.showDialog = true;
                this.message = 'Something went wrong, please try again.'
            }).finally(() => {
                this.loading = false;
            });
        },
        async deleteItem(idx) {
            this.loading = true;
            await axios.delete("/api/cart/" + this.items[idx].id)
                .then(res => {
                    this.items = res.data.carts;
                    this.total = res.data.total;
                    this.changed = false;
                }).catch(e => {
                    this.success = false;
                    this.showDialog = true;
                    this.message = 'Something went wrong, please try again.'
                }).finally(() => {
                    this.loading = false;
                });
        },
        getVoucher() {
            if (this.voucher != null) {
                return {
                    voucher_id: this.voucher.id
                }
            } else {
                return {
                };
            }
        },
        async order() {
            this.loading = true;
            await axios.post("/api/order", this.getVoucher()).then(res => {
                this.orderTarget = res.data.id
                this.success = true;
                this.message = 'Ordered successfully! You will be redirected to Order Page now.';
            }).catch(() => {
                this.success = false;
                this.message = 'Something went wrong, please try again.';
            }).finally(() => {
                this.loading = false;
                this.showDialog = true;
            })
        },
        close() {
            this.showDialog = false;
            if (this.success) {
                this.$router.push({name: "order", params: {order_id: this.orderTarget}})
                this.success = false;
            }
        }
    }
}
</script>

<style scoped>

</style>
