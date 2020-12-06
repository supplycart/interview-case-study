<template>
    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden pb-4">
        <div class="flex items-end justify-end h-56 w-full bg-cover"
             style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
        </div>
        <div class="px-5 py-3">
            <h3 class="text-gray-700 text-lg font-medium">{{ product.title | limitWords }}</h3>
            <span class="text-black text-xl font-semibold mt-2">RM {{ product.price.price.toFixed(2) }}</span>
        </div>
        <div v-if="product.stock > 0" class="flex">
            <div class="flex custom-number-input h-10 w-6/12 ml-2">
                <quantity-counter :amount="amount"
                                  @increment="amount = amount + 1"
                                  @decrement="amount = amount - 1"/>
            </div>
            <div class="flex ml-5">
                <button @click="addToCart"
                        class="bg-primary text-white bg-green-600 hover:bg-green-500 text-sm py-3 px-4 border border-primary rounded font-bold flex items-center">
                    Add to cart
                </button>
            </div>

        </div>
        <div v-else class="pl-4">
            <span class="font-bold text-red-800">Currently unavailable</span>
        </div>
        <div  v-if="amountInCart !== 0" class="flex justify-center pt-2">
            <span>
                {{ amountInCart }} in cart
            </span>
        </div>

    </div>

</template>

<script>
import Spinner from 'vue-simple-spinner'
import QuantityCounter from "../core/QuantityCounter";

export default {
    props: {
        product: Object,
        default: () => {
            return {
                price: 10,
                title: 'Test'
            }
        }
    },
    components: {
        QuantityCounter,
        Spinner
    },
    name: "Product",
    computed: {
        cart() {
            return this.$store.getters['cart/cart'];
        },
        amountInCart() {
            const item = this.$store.getters['cart/cart'].find(x => x.product.id === this.product.id);
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
