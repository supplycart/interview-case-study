<template>
    <div class="flex space-x-4 mb-4">
      <!-- Brand Filter -->
      <div>
        <label for="brand" class="block font-medium text-gray-700">Brand</label>
        <select 
          id="brand" 
          :value="selectedBrand" 
          @change="$emit('update:selectedBrand', $event.target.value === '' ? null : $event.target.value)" 
          class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md"
        >
          <!-- Default option for "All Brands" -->
          <option value="">All Brands</option>
          <option v-for="brand in availableBrands" :key="brand.id" :value="brand.id">
            {{ brand.name }}
          </option>
        </select>
      </div>
  
      <!-- Category Filter -->
      <div>
        <label for="category" class="block font-medium text-gray-700">Category</label>
        <select 
          id="category" 
          :value="selectedCategory" 
          @change="$emit('update:selectedCategory', $event.target.value === '' ? null : $event.target.value)" 
          class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md"
        >
          <!-- Default option for "All Categories" -->
          <option value="">All Categories</option>
          <option v-for="category in availableCategories" :key="category" :value="category">
            {{ category }}
          </option>
        </select>
      </div>
    </div>
</template>
  
<script setup>
  const props = defineProps({
    selectedBrand: {
      type: [String, Number, null],
      required: true,
    },
    selectedCategory: {
      type: [String, null],
      required: true,
    },
    availableBrands: {
      type: Array,
      required: true,
    },
    availableCategories: {
      type: Array,
      required: true,
    },
  });
</script>
  