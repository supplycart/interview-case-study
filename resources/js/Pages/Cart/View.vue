<script setup>
import NavLink from '@/Components/NavLink.vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';
import QuantitySelector from '@/Components/QuantitySelector.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import FilterableTable from '@/Components/FilterableTable.vue';

const { cartItemList } = defineProps({ cartItemList: Array });

const itemTotalPrice = (itemPrice, quantity) => itemPrice * quantity;
const cartTotalPrice = computed(() =>
  cartItemList.reduce(
    (total, item) =>
      total + itemTotalPrice(item.productPrice, item.cartItemQuantity),
    0,
  ),
);

const checkout = () => {
  router.post(`/order/checkout`);
};
const quantityUpdated = (cartId, productId, updatedQuantity) => {
  router.post('cart/update', { cartId, productId, quantity: updatedQuantity });
};
const removeCartItem = (cartItemId) => {
  if (confirm('Are you sure you want to remove this item from the cart?')) {
    router.post('/cart/delete', { cartItemId });
  }
};
</script>

<template>
  <Head title="Cart" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Cart</h2>

      <div
        v-if="cartItemList.length > 0"
        class="mt-4 flex items-center space-x-8"
      >
        <button
          @click="checkout"
          class="rounded-md bg-red-600 px-6 py-3 text-white hover:bg-red-500"
        >
          Checkout
        </button>
      </div>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h1 v-if="cartItemList.length <= 0">Your cart is empty.</h1>

            <FilterableTable
              v-else
              :items="cartItemList"
              :columns="[
                { key: 'action', label: '' },
                { key: 'productName', label: 'Name' },
                { key: 'productPrice', label: 'Price' },
                { key: 'quantity', label: 'Quantity' },
                { key: 'totalPrice', label: 'Total Price' },
              ]"
              :isCartTotalPriceEnabled="true"
              :cartTotalPrice="cartTotalPrice"
            >
              <template #action="{ item }">
                <button
                  @click="removeCartItem(item.cartItemId)"
                  class="rounded-md bg-red-600 px-6 py-3 text-white hover:bg-red-500"
                >
                  Remove
                </button>
              </template>

              <template #productName="{ item }">
                <NavLink
                  :href="`/product/${item.productId}`"
                  class="font-medium text-indigo-600 hover:text-indigo-500"
                >
                  {{ item.productName }}
                </NavLink>
              </template>

              <template #productPrice="{ item }">
                <PriceDisplay :price="item.productPrice" />
              </template>

              <template #quantity="{ item }">
                <QuantitySelector
                  @onValueUpdate="
                    quantityUpdated(item.cartId, item.productId, $event)
                  "
                  @onValueEmpty="removeCartItem(item.cartItemId)"
                  v-model="item.cartItemQuantity"
                />
              </template>

              <template #totalPrice="{ item }">
                <PriceDisplay
                  :price="
                    itemTotalPrice(item.productPrice, item.cartItemQuantity)
                  "
                />
              </template>
            </FilterableTable>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
