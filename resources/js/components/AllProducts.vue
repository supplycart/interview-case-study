<template>
    <div>
        <h3 class="text-center">All Products</h3><br/>
        <div class="grid grid-cols-3 gap-4">
            <div v-for="product of products" :key="product.id" >
                <form @submit.prevent="addCart">
                <button type="submit" class="w-full max-w-sm mx-auto rounded-md shadow-lg overflow-hidden text-left">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
                    </div>
                    <div class="px-5 py-3 space-y-3">
                        <h3 class="text-gray-700 uppercase font-semibold" >{{ product.name }}</h3>
                        <p class="text-gray-500 text-sm">{{ product.descriptions }}</p>
                        <p class="text-red-500 mt-2"> RM {{ product.price }}</p>
                    </div>
                </button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                products: [],
            }
        },
        created() {
            this.axios
                .get('/api/products')
                .then(response => {
                    this.products = response.data;
                });
        },
        methods: {
            addCart(id) {
                this.axios
                    .post(`/api/carts/`, this.book)
                    .then(response => {
                       console.log(response.data);
                    });
            }
        }
    }
</script>