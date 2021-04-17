<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Order {{ order.id }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-2">Order Details</h1>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h2 class="text-lg font-bold">ID</h2>
                {{ order.id }}
              </div>
              <div>
                <h2 class="text-lg font-bold">Fulfilled</h2>
                {{ order.fulfilled }}
              </div>
              <div>
                <h2 class="text-lg font-bold">Created</h2>
                {{ formatDate(order.created_at) }}
              </div>
              <div>
                <h2 class="text-lg font-bold">Updated</h2>
                {{ formatDate(order.updated_at) }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pb-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200 p-4">
            <table class="table-auto w-full">
              <thead>
                <tr class="border-b">
                  <th class="p-2">Product</th>
                  <th class="p-2">Quantity</th>
                  <th class="p-2">Price</th>
                  <th class="p-2">Total</th>
                </tr>
              </thead>

              <tbody v-if="order.cart && order.cart.items.length > 0">
                <tr v-for="item in order.cart.items" :key="item.id">
                  <td class="p-2 text-center">{{ item.product.name }}</td>
                  <td class="p-2 text-center">{{ item.quantity }}</td>
                  <td class="p-2 text-center">{{ item.price }}</td>
                  <td class="p-2 text-center">
                    {{ item.quantity * item.price }}
                  </td>
                </tr>
              </tbody>

              <tbody v-else>
                <tr>
                  <td class="text-center p-2" colspan="5">No items in cart.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="pb-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
          <h3 class="text-2xl float-right font-bold">
            Total&nbsp;{{ getCartTotal }}
          </h3>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";

export default {
  components: {
    BreezeAuthenticatedLayout,
  },

  props: {
    order: Object,
  },

  computed: {
    getCartTotal() {
      return this.order.cart && this.order.cart.total > 0
        ? parseFloat(this.order.cart.total).toFixed(2)
        : 0;
    },
  },

  methods: {
    formatDate(date) {
      return this.moment(date).format("YYYY-MM-DD HH:MM:SS");
    },
  },
};
</script>
