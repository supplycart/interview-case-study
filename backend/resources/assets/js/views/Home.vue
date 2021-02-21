<template>
    <div>
        <div
            class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto"
        >
            <h2 class="title">Welcome to the bigStore</h2>
        </div>
        <div class="container">
            <div class="grid sm:grid-cols-1 gap-4 place-items-center md:grid-cols-2">
                <div v-for="(product, index) in products" :key="index">
                    <router-link :to="{ path: '/products/' + product.id }">
                        <main class="place-items-center">
                            <section
                                class="flex flex-col md:flex-row gap-11 py-10 px-5 bg-white rounded-md shadow-lg"
                            >
                                <div
                                    class="text-indigo-500 flex flex-col justify-between"
                                >
                                    <img
                                        :src="product.image"
                                        :alt="product.name"
                                    />
                                </div>
                                <div class="text-indigo-500">
                                    <h3
                                        class="uppercase text-black text-2xl font-medium"
                                    >
                                        <span v-html="product.name"></span>
                                    </h3>
                                    <h3 class="text-2xl font-semibold mb-7">
                                        $ {{ product.price }}
                                    </h3>
                                    <small class="text-black">
                                        {{ product.description }}
                                    </small>
                                    <div class="flex gap-0.5 mt-4">
                                        <button
                                            id="addToCartButton"
                                            class="bg-indigo-600 hover:bg-indigo-500 focus:outline-none transition text-white uppercase px-8 py-3"
                                        >
                                            buy now
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </main>
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
            products: [],
        };
    },
    mounted() {
        axios
            .get("api/products/")
            .then((response) => (this.products = response.data));
    },
};
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
