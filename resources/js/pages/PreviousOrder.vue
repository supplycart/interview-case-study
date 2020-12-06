<template>
    <div>
    <Title>Previous orders</Title>
        <div class="pt-4" v-for="order in orders" :key="order.id">
            <table>
                <thead>
                <tr>
                    <table-header></table-header>
                    <table-header>
                        <span class="text-lg text-black">
                            {{formatDate(order.created_at)}}</span>
                    </table-header>
                    <table-header>Amount</table-header>
                    <table-header>Price per item</table-header>
                    <table-header>Total for this item</table-header>
                    <table-header></table-header>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in order.ordered_products" :key="item.id">
                    <table-row>
                    </table-row>

                    <table-row>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-20 w-20">
                                <img class="h-20 w-20"
                                     src="https://m.media-amazon.com/images/I/81xPPb+5PPL._AC_AA180_.jpg"
                                     alt="">
                            </div>

                            <div class="ml-4">
                            <span class="text-lg leading-5 text-blue-400">
                                {{ item.product.title }}
                            </span>
                            </div>
                        </div>
                    </table-row>

                    <table-row>{{item.amount}}</table-row>

                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <span
                                                    class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full text-black">
                                                    {{ 'RM ' + item.current_price.toFixed(2) }}</span>
                    </td>

                    <td
                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-black">
                        {{ 'RM ' + item.total.toFixed(2) }}
                    </td>

                    <td
                        class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                     </td>
                </tr>
                <tr>
                    <table-row></table-row>
                    <table-row></table-row>
                    <table-row></table-row>
                    <table-row>TOTAL PRICE :</table-row>
                    <table-row>
                        <span class="text-xl font-bold">
                            {{ 'RM' + order.total_price }}
                        </span>
                    </table-row>
                    <table-row>
                    </table-row>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Title from "../components/core/Title";
import {mapGetters} from "vuex";
import TableHeader from "../components/core/table/TableHeader";
import TableRow from "../components/core/table/TableRow";
const dayjs = require('dayjs');
const localizedFormat = require('dayjs/plugin/localizedFormat')
dayjs.extend(localizedFormat);

export default {
    name: "PreviousOrder",
    components: {Title, TableHeader, TableRow},
    created() {
        this.$store.dispatch('previousOrder/fetchOrders');
    },
    computed : {
        ...mapGetters(
            'previousOrder', [
                'orders'
            ]
        ),
    },
    methods : {
        formatDate(val) {
            return dayjs(val).format('LLL');
        }
    }
}
</script>

<style scoped>

</style>
