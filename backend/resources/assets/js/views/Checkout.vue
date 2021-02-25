<template>
    <div class="container">
        <div class="flex flex-col max-w-full overflow-x-hidden">
            <alert
                @close="closeAlert"
                :message="alertMessage"
                v-show="showAlert"
            ></alert>
            <notification
                @close="closeNotification"
                :message="notificationMessage"
                v-show="products.length === 0"
            ></notification>
            <table
                class="overflow-x-auto w-full bg-white border shadow-md"
                v-if="products.length > 0"
            >
                <thead class="bg-blue-100 border-b border-gray-300">
                    <tr>
                        <th
                            class="p-4 text-left text-sm font-medium text-gray-500"
                        >
                            Product Name
                        </th>
                        <th
                            class="p-4 text-left text-sm font-medium text-gray-500"
                        >
                            Quantity
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
                    <tr v-for="(product, index) in products" :key="index">
                        <td class="p-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img
                                        class="h-10 w-10 rounded-full"
                                        :src="product.product.image"
                                        :alt="product.name"
                                    />
                                </div>
                                <div class="ml-4">
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ product.product.name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <input
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                                type="number"
                                name="units"
                                min="0"
                                :max="product.product.units"
                                v-model="product.quantity"
                                @change="checkUnits(product)"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div
                class="flex justify-between items-center border-b-2 border-gray-100 pt-6 pb-3 md:justify-start md:space-x-10"
                v-if="products.length > 0"
            >
                <div class="w-1000" v-if="isLoggedIn">
                    <label for="address">Delivery address</label>
                    <input
                        id="address"
                        name="address"
                        type="text"
                        v-model="address"
                        required
                        class="appearance-none rounded-none relative block px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4 w-auto"
                    />
                </div>
                <button
                    class="ml-8 bg-green-600 hover:bg-green-500 focus:outline-none transition text-white uppercase px-8 py-3 rounded"
                    v-if="isLoggedIn"
                    @click="placeOrder"
                >
                    Continue
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Alert from "./Alert";
import Notification from "./Notification";

export default {
    props: ["pid"],
    data() {
        return {
            address: "",
            quantity: 1,
            isLoggedIn: null,
            notificationMessage: {
                notification: "Cart empty.",
                description:
                    "Continue shopping and add products into your cart!"
            },
            products: [],
            showAlert: false,
            alertMessage: null
        };
    },
    components: { Alert, Notification },
    mounted() {
        this.isLoggedIn = localStorage.getItem("bigStore.jwt") != null;
    },
    beforeMount() {
        if (localStorage.getItem("bigStore.jwt") != null) {
            this.user = JSON.parse(localStorage.getItem("bigStore.user"));
            axios.defaults.headers.common["Content-Type"] = "application/json";
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("bigStore.jwt");

            axios.get(`api/users/${this.user.id}/cart`).then(response => {
                this.products = response.data;
            });
        }
    },
    methods: {
        closeAlert(message) {
            this.showAlert = false;
        },
        closeNotification(message) {
            this.showNotification = false;
        },
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

            if (this.address.length === 0) {
                this.alertMessage = {
                    error: "Address is required.",
                    description:
                        "Please enter an address so we can deliver your order safely."
                };
                this.showAlert = true;
                return;
            }

            let address = this.address;

            // TODO: Ugly way to create orders
            if (this.products.length > 0) {
                this.products.forEach(product => {
                    let product_id = product.product_id;
                    let cart_id = product.id;
                    let quantity = product.quantity;

                    axios
                        .post("api/orders/", { address, quantity, product_id })
                        .then(response => this.$router.push("/confirmation"));

                    axios({
                        method: "delete",
                        url: "api/cart/" + cart_id,
                        baseURL: "/"
                    })
                        .then(response => {})
                        .catch(error => {
                            console.log(error);
                        });
                });
            }
        },
        checkUnits(e) {
            if (this.quantity > this.product.units) {
                this.quantity = this.product.units;
            }
        }
    }
};
</script>
