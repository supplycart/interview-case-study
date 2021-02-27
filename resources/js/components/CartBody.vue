<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3" v-for="item in items">
                    <div class="row card-body">
                        <img :src="'/storage/' + item.image" class="w-50" alt="item image">
                        <div class="w-50">
                            <p class="h4 fw-bold">{{ item.name }} ({{ item.quantity }})</p>
                            <p class="">{{ item.desc }}</p>
                            <div class="position-absolute bottom-0 mb-3">
                                <p class="h5 fw-bold">
                                    Retail: ${{ parseFloat(item.price).toFixed(2) }}
                                </p>
                                <p class="h5 fw-bold">
                                    Subtotal: ${{ parseFloat(item.price * item.quantity).toFixed(2) }}
                                </p>
                            </div>
                            <div class="btn-group position-absolute bottom-0 end-0 mb-3 me-3">
                                <button class="btn btn-success text-white" @click="updateItem(item.id, 0)">
                                    +
                                </button>
                                <button class="btn btn-danger text-white" @click="removeItem(item.id)">
                                    Remove
                                </button>
                                <button class="btn btn-success text-white" @click="updateItem(item.id, 1)">
                                    -
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-3" v-if="items.length > 0">
                    <p class="h5 fw-bold">
                        Total: ${{ parseFloat(total).toFixed(2) }}
                    </p>
                    <button class="btn btn-primary text-white col-2" @click="placeOrder">
                        Place Order
                    </button>
                </div>
                <div class="d-flex justify-content-center" v-if="items.length === 0">
                    <p class="h5 pt-4 text-black-50">
                        Nothing to show here
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data: () => ({
        items: [],
    }),
    mounted() {
        this.loadItems();
    },
    methods: {
        loadItems: function () {
            axios.get('/api/cart/').then((response) => {
                this.items = response.data;
            }).catch((error) => {
                console.log(error);
            });
        },
        updateItem: function (id, mode) {
            const data = {'mode': mode};
            axios.patch(`/cart/${id}`, data).then((response) => {
                // console.log(`item ${id} incremented`);
            }).catch((error) => {
                console.log(error.response);
            });
            this.loadItems();
        },
        removeItem: function (id) {
            axios.delete(`/cart/${id}`).then((response) => {
                // console.log(`item ${id} removed`);
            }).catch((error) => {
                console.log(error.response);
            });
            this.loadItems();
        },
        placeOrder: function () {
            const data = {'items': this.items};
            axios.post(`/order`, data).then((response) => {
                // console.log('Order placed');
                alert('Order placed');
                this.loadItems();
            }).catch((error) => {
                console.log(error.response);
            });
        }
    },
    computed: {
        total: function () {
            let temp = 0;
            this.items.forEach((e) => temp += e.price * e.quantity);
            return temp;
        }
    }
};
</script>
