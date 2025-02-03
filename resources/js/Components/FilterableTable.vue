<script setup>
import { ref, computed } from 'vue';

const { items, columns, filters } = defineProps({
  items: Array,
  columns: Array,
  filters: Object,
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
        (!selectedFilters.value.brand ||
          item.brandName === selectedFilters.value.brand) &&
        (!selectedFilters.value.category ||
          item.categoryName === selectedFilters.value.category)
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
    <div class="mb-4 flex gap-4">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search by name..."
        class="w-full rounded border px-4 py-2"
      />

      <select v-model="selectedFilters.brand" class="rounded border px-4 py-2">
        <option value="">All Brands</option>
        <option
          v-for="brand in [...new Set(items.map((p) => p.brandName))]"
          :key="brand"
          :value="brand"
        >
          {{ brand }}
        </option>
      </select>

      <select
        v-model="selectedFilters.category"
        class="rounded border px-4 py-2"
      >
        <option value="">All Categories</option>
        <option
          v-for="category in [...new Set(items.map((p) => p.categoryName))]"
          :key="category"
          :value="category"
        >
          {{ category }}
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
        </tbody>
      </table>
    </div>
  </div>
</template>
