<template>
    <div class="card">
        <div class="card-header">
            My Cart
        </div>
        <table class="table-auto items-center">
            <thead>
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Price(RM)</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="Object.keys(carts).length > 0">
                    <tr :key="cart.id" v-for="(cart, index) in carts">
                        <td class="border px-4 py-2">{{ index + 1 }}</td>
                        <td class="border px-4 py-2">
                            {{ cart.product.name }}
                        </td>
                        <td class="border px-4 py-2">{{ cart.quantity }}</td>
                        <td class="border px-4 py-2">
                            {{ productPrice }}
                        </td>
                    </tr>
                </template>
                <template v-if="Object.keys(carts).length == 0">
                    <tr class="text-center">
                        <td colspan="5">
                            <div class="alert-warning p-2">No Record ..</div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <div class="card-footer">
            <button
                class="bg-blue-400 hover:bg-red-300 p-2 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                type="button"
            >
                Checkout
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            carts: []
        };
    },
    created() {
        axios
            .get("/")
            .then(res => {
                this.carts = res.data[1];
            })
            .catch(err => console.error(err));
    },
    computed: {
        productPrice:function() {  
            return this.carts[0].product.price * this.carts[0].quantity;
          
        }
    }
};
</script>

<style></style>
