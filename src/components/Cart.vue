<template>
	<div class="container relative">
		<div class="number cursor-pointer" @click="showCart = !showCart">
			({{ cartNumber }}) Cart
		</div>
		<div class="absolute bg-white p-4 rounded-md shadow-md right-1 top-9 w-max" v-show="showCart">
			<div class="flex flex-col">
				<div v-if="!carts.length">Nothing here...</div>
				<div v-else>
					<div class="order-history grid grid-cols-2 gap-4">
						<div class="ordered-products" v-for="cart in carts" :key="cart.id">
							<img src="https://via.placeholder.com/200x120" alt="">
							<div class="title font-bold">{{ cart.title }}</div>
							<div class="author text-sm font-semibold">{{ cart.author }}</div>
							<div class="review text-sm">{{ cart.review }} Star</div>
						</div>
					</div>
					<button class="px-4 mt-4 flex-shrink-0 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" @click="placeOrder(carts)">Place Order!</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: ['cartNumber', 'carts'],
	data(){
		return {
			showCart: false
		}
	},
    methods: {
        placeOrder(ordered) {
            this.$emit('placeOrder', ordered)
        }
    }
}
</script>

<style>

</style>