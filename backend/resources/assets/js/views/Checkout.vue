<template>
    <div class="container">
        <div class="grid">
            <section
                class="flex flex-col flex-grow md:flex-row gap-11 py-10 px-5 bg-white rounded-md shadow-lg"
            >
                <div class="text-green-500 flex flex-col justify-between">
                    <img :src="product.image" :alt="product.name" />
                </div>
                <div class="flex-grow">
                    <h3
                        class="uppercase text-black text-2xl font-medium"
                        v-html="product.name"
                    ></h3>
                    <h3 class="text-2xl font-semibold mb-7">
                        $ {{ product.price }}
                    </h3>

                    <div class="text-green-500 pb-5">
                        <small>Available Quantity: {{ product.units }}</small>
                    </div>

                    <div v-if="isLoggedIn">
                        <span>Quantity: </span>

                        <input
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                            type="number"
                            name="units"
                            min="1"
                            :max="product.units"
                            v-model="quantity"
                            @change="checkUnits"
                        />
                    </div>

                    <div class="pb-5">
                        <div v-if="!isLoggedIn">
                            <h2 class="mt-8 mb-4">
                                You need to login to continue
                            </h2>
                            <router-link
                                :to="{ name: 'login' }"
                                class="bg-transparent text-green-500 border-green-500 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border rounded-md shadow-sm text-base font-medium text-white hover:text-green-700 hover:border-green-700"
                                >Login</router-link
                            >
                            <router-link
                                :to="{ name: 'register' }"
                                class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700"
                                >Register</router-link
                            >
                        </div>

                        <div class="w-1000" v-if="isLoggedIn">
                            <label for="address">Delivery address</label>
                            <input
                                id="address"
                                name="address"
                                type="text"
                                v-model="address"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                            />
                        </div>
                    </div>

                    <div class="flex gap-0.5 mt-4">
                        <button
                            class="bg-green-600 hover:bg-green-500 focus:outline-none transition text-white uppercase px-8 py-3 rounded"
                            v-if="isLoggedIn"
                            @click="placeOrder"
                        >
                            Continue
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    props: ["pid"],
    data() {
        return {
            address: "",
            quantity: 1,
            isLoggedIn: null,
            product: []
        };
    },
    mounted() {
        this.isLoggedIn = localStorage.getItem("bigStore.jwt") != null;
    },
    beforeMount() {
        axios
            .get(`/api/products/${this.pid}`)
            .then(response => (this.product = response.data));

        if (localStorage.getItem("bigStore.jwt") != null) {
            this.user = JSON.parse(localStorage.getItem("bigStore.user"));
            axios.defaults.headers.common["Content-Type"] = "application/json";
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("bigStore.jwt");
        }
    },
    methods: {
        login() {
            this.$router.push({
                name: "login",
                params: { nextUrl: this.$route.fullPath }
            });
        },
        register() {
            this.$router.push({
                name: "register",
                params: { nextUrl: this.$route.fullPath }
            });
        },
        placeOrder(e) {
            e.preventDefault();

            let address = this.address;
            let product_id = this.product.id;
            let quantity = this.quantity;

            axios
                .post("api/orders/", { address, quantity, product_id })
                .then(response => this.$router.push("/confirmation"));
        },
        checkUnits(e) {
            if (this.quantity > this.product.units) {
                this.quantity = this.product.units;
            }
        }
    }
};
</script>
