<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { EyeIcon } from '@heroicons/vue/24/outline';

defineProps({
  products: {
    type: Array,
  },
});

</script>

<template>
  <Head title="Products" />

  <component :is="$page.props.auth.user ? AuthenticatedLayout : GuestLayout">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
    </template>
    <div class="py-10">
      <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="mt-6 grid sm:grid-cols-3 gap-x-6 gap-y-10">
          <div v-for="product in products" :key="product.id" class="group relative rounded-lg shadow bg-white">
            <div class="relative">
              <div class="min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80 rounded-t-lg">
                <img :src="product.image" :alt="product.name" class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
              </div>
              <div class="absolute h-full w-full bg-black/20 flex items-center justify-center -bottom-10 group-hover:bottom-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button type="button" @click="addToCart()" class="bg-black text-white py-2 px-5 rounded-lg"><EyeIcon class="h-6 w-6" /></button>
              </div>
            </div>
            <div class="flex flex-wrap gap-2 px-5 py-2">
              <span v-for="category in product.categories" :key="category.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                {{ category.name }}
              </span>
            </div>
            <div class="my-4 px-5 flex">
              <div class="flex-1 w-5/6">
                <h3 class="text-sm text-gray-700">
                  <Link :href="route('products.show', product.slug)">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ product.name }}
                  </Link>
                </h3>
                <p class="flex-1 my-1 text-sm text-gray-500 truncate">{{ product.description }}</p>
              </div>
              <p class="text-sm font-medium text-gray-900">${{ product.price }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </component>
</template>