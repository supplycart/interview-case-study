<template>
    <layout>
        <div>
            <loader v-if="loading"></loader>
            <div v-if="product.length !== 0 && !loading">
                <button class="mx-6 my-4 focus:outline-none" @click="$router.go(-1)">
                    &larr; Back
                </button>
                <div class="flex justify-center">
                    <div class="w-10/12 shadow-lg p-4 bg-green-50">
                        <div class="grid grid-cols-3">
                            <div>
                                <img style="width:380px;height:380px" :src="`/storage/product/${product.image}`">
                            </div>
                            <div class="col-span-2 p-4">
                                <p class="text-3xl font-bold">{{ product.name }}</p>
                                <p class="text-xl my-2 text-yellow-600">RM {{ product.price }}</p>
                                <table class="text-gray-500">
                                    <tbody>
                                        <tr>
                                            <td class="w-28 py-2">Category</td>
                                            <td class="py-2">{{ product.category }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-28 py-2">Brand</td>
                                            <td class="py-2">{{ product.brand }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-28 py-2 block">Description</td>
                                            <td class="py-2">{{ product.description}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-7">
                                    <div class="flex">
                                        <p class="w-28">Quantity:</p> 
                                        <button class="bg-white w-8 border border-gray-300 focus:outline-none" @click="reduceQuantity">-</button>
                                        <input class="bg-white w-10 px-2 py-1 border border-gray-300" :value="quantity" @input="updateQuantity" />
                                        <button class="bg-white w-8 border border-gray-300 focus:outline-none" @click="addQuantity">+</button>
                                        <p class="ml-3 text-gray-500">{{ product.stock }} pieces available</p>
                                    </div>
                                    <div class="mt-8 flex justify-end">
                                        <button class="bg-green-600 py-2 px-10 border border-gray-300 text-white" @click="addToCart">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                product: [],
                quantity: 1,
                loading: true,
                message: ''
            }
        },
        async mounted() {
            let id = this.$route.params.id
            await axios.get("/api/products/" + id)
            .then(response => {
                this.product = response.data.product
            })
            .catch(error => console.log(error))

            await axios.get("/api/categories/" + this.product.category_id)
            .then(response => {
                this.product = {
                    ...this.product,
                    category: response.data.category.name
                }
            })
            .catch(error => console.log(error))

            await axios.get("/api/brands/" + this.product.brand_id)
            .then(response => {
                this.product = {
                    ...this.product,
                    brand: response.data.brand.name
                }
                this.loading = false;
            })
            .catch(error => console.log(error))
        },
        methods: {
            updateQuantity(event) {
                let qty = parseInt(event.target.value)
                this.quantity = qty >= this.product.stock ? this.product.stock : qty
                
                this.$forceUpdate()
            },
            addQuantity() {
                this.quantity = this.quantity >= this.product.stock ? this.product.stock : this.quantity + 1
            },
            reduceQuantity() {
                this.quantity = this.quantity === 1 ? 1 : this.quantity - 1
            },
            addToCart() {
                axios.post("/api/cart", {id: this.product.id, quantity: this.quantity} )
                .then(response => {
                    this.message = response.data.message
                    let x = document.getElementById("snackbar")
                    x.className = "show"
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