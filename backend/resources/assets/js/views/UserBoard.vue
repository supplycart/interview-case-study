<template>
    <div>
        <div class="container">
            <h4 class="text-2xl">All Your Orders</h4>
        </div>
        <div class="container">
            <div class="row">
                <div v-for="(order, index) in orders" :key="index">
                    <main class="grid">
                        <section
                            class="flex flex-col md:flex-row gap-11 py-10 px-5 bg-white rounded-md shadow-lg w-3/4 md:max-w-2xl"
                        >
                            <div
                                class="text-green-500 flex flex-col justify-between"
                            >
                                <img
                                    :src="order.product.image"
                                    :alt="order.product.name"
                                />
                            </div>
                            <div class="text-green-500">
                                <h3
                                    class="uppercase text-black text-2xl font-medium"
                                >
                                    <span v-html="order.product.name"></span>
                                </h3>
                                <h3 class="text-2xl font-semibold mb-7">
                                    $ {{ order.product.price }}
                                </h3>

                                <span class="small-text text-muted"
                                    >Quantity: {{ order.quantity }}
                                    <span class="float-right">{{
                                        order.is_delivered == 1
                                            ? "shipped!"
                                            : "not shipped"
                                    }}</span>
                                </span>
                                <div class="flex gap-0.5 mt-4">
                                    <p>
                                        <strong>Delivery address:</strong>
                                        <br />{{ order.address }}
                                    </p>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.small-text {
    font-size: 14px;
}
.product-box {
    border: 1px solid #cccccc;
    padding: 10px 15px;
}
.hero-section {
    background: #ababab;
    height: 20vh;
    align-items: center;
    margin-bottom: 20px;
    margin-top: -20px;
}
.title {
    font-size: 60px;
    color: black;
}
</style>

<script>
export default {
    data() {
        return {
            user: null,
            orders: []
        };
    },
    beforeMount() {
        this.user = JSON.parse(localStorage.getItem("bigStore.user"));

        axios.defaults.headers.common["Content-Type"] = "application/json";
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + localStorage.getItem("bigStore.jwt");

        axios.get(`api/users/${this.user.id}/orders`).then(response => {
            this.orders = response.data;
        });
    }
};
</script>
