<template>
    <div class="h-screen bg-gray-300">
        <div class="py-12">
            <div
                class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg md:max-w-5xl"
            >
                <div class="md:flex ">
                    <div class="w-full p-4 px-5 py-5">
                        <div class="md:grid md:grid-cols-3 gap-2 ">
                            <div class="col-span-2 p-5">
                                <h1 class="text-xl font-medium ">
                                    Shopping Cart
                                </h1>
                                <div
                                    class="flex justify-between items-center mt-6 pt-6"
                                >
                                    <div class="flex items-center">
                                        <img
                                            width="60"
                                            class="rounded-full "
                                            :src="product.image"
                                            :alt="product.name"
                                        />
                                        <div class="flex flex-col ml-3">
                                            <span
                                                class="md:text-md font-medium"
                                                v-html="product.name"
                                            ></span>
                                        </div>
                                    </div>
                                    <div
                                        class="flex justify-center items-center"
                                    >
                                        <div class="pr-8 flex ">
                                            <span class="font-semibold">-</span>
                                            <input
                                                type="text"
                                                class="focus:outline-none bg-gray-100 border h-6 w-8 rounded text-sm px-2 mx-2"
                                                value="1"
                                            />
                                            <span class="font-semibold">+</span>
                                        </div>
                                        <div class="pr-8 ">
                                            <span class="text-xs font-medium"
                                                >$ {{ product.price }}</span
                                            >
                                        </div>
                                        <div>
                                            <i
                                                class="fa fa-close text-xs font-medium"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <i class="fa fa-arrow-left text-sm pr-2"></i>
                            <router-link
                                :to="{ path: '/' }"
                                class="h-12 w-full bg-blue-500 rounded focus:outline-none text-white text-center pt-2"
                                >Continue Shopping</router-link
                            >
                            <router-link
                                :to="{
                                    path: '/checkout?pid=' + product.id
                                }"
                                class="h-12 w-full bg-blue-500 rounded focus:outline-none text-white text-center p-2"
                                >Add to cart</router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
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
