<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Product {{ product.name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-2">Product Details</h1>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h2 class="text-lg font-bold">Name</h2>
                {{ product.name }}
              </div>
              <div>
                <h2 class="text-lg font-bold">Description</h2>
                {{ product.description }}
              </div>
              <div>
                <h2 class="text-lg font-bold">Price</h2>
                {{ parseFloat(product.ranked_product_price.price).toFixed(2) }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pb-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="grid grid-cols-3 gap-4">
              <input
                type="number"
                v-model="quantity"
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm col-span-2"
                min="1"
                max="99"
                step="1"
              />

              <button
                class="p-2 text-indigo-400 text-sm font-bold border border-indigo-400 sm:rounded-lg float-right hover:bg-indigo-400 hover:text-white"
                @click="addToCart(product.id)"
              >
                Add to Cart
              </button>
            </div>
          </div>
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
    product: Object,
  },

  data() {
    return {
      quantity: 1,
    };
  },

  methods: {
    addToCart(product_id) {
      axios
        .post(route("cart.item.add"), {
          product_id: product_id,
          quantity: this.quantity,
        })
        .then((res) => {
          if (res.status === 200) {
            this.$swal("Done!", "Added to cart.", "success");
          }
        })
        .catch((err) => {
          this.$swal("Oops!", err.message, "error");
        });
    },
  },
};
</script>
