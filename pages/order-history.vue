<template>
  <div class="bg-gray-200 dark:bg-gray-800 h-screen">
    <NavBar />

    <!-- component -->
    <!-- This is an example component -->
    <div id="menu" class="container mx-auto px-4 lg:pt-24 lg:pb-64">
      <div class="flex flex-wrap justify-center">
        <div class="w-full lg:w-6/12 px-4">
          <h2 class="text-4xl font-semibold text-black mt-4">Order History</h2>
        </div>
      </div>
      <div class="flex flex-wrap mt-12 justify-center">
        <OrderHistoryItem />
        <div
          class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-4"
        ></div>
      </div>
    </div>
  </div>
</template>

<script>
import OrderHistoryItem from "@/components/OrderHistoryItem";

export default {
  components: {
    OrderHistoryItem,
  },
};
</script>