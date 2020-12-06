<template>
    <div>
        <Title>Shopping Cart</Title>
        <div v-if="!cart.length">
            <span>No item in shopping cart</span>
        </div>
        <div v-else>
            <table>
                <thead>
                <tr>
                    <table-header>
                        <input v-model="clickAllCheckbox" type="checkbox"/>
                        <span>Select All</span>
                    </table-header>
                    <table-header></table-header>
                    <table-header></table-header>
                    <table-header>Price per item</table-header>
                    <table-header>Total for this item</table-header>
                    <table-header></table-header>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in cart" :key="item.id">
                    <table-row>
                        <input v-model="item.selected" type="checkbox"/>
                    </table-row>

                    <table-row>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-20 w-20">
                                <img class="h-20 w-20"
                                     src="https://m.media-amazon.com/images/I/81xPPb+5PPL._AC_AA180_.jpg"
                                     alt="">
                            </div>

                            <div class="ml-4">
                            <span class="text-lg leading-5 text-blue-400">
                                {{ item.product.title }}
                            </span>
                            </div>
                        </div>
                    </table-row>

                    <table-row>
                        <quantity-counter :amount="item.amount" @increment="increment(item)"
                                          @decrement="decrement(item)"/>
                    </table-row>

                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <span
                                                    class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full text-black">
                                                    {{ 'RM ' + item.price.price.toFixed(2) }}</span>
                    </td>

                    <td
                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-black">
                        {{ 'RM ' + (item.price.price * item.amount).toFixed(2) }}
                    </td>

                    <td
                        class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                        <a @click="deleteItem(item.id)" class="text-red-600 hover:text-red-900 hover:cursor-pointer">Delete</a>
                    </td>
                </tr>
                <tr>
                    <table-row></table-row>
                    <table-row></table-row>
                    <table-row></table-row>
                    <table-row>TOTAL PRICE :</table-row>
                    <table-row>
                        <span class="text-xl font-bold">
                            {{ 'RM' + total }}
                        </span>
                    </table-row>
                    <table-row>
                        <button :disabled="!showCheckoutButton"
                                :class="showCheckoutButton ? 'bg-green-600' : 'bg-green-300'" class="px-4 py-2 rounded text-white font-semibold"
                                @click="checkout">Proceed to checkout
                        </button>
                    </table-row>
                </tr>
                </tbody>
            </table>
        </div>


    </div>
</template>

<script>
import Title from "../components/core/Title";
import {mapGetters} from 'vuex'
import TableRow from "../components/core/table/TableRow";
import TableHeader from "../components/core/table/TableHeader";
import QuantityCounter from "../components/core/QuantityCounter";

export default {
    name: "Cart",
    components: {QuantityCounter, TableHeader, TableRow, Title},
    computed: {
        ...mapGetters(
            'cart', [
                'cart', 'total'
            ]
        ),
        showCheckoutButton() {
            return this.cart.filter(x => x.selected === true).length;
        }
    },
    data() {
        return {
            clickAllCheckbox: true
        }
    },
    watch: {
        // input event will return boolean value
        clickAllCheckbox(val) {
            const cart = this.cart.map(x => {
                return {
                    ...x, selected: val
                }
            });

            this.$store.commit('cart/cart', cart);
        }
    },
    methods: {
        increment(instance) {
            instance.amount++;
            this.$store.commit("cart/updateProductInCart", instance);
        },
        decrement(instance) {
            if (instance.amount <= 1) return;
            instance.amount--;
            this.$store.commit("cart/updateProductInCart", instance);
        },
        deleteItem(itemId) {
            this.$store.dispatch('cart/deleteProduct', itemId);
            this.$store.commit('notification/notification', {
                message: 'Item deleted'
            });
        },
        checkout() {
            this.$store.dispatch('cart/orderProducts');
            this.$store.dispatch('cart/fetchAddedProducts');
            this.$router.push({name : 'previousOrders'});
        }
    }
}
</script>

<style scoped>

</style>
