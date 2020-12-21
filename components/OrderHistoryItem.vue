<template>
  <div class="rounded-sm shadow-md bg-white p-4 m-1 mb-4">
    <div class="flex justify-between mb-4">
      <p class="font-bold text-lg">{{ order.date }}</p>
      <p class="text-lg font-bold">RM {{ order.total.toFixed(2) }}</p>
    </div>
    <div v-for="product in order.products" :key="product.id">
      <hr class="my-2" />
      <div class="mx-4 grid grid-cols-5">
        <div
          class="h-12 w-12 bg-cover"
          :style="{ backgroundImage: 'url(' + product.imgLink + ')' }"
        />
        <div class="col-span-3">
          <p class="text-gray-800">{{ product.title }}</p>
          <p class="text-xs text-gray-700">{{ product.brand }}</p>
        </div>
        <div class="text-right text-gray-500">
          {{ "RM" + product.price.toFixed(2) }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    // wishlist: true,
  }),
  props: ["order"],
};
</script>