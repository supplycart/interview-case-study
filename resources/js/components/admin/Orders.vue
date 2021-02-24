 <template>
        <div>
            <table class="min-w-full divide-y divide-gray-100 shadow-sm border-gray-200 border">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b"></th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Product</th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Quantity</th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Cost</th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Delivery Address</th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">is Delivered?</th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <tr v-for="(order,index) in orders" @key="index">
                        <td class="px-3 py-2 whitespace-no-wrap">{{index+1}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap" v-html="order.product.name"></td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{order.quantity}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{order.quantity * order.product.price}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{order.address}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{order.is_delivered == 1? "Yes" : "No"}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap" v-if="order.is_delivered == 0"><button class="btn btn-success" @click="deliver(index)">Deliver</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </template>

     <script>
    export default {
        data() {
            return {
                orders : []
            }
        },
        beforeMount(){
            axios.get('/api/orders/').then(response => this.orders = response.data)
        },
        methods: {
            deliver(index) {
                let order = this.orders[index]
                axios.patch(`/api/orders/${order.id}/deliver`).then(response => {
                    this.orders[index].is_delivered = 1
                    this.$forceUpdate()
                })
            }
        }
    }
    </script>