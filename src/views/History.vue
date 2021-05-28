<template>
    <Header :orderedProducts="orderedProducts" :cart="cart" :cartNumber="cartNumber" />
    <div class="history">
        <div class="container mx-auto">
            <h2 class="text-2xl py-4">This is order history</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="product-container  border-2 shadow-md" v-for="item in products" :key="item.id">
                    <img src="https://via.placeholder.com/750x200" alt="">
                    <div class="p-4 flex flex-col">
                        <div class="font-bold">{{ item.title }}</div>
                        <div class="text-sm font-semibold">{{ item.author }}</div>
                        <div>
                            <div>{{ item.review }} Star</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '../components/Header'

export default {
    props: ['newItem', 'orderedItems', 'orderedProducts', 'cart', 'cartNumber'],
    data() {
        return {
            products: []
        }
    },
    created() {
        const stuff = this.orderedItems.map((item) => {
            return {
                id: item.id,
                title: item.title,
                author: item.author,
                review: item.review
            }
        })

        return this.products = [...this.products, ...stuff]
    },
    components: {
        Header
    },
    computed: {

    }
}
</script>

<style>

</style>