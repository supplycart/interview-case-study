<script setup>
import PriceDisplay from '@/Components/PriceDisplay.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';

const { productList } = defineProps({ productList: Array });
</script>

<template>
  <Head title="Product" />

  <GuestLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Product</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div>
              <div
                class="overflow-x-auto rounded-lg border border-gray-200 shadow-md"
              >
                <table class="w-full border-collapse text-left">
                  <thead class="bg-gray-100 text-sm uppercase text-gray-700">
                    <tr>
                      <th class="border-b px-4 py-3">Name</th>
                      <th class="border-b px-4 py-3">Price</th>
                      <th class="border-b px-4 py-3">Brand</th>
                      <th class="border-b px-4 py-3">Category</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr
                      v-for="(row, index) in productList"
                      :key="index"
                      class="border-b hover:bg-gray-50"
                    >
                      <td class="px-4 py-3">
                        {{ row.name }}
                      </td>
                      <td class="cursor-pointer px-4 py-3">
                        {{ row.brandName }}
                      </td>
                      <td class="cursor-pointer px-4 py-3">
                        {{ row.categoryName }}
                      </td>
                      <td class="cursor-pointer px-4 py-3">
                        <PriceDisplay :price="row.price" />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>
