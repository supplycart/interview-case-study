<script setup>
import NavLink from '@/Components/NavLink.vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import FilterableTable from '@/Components/FilterableTable.vue';

const { orderList } = defineProps({ orderList: Array });
</script>

<template>
  <Head title="Order" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Order</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h1 v-if="orderList.length <= 0">You have not made an order.</h1>

            <FilterableTable
              v-else
              :items="orderList"
              :columns="[
                { key: 'action', label: '' },
                { key: 'orderId', label: 'Order ID' },
                { key: 'totalPrice', label: 'Total Price' },
                { key: 'createdAt', label: 'Created At' },
              ]"
            >
              <template #action="{ item }">
                <NavLink
                  :href="`/order/${item.orderId}`"
                  class="font-medium text-indigo-600 hover:text-indigo-500"
                >
                  View
                </NavLink>
              </template>
              <template #orderId="{ item }">
                {{ item.orderId }}
              </template>
              <template #price="{ item }">
                <PriceDisplay :price="item.totalPrice" />
              </template>
              <template #createdAt="{ item }">
                {{ item.createdAt }}
              </template>
            </FilterableTable>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
