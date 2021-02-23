<template>
    <div class="container">
        <div class="grid">
            <section
                class="flex flex-col flex-grow md:flex-row gap-11 py-10 px-5 bg-white rounded-md shadow-lg"
            >
                <div class="text-green-500 flex flex-col justify-between">
                    <img :src="product.image" :alt="product.name" />
                </div>
                <div class="text-green-500">
                    <h3
                        class="uppercase text-black text-2xl font-medium"
                        v-html="product.name"
                    ></h3>
                    <h3 class="text-2xl font-semibold mb-7">
                        $ {{ product.price }}
                    </h3>
                    <div class="pb-5">
                        <small class="text-black">{{
                            product.description
                        }}</small>
                    </div>
                    <div class="pb-5">
                        <small>Available Quantity: {{ product.units }}</small>
                    </div>
                    <div class="flex gap-0.5 mt-4">
                        <router-link
                            :to="{ path: '/checkout?pid=' + product.id }"
                            class="bg-green-600 hover:bg-green-500 focus:outline-none transition text-white uppercase px-8 py-3 rounded"
                            >Buy Now</router-link
                        >
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            product: [],
        };
    },
    beforeMount() {
        let url = `/api/products/${this.$route.params.id}`;
        axios.get(url).then((response) => (this.product = response.data));
    },
};
</script>
