<template>
    <div>
        <div class="container">
            <div
                class="grid sm:grid-cols-1 gap-4 md:place-items-stretch md:grid-cols-2"
            >
                <div v-for="(product, index) in products" :key="index">
                    <router-link :to="{ path: '/products/' + product.id }">
                        <div
                            class="w-1000 flex flex-1 flex-col md:flex-row gap-11 py-10 px-5 bg-white rounded-md shadow-lg"
                        >
                            <div class="text-green-500">
                                <img :src="product.image" :alt="product.name" />
                            </div>

                            <div class="text-green-500">
                                <h3
                                    class="uppercase text-black text-2xl font-medium"
                                >
                                    <span v-html="product.name"></span>
                                </h3>
                                <h3 class="text-2xl font-semibold mb-7">
                                    $ {{ product.price }}
                                </h3>
                                <div class="flex gap-0.5 mt-4">
                                    <button
                                        id="addToCartButton"
                                        class="bg-green-600 hover:bg-green-500 focus:outline-none transition text-white uppercase px-8 py-3 rounded"
                                    >
                                        Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: []
        };
    },
    mounted() {
        axios
            .get("api/products/")
            .then(response => (this.products = response.data));
    }
};
</script>
