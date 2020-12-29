<template>
    <layout>
        <div class="w-full">
            <loader v-if="loading"></loader>
            <div v-if="cartItem.length !== 0 && !loading">
                <button class="mx-6 my-4 focus:outline-none" @click="$router.go(-1)">
                    &larr; Back
                </button>
                <div class="flex flex-col items-center">
                    <div class="text-4xl mb-4">Shopping Cart</div>
                    <div class="w-8/12 shadow-lg p-2 bg-green-50">
                        <table class="w-full table-fixed">
                            <tr v-for="(item, index) in cartItem" :key="item.id" class="border-green-200 border-b-2">
                                <td class="py-4 pl-4 w-28">
                                    <img class="w-20 h-20 cursor-pointer" :src="item.image" @click="viewProduct(item.id)" />
                                </td> 
                                <td class="w-1/2 cursor-pointer" @click="viewProduct(item.id)">{{ item.name }}</td>
                                <td class="pl-4" style="width:12.5%">RM {{ item.price }}</td>
                                <td class="text-center p-1" style="width:15%">
                                    <div class="flex">
                                        <button class="bg-white w-10 px-2 border border-gray-300 focus:outline-none" @click="reduceQuantity(index)">-</button>
                                        <input class="bg-white w-10 px-2 py-1 border border-gray-300" :value="item.quantity" @input="updateQuantity($event, index)" />
                                        <button class="bg-white w-10 px-2 border border-gray-300 focus:outline-none" @click="addQuantity(index)">+</button>
                                    </div>
                                </td>
                                <td class="p-4">RM {{ (item.price * item.quantity).toFixed(2) }}</td>
                            </tr>
                            <tr>
                                <td colspan=5 class="p-4 text-right">Total: RM {{ totalPrice.toFixed(2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="text-center mt-6">
                    <button class="bg-gray-400 py-2 px-10 text-white mr-4" @click="clearCart">Clear</button>
                    <button class="bg-green-600 py-2 px-10 text-white" @click="checkout">Checkout</button>
                </div>
            </div>
            <div v-if="cartItem.length === 0 && !loading" class="flex justify-center mt-8"> 
                <div class="w-2/5 flex flex-col justify-center">
                    <img class="h-3/4 w-1/2 self-center" src="https://cdn.dribbble.com/users/204955/screenshots/4930541/emptycart.png?compress=1&resize=400x300" alt="">
                    <p class="text-4xl text-center mb-8">Your cart is empty</p>
                    <button class="bg-green-600 py-2 px-10 text-white w-1/2 self-center" @click="$router.push({ path: '/products' })">Add Order Now</button>
                </div>
            </div>
            <div id="snackbar">{{ message }}</div>
        </div>
    </layout>
</template>
<script>
    import { mapState } from 'vuex'
    export default {
        data() {
            return {
                loading: true,
                message: ''
            }
        },
        async mounted() {
            await this.$store.dispatch('fetchCart').then(() => {
                this.loading = false
            })          
        },
        computed: mapState({
            cartItem: state => state.carts,
            totalPrice: state => state.totalPrice,
        }),
        methods: {
            viewProduct(id) {
                router.push({ path: `/products/${id}` })
            },
            async updateQuantity(event, index) {
                event.preventDefault()
                let quantity = parseInt(event.target.value)
                await this.$store.dispatch('updateCartQuantity', {index, quantity})
            },
            async addQuantity(index) {
                await this.$store.dispatch('addCartQuantity', {index: index})
            },
            async reduceQuantity(index) {
                await this.$store.dispatch('reduceCartQuantity', {index: index})
            },
            async clearCart() {
                await this.$store.dispatch('clearCart');
            },
            checkout() {
                let request = {
                    products: this.cartItem,
                    totalPrice: this.totalPrice,
                }

                axios.post('/api/auth/orders', request, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.token}`
                    }
                })
                .then(response => {
                    this.clearCart();
                    this.message = response.data.message
                    let x = document.getElementById("snackbar")
                    x.className = "show";
                    setTimeout(function() { 
                        x.className = x.className.replace("show", "")
                    }, 2000)
                })
                .catch(error => console.log(error))
            }
        }
    }
</script>
<style scoped>
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: rgb(20, 185, 70);
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }

    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }
    
    @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
</style>