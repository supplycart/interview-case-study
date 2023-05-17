<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head } from '@inertiajs/inertia-vue3';

    export default {
        components: { BreezeAuthenticatedLayout, Head },
        data() {
          return {
            csrf: window.csrf,
            elements: [],
            carts: [],
            cartCount: 0,
            baseUrl: window.location.origin,
          };
      },
      computed: {
        rows() {
          return this.totalRows;
        },
      },
      mounted() {
        this.element();
      },
      methods: {
        element() {
            
          var url = route('api.order.history');
         
          window.axios.get(url).then((response) => {
            let details = response.data.data.data;
            this.elements = details.DataArray;
          });
        },
      }
    }
</script>

<template>
    <Head title="Order" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Order History

                <a :href="route('cart.index')" class="float-right inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cart
                  <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                    {{ this.cartCount }}
                  </span>
                </a>

            </h2>
        </template>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Order Id
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total Amount
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Order Status
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No of Product
                      </th>
                      
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                   
                    <tr v-for="(element, index) in elements">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ index + 1 }}</div>
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            {{ element.orderId }}
                        </div>
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">RM{{ element.totalAmount }}</div>
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ element.orderStatus }}
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ element.numberOfProduct }}
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
   
    </BreezeAuthenticatedLayout>
</template>
