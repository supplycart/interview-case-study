<template>
    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden pb-4">
        <div class="flex items-end justify-end h-56 w-full bg-cover"
             style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
        </div>
        <div class="flex flex-col px-5 py-3">
            <h3 class="text-gray-700 text-lg font-medium">{{ product.title | limitWords }}</h3>
            <span>{{product.brand.name}}</span>
            <span class="text-gray-700 text-sm">{{product.category.name}}</span>
            <span class="text-black text-xl font-semibold mt-2">RM {{ product.price.price.toFixed(2) }}</span>
        </div>
        <div v-if="product.stock > 0" class="flex">
            <div class="flex custom-number-input h-10 w-6/12 ml-2">
                <!--                <quantity-counter :product="product" @update-amount="updateAmount"/>-->
                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                    <button @click="amount--" data-action="decrement"
                            class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                        <span class="m-auto text-2xl font-thin">−</span>
                    </button>
                    <input type="number"
                           @keyup.enter="addToCart"
                           v-model.number="amount"
                           class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                           name="custom-input-number"/>
                    <button @click="amount++" data-action="increment"
                            class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                        <span class="m-auto text-2xl font-thin">+</span>
                    </button>
                </div>
            </div>
            <div class="flex ml-5">
                <primary-button @click="addToCart">
                    Add to cart
                </primary-button>
            </div>

        </div>
        <div v-else class="pl-4">
            <span class="font-bold text-red-800">Currently unavailable</span>
        </div>
        <div v-if="amountInCart !== 0" class="flex justify-center pt-2">
            <span class="font-bold mr-2">{{ amountInCart }}</span> <span>in cart</span>
        </div>

    </div>

</template>

<script>
import Spinner from 'vue-simple-spinner'
import QuantityCounter from "../core/QuantityCounter";
import {mapGetters} from "vuex";
import PrimaryButton from "../core/buttons/PrimaryButton";

export default {
    props: {
        product: Object,
        default: () => {
            return {
                price: 10,
                title: ''
            }
        }
    },
    components: {
        PrimaryButton,
        QuantityCounter,
        Spinner
    },
    watch: {
        amount(val) {
            if(this.amount === '') return;
            if (this.amount <= 0) this.amount = 1;
        }
    },
    name: "Product",
    computed: {
        ...mapGetters(
            'cart', [
                'cart'
            ]
        ),
        amountInCart() {
            const item = this.cart.find(x => x.product.id === this.product.id);
            if (item !== undefined) return item.amount;
            return 0;
        }
    },
    data() {
        return {
            amount: 1,
            loading: false
        }
    },
    methods: {
        async addToCart() {
            this.loading = true;

            let product = this.cart.find(x => x.product.id === this.product.id && x.price.id === this.product.price.id);

            // if product already in cart then update it
            if (product !== undefined) {
                await this.$store.dispatch('cart/updateProduct', {
                    id: product.id,
                    product_id: this.product.id,
                    amount: this.amount + product.amount,
                    product_prices_id: this.product.price.id
                })
            } else {
                await this.$store.dispatch('cart/addProduct', {
                    product_id: this.product.id,
                    amount: this.amount,
                    product_prices_id: this.product.price.id
                })
            }


            await this.$store.dispatch('cart/fetchAddedProducts');

            this.$store.commit('notification/notification', {
                message: 'Product added'
            })

            this.loading = false;
        }
    }
}
</script>

<style scoped>

</style>
