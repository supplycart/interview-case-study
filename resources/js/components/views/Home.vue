<template>
    <div>
        <div
            class="flex items-center justify-center text-white-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl bg-gray-300 p-5"
        >
            <h2 class="text-2xl uppercase text-gray-900 font-bold text-center">
                Welcome to the Ambition
            </h2>
        </div>
        <div class="container">
            <div class="row">
                <div
                    class="max-w-sm rounded overflow-hidden shadow-lg m-4 p-3"
                    v-for="(product, index) in products"
                    @key="index"
                >
                    <!-- <router-link :to="{ path: '/products/' + product.id }"> -->
                        <img
                            class="w-full"
                            :src="product.image"
                            :alt="product.name"
                        />
                        <h5>
                            <span
                                class="font-bold text-xl mb-2"
                                v-html="product.name"
                            ></span>
                            <span class="text-lg text-gray-400 p-2 float-right"
                                >$ {{ product.price }}</span
                            >
                        </h5>
                        <button
                            class="bg-blue-500 hover:bg-blue-700  text-white font-bold py-2 px-4 mt-4 float-center rounded-full"
                        >
                           <router-link :to="{ path: '/cart?pid='+product.id }">Add to cart</router-link>
                        </button>
                    <!-- </router-link> -->
                </div>
            </div>
        </div>
    </div>
</template>

 <script>
        export default {
            data(){
                return {
                    products : []
                }
            },
            mounted(){
                axios.get("api/products/").then(response => this.products = response.data)      
            }, 
            beforeMount(){
            let url = `/api/products/${this.$route.params.id}`
            axios.get(url).then(response => this.product = response.data)      
        }
        }
    </script>
<style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
</style>
