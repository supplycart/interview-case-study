<template>
    <div class="container">
        <alert
            @close="closeAlert"
            :message="alertMessage"
            v-show="showAlert"
        ></alert>
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
                        <button
                            class="bg-green-600 hover:bg-green-500 focus:outline-none transition text-white uppercase px-8 py-3 rounded"
                            @click="addToCart"
                        >
                            Add to Cart
                        </button>
                    </div>
                </div>
            </section>
        </div>

        <modal
            @close="endEditing"
            :product="productAddedToCart"
            v-show="showModal"
        ></modal>
    </div>
</template>

<script>
import Modal from "./AddedToCartModal";
import Alert from "./Alert";

export default {
    data() {
        return {
            product: [],
            cart: [],
            user: null,
            isLoggedIn: localStorage.getItem("bigStore.jwt") != null,
            showModal: false,
            showAlert: false,
            productAddedToCart: null,
            alertMessage: null
        };
    },
    components: { Modal, Alert },
    beforeMount() {
        this.user = JSON.parse(localStorage.getItem("bigStore.user"));
        let url = `/api/products/${this.$route.params.id}`;
        axios.get(url).then(response => (this.product = response.data));

        if (localStorage.getItem("bigStore.jwt") != null) {
            this.user = JSON.parse(localStorage.getItem("bigStore.user"));
            axios.defaults.headers.common["Content-Type"] = "application/json";
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("bigStore.jwt");

            axios({
                method: "get",
                url: `api/users/${this.user.id}/cart`,
                baseURL: "/"
            })
                .then(response => {
                    this.cart = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    methods: {
        endEditing(product) {
            this.showModal = false;
        },
        closeAlert(message) {
            this.showAlert = false;
        },
        addToCart(e) {
            e.preventDefault();

            if (!this.isLoggedIn) {
                this.alertMessage = {
                    'error' : 'Not Logged In.',
                    'description' : 'Please log in to add product to cart.'
                };
                this.showAlert = true;
            }
            let user_id = this.user.id;
            let product_id = this.product.id;
            let quantity = 1;
            let fulfilled = false;

            if (this.cart.length === 0) {
                axios({
                    method: "post",
                    url: "api/cart",
                    baseURL: "/",
                    data: {
                        user_id,
                        product_id,
                        quantity,
                        fulfilled
                    }
                })
                    .then(response => {
                        this.showModal = true;
                        this.productAddedToCart = this.product;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                // Check if product already exist in cart
                let cartItem = this.cart.filter(
                    cartItem => cartItem.product_id === this.product.id
                );

                if (cartItem[0]) {
                    quantity = cartItem[0].quantity + 1;
                    axios({
                        method: "patch",
                        url: "api/cart/" + cartItem[0].id,
                        baseURL: "/",
                        data: {
                            quantity
                        }
                    })
                        .then(response => {
                            this.showModal = true;
                            this.productAddedToCart = this.product;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                } else {
                    axios({
                        method: "post",
                        url: "api/cart",
                        baseURL: "/",
                        data: {
                            user_id,
                            product_id,
                            quantity,
                            fulfilled
                        }
                    })
                        .then(response => {
                            this.showModal = true;
                            this.productAddedToCart = this.product;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            }
        }
    }
};
</script>
