<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';
import FilterableTable from '@/Components/FilterableTable.vue';

const { order, productList } = defineProps({
  order: {
    orderId: Number,
    totalPrice: Number,
    createdAt: String,
  },
  productList: Array,
});
const { orderId, totalPrice, createdAt } = order;
</script>

<template>
  <Head title="Order" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Order ID: {{ orderId }}
      </h2>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Total Price: {{ totalPrice }}
      </h2>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Order Timestamp: {{ createdAt }}
      </h2>
    </template>

    <!-- TODO: show list of product within this order -->
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <FilterableTable
            :items="productList"
            :columns="[
              { key: 'productName', label: 'Name' },
              { key: 'brandName', label: 'Brand' },
              { key: 'categoryName', label: 'Category' },
              { key: 'productPrice', label: 'Price' },
            ]"
          >
            <template #productName="{ item }">
              <NavLink
                :href="`/product/order/${item.productId}`"
                class="font-medium text-indigo-600 hover:text-indigo-500"
              >
                {{ item.productName }}
              </NavLink>
            </template>
            <template #brandName="{ item }">
              {{ item.brandName }}
            </template>
            <template #categoryName="{ item }">
              {{ item.categoryName }}
            </template>
            <template #productPrice="{ item }">
              <PriceDisplay :price="item.productPrice" />
            </template>
          </FilterableTable>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
