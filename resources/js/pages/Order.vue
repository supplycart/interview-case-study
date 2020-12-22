<template>
  <div>

    <div class="container mx-auto h-screen text-gray-800 flex flex-wrap">

      <div class="w-full lg:w-3/12 flex-0 p-5">
        Sidebar

      </div>
      <div class="w-full lg:w-9/12 flex-0 p-5 bg-white shadow-lg rounded-b-lg">
        <h2>Order History</h2>
        <div class="pt-4" v-for="order in orders" :key="order.id">
          Order Date: {{formatDate(order.created_at)}} ({{order.order_products.length}} items)
          <table class="relative p-6 flex-auto">
            <thead>
            <tr>
              <td></td>
              <td class="font-semibold text-gray-600 text-xs text-center">
                        <span class="text-lg text-black">
                            Product</span>
              </td>
              <td class="font-semibold text-gray-600 text-xs text-center">Quantity</td>
              <td class="font-semibold text-gray-600 text-xs text-center" >Price</td>
              <td class="font-semibold text-gray-600 text-xs text-center">Subtotal</td>
              <td></td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in order.order_products" :key="item.id">
              <td>
              </td>

              <td>
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-20 w-20">
                    <img class="h-20 w-20"
                         :src="item.product.image"
                         alt="">
                  </div>

                  <div class="ml-4">
                            <span class="text-lg leading-5 text-blue-400">
                                {{ item.product.name }}
                            </span><br>
                            <span class="text-lg leading-5 text-indigo-400">
                                {{ item.product.brand.name }}
                            </span>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ item.qty }}</td>

              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <span
                                                    class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full text-black">
                                                    {{ '$ ' + item.price }}</span>
              </td>

              <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-black">
                {{ '$ ' + item.price * item.qty }}
              </td>

              <td
                  class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
              </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>TOTAL PRICE :</td>
              <td>
                        <span class="text-xl font-bold">
                            {{ '$' + order.amount }}
                        </span>
              </td>
              <td>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <pagination :pagination="pagination" @paginate="fetchOrders" :offset="4"/>
      </div>


    </div>

  </div>
</template>

<script>
import Pagination from "../components/Pagination";
import axios from "axios";
import {mapGetters} from "vuex";

const dayjs = require('dayjs');
const localizedFormat = require('dayjs/plugin/localizedFormat')
dayjs.extend(localizedFormat);

export default {
  components: {pagination: Pagination},

  middleware: 'auth',

  metaInfo() {
    return {title: "Home"}
  },
  data() {

    return {

      orders: [],
      offset: 4,
      pagination: {},
    }
  },

  computed: {},

  async created() {
    this.fetchOrders();
  },
  methods: {
    formatDate(val) {
      return dayjs(val).format('LLL');
    },
    fetchOrders: function () {
      let current_page = this.pagination.current_page;
      let page_number = current_page ? current_page : 1;
      let filter = this.serialize(this.filter);
      axios.get('/api/orders?page=' + page_number + '&' + filter).then(response => {
        this.pagination = response.data.pagination;
        this.orders = response.data.orders;
      })
          .catch(error => console.log(error))
    },
    serialize: function (obj, prefix) {
      var str = [],
          p;
      for (p in obj) {
        if (obj.hasOwnProperty(p)) {
          var k = prefix ? prefix + "[" + p + "]" : p,
              v = obj[p];
          str.push((v !== null && typeof v === "object") ?
              this.serialize(v, k) :
              k + "=" + encodeURIComponent(v));
        }
      }
      return str.join("&");
    },
  }
}
</script>
