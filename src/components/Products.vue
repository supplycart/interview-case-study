<template>
  <div class="products">
      <div class="container mx-auto">
          <h2 class="text-2xl py-4">This is a list of products</h2>
          <div class="grid grid-cols-3 gap-4">
            <div class="product-container border-2 shadow-md" v-for="item in items" :key="item.id">
                <img src="https://via.placeholder.com/750x200" alt="">
                <div class="p-4 flex flex-col">
                    <div class="font-bold">{{ item.title }}</div>
                    <div class="text-sm font-semibold">{{ item.author }}</div>
                    <div>
                        <div>{{ item.review }} Star</div>
                    </div>
                    <button class="add self-end px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" @click="addToCart(item)">Add to Cart</button>
                </div>
            </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    props: ['items'],
    data() {
        return {
            newItem: []
        }
    },
    methods: {
        addToCart(product) {
            this.newItem = {
                id: product.id,
                title: product.title,
                author: product.author,
                review: product.review
            }

            this.$emit('addToCart', this.newItem)
        }
    }
}
</script>

<style>

</style>