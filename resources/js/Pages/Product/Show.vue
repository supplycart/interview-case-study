<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeInput from '@/Components/Input.vue';
    import { Head } from '@inertiajs/inertia-vue3';

    export default {
        components: { BreezeAuthenticatedLayout, Head, BreezeInput },
        props: {
          id: {
            type: String,
            default: "",                                      
          },
        },
        data() {
          return {
            csrf: window.csrf,
            elements: [],
            carts: [],
            cartCount: 0,
            baseUrl: window.location.origin,
            quantity: 1,
            form: new FormData(),
            errors: null,
            successMessage: null,
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
      },
      methods: {
        element() {
            
          var url = route('api.product.show', this.id);
         
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
        addToCart() {
          
            let form = new FormData();
            form.append("_method", "post");
            form.append("id", this.elements.id);
            form.append("quantity", this.quantity);

            var url = route("api.product.store");
            const config = {
              headers: {
                "content-type": "multipart/form-data",
              },
            };

            window.axios
              .post(url, form, config)
              .then((res) => {
                if (res.status == 200) {
                  this.successMessage = res.data.data.message;
                  location.reload();
                }
              })
              
        },
      }
    }
</script>

<template>
    <Head title="Product Information" />

    <BreezeAuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Product Information

              <a :href="route('cart.index')" class="float-right inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cart
                <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                  {{ this.cartCount }}
                </span>
              </a>

          </h2>

      </template>

      <div class="py-12">
        <div class="bg-white">
          <div class="pt-6">
            <nav aria-label="Breadcrumb">
              <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <li>
                  <div class="flex items-center">
                    <a href="#" class="mr-2 text-sm font-medium text-gray-900">{{ this.elements.category }}</a>
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                      <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                    </svg>
                  </div>
                </li>

                <li class="text-sm">
                  <a href="#" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ this.elements.name }}</a>
                </li>
              </ol>
            </nav>

            <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
              <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ this.elements.name }}</h1>
              </div>

              <div class="mt-4 lg:row-span-3 lg:mt-0">
                <h2 class="sr-only">Product information</h2>
                <p class="text-3xl tracking-tight text-gray-900">RM{{ this.elements.price }}</p>

                <form class="mt-10" @submit.prevent="addToCart" enctype="multipart/form-data">
                  <div>
                    <h3 class="text-sm font-medium text-gray-900">Brand</h3>
                    <span class="inline-flex items-center rounded-md bg-blue-50 my-2 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ this.elements.brand }}</span>
                  </div>

                  <div>
                    <h3 class="text-sm font-medium text-gray-900 mt-2">Quantity</h3>

                    <BreezeInput id="quantity" type="text" class="mt-1 block w-24" v-model="quantity" required autofocus autocomplete="quantity" />
                    
                  </div>

                  <a :href="route('product.index')" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-slate-600 px-8 py-2 text-base font-medium text-white hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">Back</a>

                  <button type="submit" class="mt-2 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to cart</button>

                </form>
              </div>

              <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
               
                <div>
                  <h3 class="sr-only">Description</h3>

                  <div class="space-y-6">
                    <p class="text-base text-gray-900">{{ this.elements.description }}</p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
   
    </BreezeAuthenticatedLayout>
</template>
