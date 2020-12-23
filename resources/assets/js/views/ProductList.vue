<template>
    <layout>
        <div class="flex justify-center">
            <div class="container w-4/5">
                <div class='grid grid-cols-5 gap-10 mt-2.5'>     
                    <div class="shadow-lg border-2 border-gray-100" v-for="product in products" :key="product.name" @click="$router.push({ path: `/products/${product.id}` })">
                        <div class='img-thumbnail' style='height: 300px'>
                            <div class="h-3/5 overflow-hidden">
                                <img class='img-responsive object-contain mx-auto' :src="`/storage/product/${product.image}`" />
                            </div>
                            <div class="text-sm overflow-hidden p-2.5 h-1/4">
                                <strong>{{ product.name }}</strong>
                            </div>
                            <div class="row p-2" style='border-top:1px solid #d9d9d9'>
                                <div class='flex justify-end'>
                                    <strong>RM {{ product.price }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>
<script>
    export default {
        data() {
            return {
                products: [],
            }
        },
        mounted() {
            axios.get("/api/products")
            .then(response => {
                console.log(response)
                this.products = response.data.products
            })
            .catch(error => console.log(error))
        },
        methods: {
            viewDetails(id) {
                router.push({ path: `/products/${id}` })
            }
        }
    }
</script>