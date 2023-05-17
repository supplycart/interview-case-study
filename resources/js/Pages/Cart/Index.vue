<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
        components: { BreezeAuthenticatedLayout, Head },
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
            totalAmount: 0,
            baseUrl: window.location.origin,
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
        this.cart();
      },
      methods: {
        cart() {
            
          var url = route('api.cart.index');
         
          window.axios.get(url).then((response) => {
            let details = response.data.data.data;
            let data = details.DataArray;
            this.carts = details.DataArray;
            this.cartCount = details.count;
            
            var text;
            var total = 0;
            for (let i = 0; i < data.length; i++) {
              text = data[i].quantity*data[i].product.price;
              total = text + total; 
            }
            this.totalAmount = total;
          });
        },
        removeItem(item) {
            
          var url = route('api.cart.destroy', item);
         
          window.axios.get(url).then((response) => {
            
            if (response.status == 200) {
                this.cart();
            }
            
          
          });
        },
        checkout() {

            let form = new FormData();
            form.append("_method", "post");
            form.append("id", this.elements.id);
            form.append("total_amount", this.totalAmount);

            var url = route("api.order.checkout");
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
                  window.location.href = this.baseUrl + "/order/history"
                }
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
                Cart
            </h2>
        </template>

        <div class="container mx-auto mt-10 mb-10">
            <div class="flex shadow-md my-10">
              <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                  <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                  <h2 class="font-semibold text-2xl">{{ cartCount }} Items</h2>
                </div>
                <div class="flex mt-10 mb-5">
                  <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>

                <div v-for="cart in carts">

                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                  <div class="flex w-2/5">
                    <div class="w-20">
                      <img class="h-24" src="https://drive.google.com/uc?id=18KkAVkGFvaGNqPy2DIvTqmUH_nk39o3z" alt="">
                    </div>
                    <div class="flex flex-col justify-between ml-4 flex-grow">
                      <span class="font-bold text-sm">{{ cart.product.name }}</span>
                      <span class="text-red-500 text-xs">{{ cart.brand.name }}</span>
                      <a v-on:click="removeItem(cart.id)" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                    </div>
                  </div>
                  <div class="flex justify-center w-1/5">

                    <input class="mx-2 border text-center w-12" type="text" :value="cart.quantity">

                  </div>
                  <span class="text-center w-1/5 font-semibold text-sm">RM{{ cart.product.price }}</span>
                  <span class="text-center w-1/5 font-semibold text-sm">RM{{ cart.product.price*cart.quantity }}</span>
                </div>

            </div>

                <a :href="route('product.index')" class="flex font-semibold text-indigo-600 text-sm mt-10">
              
                  <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                  Continue Shopping
                </a>
              </div>

              <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex justify-between mt-10 mb-5">
                  <span class="font-semibold text-sm uppercase">Items {{ cartCount }}</span>
                  <span class="font-semibold text-sm">RM{{ this.totalAmount }}</span>
                </div>
                <div>
                  <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                  <select class="block p-2 text-gray-600 w-full text-sm">
                    <option>Standard shipping - RM10.00</option>
                  </select>
                </div>

                <div class="border-t mt-8">
                  <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>Total cost</span>
                    <span>RM{{ this.totalAmount + 10 }}</span>
                  </div>
                  <button v-on:click="checkout()" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                </div>
              </div>

            </div>
          </div>


    </BreezeAuthenticatedLayout>
</template>
