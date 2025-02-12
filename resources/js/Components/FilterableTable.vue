<script setup>
import { ref, computed } from 'vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';

const { items, columns, isFilterEnabled, filters } = defineProps({
  items: Array,
  columns: Array,
  isFilterEnabled: {
    type: Boolean,
    default: false,
  },
  filters: Object,
  isCartTotalPriceEnabled: {
    type: Boolean,
    default: false,
  },
  cartTotalPrice: {
    type: Number,
    default: 0,
  },
});

const searchQuery = ref('');
const selectedFilters = ref({ ...filters });
const sortKey = ref('');
const sortOrder = ref('asc');

const filteredItems = computed(() => {
  return items
    .filter((item) => {
      return (
        (!searchQuery.value ||
          item.name.toLowerCase().includes(searchQuery.value.toLowerCase())) &&
        (!selectedFilters.value.brandName ||
          item.brandName === selectedFilters.value.brandName) &&
        (!selectedFilters.value.categoryName ||
          item.categoryName === selectedFilters.value.categoryName)
      );
    })
    .sort((a, b) => {
      if (!sortKey.value) {
        return 0;
      }

      let result = a[sortKey.value] > b[sortKey.value] ? 1 : -1;
      return sortOrder.value === 'asc' ? result : -result;
    });
});

const sortBy = (key) => {
  if (sortKey.value === key) {
    sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
    return;
  }

  sortKey.value = key;
  sortOrder.value = 'asc';
};
</script>

<template>
  <div>
    <div v-if="isFilterEnabled" class="mb-4 flex gap-4">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search by name..."
        class="w-full rounded border px-4 py-2"
      />

      <select
        v-model="selectedFilters.brandName"
        class="rounded border px-4 py-2"
      >
        <option value="">All Brands</option>
        <option
          v-for="brandName in [...new Set(items.map((p) => p.brandName))]"
          :key="brandName"
          :value="brandName"
        >
          {{ brandName }}
        </option>
      </select>

      <select
        v-model="selectedFilters.categoryName"
        class="rounded border px-4 py-2"
      >
        <option value="">All Categories</option>
        <option
          v-for="categoryName in [...new Set(items.map((p) => p.categoryName))]"
          :key="categoryName"
          :value="categoryName"
        >
          {{ categoryName }}
        </option>
      </select>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
      <table class="w-full border-collapse text-left">
        <thead class="bg-gray-100 text-sm uppercase text-gray-700">
          <tr>
            <th
              v-for="col in columns"
              :key="col.key"
              @click="sortBy(col.key)"
              class="cursor-pointer border-b px-4 py-3"
            >
              {{ col.label }}
            </th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="(row, index) in filteredItems"
            :key="index"
            class="border-b hover:bg-gray-50"
          >
            <td v-for="col in columns" :key="col.key" class="px-4 py-3">
              <slot :name="col.key" :item="row">
                {{ row[col.key] }}
              </slot>
            </td>
          </tr>

          <tr v-if="isCartTotalPriceEnabled" class="bg-gray-100 font-semibold">
            <td colspan="4" class="px-4 py-3 text-right">Total:</td>
            <td class="px-4 py-3">
              <slot :name="cartTotalPrice">
                <PriceDisplay :price="cartTotalPrice" />
              </slot>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
