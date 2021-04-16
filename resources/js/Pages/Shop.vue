<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shop</h2>
    </template>

    <div class="py-12 px-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid sm:grid-cols-5 items-stretch justify-center">
          <button
            type="button"
            v-for="category in categories"
            :key="category.id"
            :class="[
              { 'bg-indigo-400': selected_category === category.id },
              { 'text-white': selected_category === category.id },
              'self-stretch',
              'bg-white',
              'p-4',
              'm-2',
              'sm:rounded-lg',
              'shadow-sm',
              'border',
              'border-gray-50',
              'hover:border-indigo-400',
            ]"
            @click="getProducts(category.id)"
          >
            {{ category.name }}
          </button>
        </div>
      </div>
    </div>

    <div class="pb-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-if="products.length == 0">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            No products available for this category.
          </div>
        </div>
        <div v-else class="grid grid-cols-1 sm:grid-cols-4 gap-4">
          <div
            v-for="product in products"
            :key="product.id"
            class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 border hover:border-indigo-400"
          >
            <inertia-link
              class="cursor-pointer"
              :href="route('product.show', { id: product.id })"
            >
              <h3 class="text-lg font-bold text-indigo-400">
                {{ product.name }}
              </h3>
              <h5 class="text-sm font-bold text-indigi-800">
                {{ parseFloat(product.ranked_product_price.price).toFixed(2) }}
              </h5>
              <p class="h-20 mb-4 overflow-ellipsis overflow-hidden">
                {{ product.description }}
              </p>
            </inertia-link>
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
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";

export default {
  components: {
    BreezeAuthenticatedLayout,
  },

  props: {
    categories: Object,
  },

  data() {
    return {
      selected_category: 0,
      products: [],
    };
  },

  methods: {
    getProducts(category_id) {
      this.selected_category = category_id;

      axios
        .get(route("shop.get_product_by_category"), {
          params: {
            category_id: this.selected_category,
          },
        })
        .then((res) => {
          if (res.status === 200) {
            this.products = res.data;
          }
        })
        .catch((err) => {
          this.$swal("Oops!", err.message, "error");
        });
    },

    addToCart(product_id) {
      axios
        .post(route("cart.item.add"), {
          product_id: product_id,
          quantity: 1,
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

  mounted() {
    if (this.selected_category === 0) {
      this.getProducts(1);
    }
  },
};
</script>
