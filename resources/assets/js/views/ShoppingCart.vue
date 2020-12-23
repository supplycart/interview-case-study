<template>
    <layout>
        <div class="w-full">
            <div class="h-96 flex justify-center" v-if="loading">
                <div id="loader" class="m-6" ></div>
            </div>
            <div id="content" v-if="cartItem.length !== 0 && !loading">
                <button class="mx-6 my-4 focus:outline-none" @click="$router.go(-1)">
                    &larr; Back
                </button>
                <div class="flex flex-col items-center">
                    <div class="text-4xl mb-4">Shopping Cart</div>
                    <div class="w-8/12 shadow-lg p-2 bg-green-50">
                        <table class="w-full table-fixed">
                            <tr v-for="(item, index) in cartItem" :key="item.id" class="border-green-200 border-b-2">
                                <td class="py-4 pl-4 w-28">
                                    <img style="width:80px;height:80px" :src="`/storage/product/${item.image}`">
                                </td> 
                                <td class="w-1/2">{{ item.name }}</td>
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
            <div v-if="cartItem.length === 0 && !loading" id="content" class="flex justify-center mt-8"> 
                <div class="w-2/5 flex flex-col justify-center">
                    <img class="h-3/4 w-1/2 self-center" src="https://cdn.dribbble.com/users/204955/screenshots/4930541/emptycart.png?compress=1&resize=400x300" alt="">
                    <p class="text-4xl text-center mb-8">Your cart is empty</p>
                    <button class="bg-green-600 py-2 px-10 text-white w-1/2 self-center" @click="$router.push({ path: `/products` })">Add Order Now</button>
                </div>
            </div>
            <div id="snackbar">{{ message }}</div>
        </div>
    </layout>
</template>
<script>
    export default {
        data() {
            return {
                cartItem: [],
                totalPrice: 0,
                loading: true,
                message: ''
            }
        },
        async mounted() {
            await axios.get("/api/cart")
            .then(response => {
                if (response.data.carts.length === 0) {
                    this.loading = false;
                }
                response.data.carts.forEach( async (e) => {
                    let product = await axios.get("/api/products/" + e.product_id)

                    let item = {
                        id: e.product_id,
                        name: product.data.product.name,
                        price: product.data.product.price.toFixed(2),
                        stock: product.data.product.stock,
                        image: product.data.product.image,
                        quantity: e.quantity
                    }
                    this.cartItem.push(item)
                    this.totalPrice = this.totalPrice + item.price * item.quantity

                    this.loading = false;
                })
                
            })
            .catch(error => console.log(error))            
        },
        methods: {
            updateQuantity(event, index) {
                event.preventDefault()

                let quantity = parseInt(event.target.value)

                this.totalPrice = this.totalPrice - this.cartItem[index].price * this.cartItem[index].quantity
                
                if (quantity === 0) {
                    this.deleteCartItem(this.cartItem[index].id)
                    this.cartItem.splice(index, 1)
                } else {
                    let product = {
                        ...this.cartItem[index],
                        quantity: quantity >=  this.cartItem[index].stock ? this.cartItem[index].stock : quantity
                    }
                    this.$set(this.cartItem, index, product)
                    this.totalPrice = this.totalPrice + this.cartItem[index].price * this.cartItem[index].quantity
                    
                    this.updateCartDB(index)
                }
            },
            addQuantity(index) {
                let product = {
                    ...this.cartItem[index],
                    quantity: this.cartItem[index].quantity >=  this.cartItem[index].stock ? this.cartItem[index].stock : this.cartItem[index].quantity + 1
                }
                this.$set(this.cartItem, index, product)
                this.totalPrice = this.totalPrice + parseInt(this.cartItem[index].price)
                
                this.updateCartDB(index)
            },
            reduceQuantity(index) {
                let quantity = this.cartItem[index].quantity;
                if (quantity === 1) {
                    this.totalPrice = this.totalPrice - parseInt(this.cartItem[index].price)
                    this.deleteCartItem(this.cartItem[index].id)
                    this.cartItem.splice(index, 1)
                    
                } else {
                    quantity = quantity - 1
                    let product = {
                        ...this.cartItem[index],
                        quantity
                    }
                    this.totalPrice = this.totalPrice - parseInt(this.cartItem[index].price)
                    this.$set(this.cartItem, index, product)

                    this.updateCartDB(index)
                }
            },
            clearCart() {
                axios.delete("/api/cart")
                .catch(error => console.log(error))
                this.cartItem = []
            },
            async updateCartDB(index) {
                await axios.put("/api/cart/" + this.cartItem[index].id, {quantity: this.cartItem[index].quantity} )
                .then(response => {
                    console.log(response.data.message)
                })
                .catch(error => console.log(error))
            },
            async deleteCartItem(id) {
                await axios.delete("/api/cart/" + id)
                .then(response => {
                    console.log(response.data.message)
                })
                .catch(error => console.log(error))
            },
            checkout() {
                let request = {
                    products: this.cartItem,
                    totalPrice: this.totalPrice,
                }

                axios.post('/api/orders', request)
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
    #loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 80px;
        height: 80px;
        position: absolute;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

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