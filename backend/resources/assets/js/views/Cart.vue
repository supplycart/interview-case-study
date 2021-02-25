<template>
    <div class="container">
        <div class="flex flex-col max-w-full overflow-x-hidden">
            <notification
                @close="closeNotification"
                :message="notificationMessage"
                v-show="showNotification"
            ></notification>
            <table
                class="overflow-x-auto w-full bg-white shadow-md border"
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
                <button
                    class="bg-green-600 hover:bg-green-500 focus:outline-none transition text-white uppercase px-8 py-3 rounded"
                    @click="updateCart"
                >
                    Update Cart
                </button>
                <router-link
                    :to="{ path: '/checkout?pid=' + user.id }"
                    class="bg-green-600 hover:bg-green-500 focus:outline-none transition text-white uppercase px-8 py-3 rounded"
                    >Checkout</router-link
                >
            </div>
        </div>
    </div>
</template>

<script>
import Notification from "./Notification";

export default {
    data() {
        return {
            user: null,
            products: [],
            editedProducts: [],
            showNotification: false,
            notificationMessage: null
        };
    },
    components: { Notification },
    beforeMount() {
        if (localStorage.getItem("bigStore.jwt") != null) {
            this.user = JSON.parse(localStorage.getItem("bigStore.user"));
            axios.defaults.headers.common["Content-Type"] = "application/json";
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("bigStore.jwt");

            axios.get(`api/users/${this.user.id}/cart`).then(response => {
                this.products = response.data;

                if (this.products.length === 0) {
                    this.notificationMessage = {
                        notification: "Cart empty.",
                        description:
                            "Continue shopping and add products into your cart!"
                    };
                    this.showNotification = true;
                }
            });
        }
    },
    methods: {
        closeNotification(message) {
            this.showNotification = false;
        },
        checkUnits(product) {
            if (
                this.editedProducts.some(
                    e => e.product_id === product.product_id
                )
            ) {
                product.quantity = product.quantity;
            } else {
                this.editedProducts.push(product);
            }
        },
        updateCart(e) {
            e.preventDefault();

            if (this.editedProducts.length > 0) {
                this.editedProducts.forEach(product => {
                    let quantity = Number(product.quantity);

                    if (quantity === 0) {
                        axios({
                            method: "delete",
                            url: "api/cart/" + product.id,
                            baseURL: "/"
                        })
                            .then(response => {
                                this.notificationMessage = {
                                    notification: "Item removed",
                                    description:
                                        "Continue shopping or checkout!"
                                };
                                this.showNotification = true;
                            })
                            .catch(error => {
                                console.log(error);
                            });

                        this.$router.go()
                    } else {
                        axios({
                            method: "patch",
                            url: "api/cart/" + product.id,
                            baseURL: "/",
                            data: {
                                quantity
                            }
                        })
                            .then(response => {
                                this.notificationMessage = {
                                    notification: "Cart updated.",
                                    description:
                                        "Continue shopping or checkout!"
                                };
                                this.showNotification = true;
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    }
                });
            }
        }
    }
};
</script>
