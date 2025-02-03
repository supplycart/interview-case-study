<script setup>
import NavLink from '@/Components/NavLink.vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import FilterableTable from '@/Components/FilterableTable.vue';

const { productList } = defineProps({ productList: Array });
</script>

<template>
  <Head title="Product" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Product</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
          <FilterableTable
            :items="productList"
            :columns="[
              { key: 'name', label: 'Name' },
              { key: 'brandName', label: 'Brand' },
              { key: 'categoryName', label: 'Category' },
              { key: 'price', label: 'Price' },
            ]"
            :filters="{ brandName: '', categoryName: '' }"
          >
            <template #name="{ item }">
              <NavLink
                :href="`/product/${item.id}`"
                class="font-medium text-indigo-600 hover:text-indigo-500"
              >
                {{ item.name }}
              </NavLink>
            </template>
            <template #price="{ item }">
              <PriceDisplay :price="item.price" />
            </template>
          </FilterableTable>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
