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
            brands: [],
            categories: [],
            selectedCategory: null,
            selectedBrand: null,
          };
      },
      computed: {
        rows() {
          return this.totalRows;
        },
      },
      mounted() {
        this.element();
        this.cart();
        this.brand();
        this.category();
      },
      methods: {
        element() {
            
          var url = route('api.product.index') + '?brand=' + this.selectedBrand + '&category=' + this.selectedCategory;
         
          window.axios.get(url).then((response) => {
            let details = response.data.data.data;
            this.elements = details.DataArray;
          });
        },
        cart() {
            
          var url = route('api.cart.index');
         
          window.axios.get(url).then((response) => {
            let details = response.data.data.data;
            this.carts = details.DataArray;
            this.cartCount = details.count;

          });
        },
        brand() {
            
          var url = route('api.product.brand');
         
          window.axios.get(url).then((response) => {
            let details = response.data.data.data;
            this.brands = details.DataArray;
          });
        },
        category() {
            
          var url = route('api.product.category');
         
          window.axios.get(url).then((response) => {
            let details = response.data.data.data;
            this.categories = details.DataArray;
          });
        },
        filter() {
          this.element();
        },
      }
    }
</script>

<template>
    <Head title="Product" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product

                <a :href="route('cart.index')" class="float-right inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cart
                  <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                    {{ this.cartCount }}
                  </span>
                </a>

            </h2>
        </template>

        <!-- header -->
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="lg:flex lg:items-center lg:justify-between">
          <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Product List</h2>
          </div>
          <div class="mt-5 flex lg:ml-4 lg:mt-0">
            
            <div class="relative inline-block text-left mr-2">
              <select v-model="this.selectedCategory" @change="filter()" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"> 
                  <option :value="null" class="text-gray-700 block px-4 py-2 text-sm">Category</option> 
                  <option v-for="category in categories" :value="category.id" class="text-gray-700 block px-4 py-2 text-sm">{{ category.name }}</option>
              </select>
            </div>

          </div>
        </div>

      </div>
    </div>
        <!-- header -->

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
                            Name
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Brand
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
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
                              <a :href="route('product.show', element.id)">
                                {{ element.name }}
                              </a>
                            </div>
                          </td>

                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ element.brand }}</div>
                          </td>

                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ element.category }}
                          </td>

                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            RM{{ element.price }}
                          </td>

                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a :href="route('product.show', element.id)" class="text-indigo-600 hover:text-indigo-900">View</a>
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
