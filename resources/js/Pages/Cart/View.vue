<script setup>
import NavLink from '@/Components/NavLink.vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';
import QuantitySelector from '@/Components/QuantitySelector.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const { cartItemList } = defineProps({ cartItemList: Array });

const totalItemPrice = (itemPrice, quantity) => itemPrice * quantity;
const cartTotalPrice = computed(() =>
  cartItemList.reduce(
    (total, item) =>
      total + totalItemPrice(item.productPrice, item.cartItemQuantity),
    0,
  ),
);

const checkout = () => {
  // TODO: submit the form to add to create an order
  alert('Checking out');
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
            <div v-else>
              <div
                class="overflow-x-auto rounded-lg border border-gray-200 shadow-md"
              >
                <table class="w-full border-collapse text-left">
                  <thead class="bg-gray-100 text-sm uppercase text-gray-700">
                    <tr>
                      <th class="border-b px-4 py-3"></th>
                      <th class="border-b px-4 py-3">Name</th>
                      <th class="border-b px-4 py-3">Price</th>
                      <th class="border-b px-4 py-3">Quantity</th>
                      <th class="border-b px-4 py-3">Total Price</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr
                      v-for="(row, index) in cartItemList"
                      :key="index"
                      class="border-b hover:bg-gray-50"
                    >
                      <td class="px-4 py-3">
                        <label
                          class="relative flex cursor-pointer items-center"
                        >
                          <input
                            type="checkbox"
                            checked
                            class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow transition-all checked:border-slate-800 checked:bg-slate-800 hover:shadow-md"
                            id="check"
                          />
                          <span
                            class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform text-white opacity-0 peer-checked:opacity-100"
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-3.5 w-3.5"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                              stroke="currentColor"
                              stroke-width="1"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                              ></path>
                            </svg>
                          </span>
                        </label>
                      </td>
                      <td class="px-4 py-3">
                        <NavLink
                          :href="`/product/${row.productId}`"
                          class="font-medium text-indigo-600 hover:text-indigo-500"
                        >
                          {{ row.productName }}
                        </NavLink>
                      </td>
                      <td class="cursor-pointer px-4 py-3">
                        <PriceDisplay :price="row.productPrice" />
                      </td>
                      <td class="cursor-pointer px-4 py-3">
                        <QuantitySelector v-model="row.cartItemQuantity" />
                      </td>
                      <td class="cursor-pointer px-4 py-3">
                        <PriceDisplay
                          :price="
                            totalItemPrice(
                              row.productPrice,
                              row.cartItemQuantity,
                            )
                          "
                        />
                      </td>
                    </tr>
                    <tr class="bg-gray-100 font-semibold">
                      <td colspan="4" class="px-4 py-3 text-right">Total:</td>
                      <td class="px-4 py-3">
                        <PriceDisplay :price="cartTotalPrice" />
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
  </AuthenticatedLayout>
</template>
