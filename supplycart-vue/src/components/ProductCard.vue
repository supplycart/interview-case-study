<script setup>
import { useCartStore } from '@/stores/useCart';
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';
import PrimaryButton from '@/components/PrimaryButton.vue'; // Use the PrimaryButton component

const props = defineProps({
  product: {
    type: Object,
    required: true
  },
  inCart: {
    type: Boolean,
    default: false
  },
  quantity: {
    type: Number,
    default: 1
  },
  subtotal: {
    type: Number,
    default: 0
  },
  showCheckbox: {
    type: Boolean,
    default: false
  },
  checked: {
    type: Boolean,
    default: false
  },
  onCheckboxChange: {
    type: Function,
    default: null
  },
  updateQuantity: {
    type: Function,
    default: null
  }
});

const cartStore = useCartStore();
const authStore = useAuthStore();
const router = useRouter();

// Handle add to cart or redirect to login if the user is not authenticated
const handleAddToCart = () => {
  if (!authStore.isLoggedIn) {
    router.push({ name: 'login' });
  } else {
    cartStore.addToCart(props.product.id)
      .then(() => {
        alert('Product added to cart successfully!');
      })
      .catch((error) => {
        console.error('Error adding product to cart:', error);
      });
  }
};
</script>

<template>
  <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200 p-6 border flex flex-col h-full">
    <!-- Show checkbox if needed -->
    <div>
        <input 
            v-if="showCheckbox" 
            type="checkbox" 
            class="mb-4"
            :checked="checked"
            @change="onCheckboxChange && onCheckboxChange()"
        />
    </div>

    <img :src="product.image_url" alt="Product Image" class="w-full h-40 object-cover rounded-md mb-4">

    <div class="flex-grow">
      <h3 class="text-lg font-semibold text-gray-700">{{ product.name }}</h3>
      <p class="text-sm text-gray-500 mt-1">{{ product.description }}</p>
      <p class="text-lg font-bold text-gray-900 mt-4">RM {{ product.price }}</p>
    </div>

    <!-- Brand and Category Tags -->
    <div class="flex space-x-2 mt-2">
      <span class="text-xs font-semibold text-white bg-gray-600 px-2 py-1 rounded-sm">{{ product?.brand?.name }}</span>
      <span class="text-xs font-semibold text-white bg-blue-600 px-2 py-1 rounded-full">{{ product?.category }}</span>
    </div>

    <!-- Show quantity controls and subtotal if inCart is true -->
    <div v-if="inCart" class="flex items-center mt-4">
        <button 
        class="bg-gray-300 text-gray-900 px-2 py-1 rounded-md"
        @click="() => updateQuantity && updateQuantity(1)"
        >
        +
        </button>
        <span class="mx-4">{{ quantity }}</span>

        <button 
        class="bg-gray-300 text-gray-900 px-2 py-1 rounded-md"
        @click="() => updateQuantity && updateQuantity(-1)"
        >
        -
        </button>

      <p class="ml-4 text-lg font-bold">Subtotal: RM {{ subtotal }}</p>
    </div>

    <!-- Regular Add to Cart button if not in the cart -->
    <PrimaryButton
      v-if="!inCart"
      @click="handleAddToCart"
      class="w-full mt-4"
    >
      Add to Cart
    </PrimaryButton>
  </div>
</template>
