<template>
    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
        <button @click="decrement" data-action="decrement"
                class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
            <span class="m-auto text-2xl font-thin">−</span>
        </button>
        <input type="number"
               v-model.number="quantity"
               @input="updateAmount"
               class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
               name="custom-input-number"/>
        <button @click="increment" data-action="increment"
                class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
            <span class="m-auto text-2xl font-thin">+</span>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        product: {
            type: Object,
            default: ({
                amount: 0
            })
        }
    },
    data() {
        return {
            quantity: this.product.amount
        }
    },
    name: "QuantityCounter",
    methods: {
        updateAmount(e) {
            if (this.quantity < 0) {
                this.quantity = 1;
            }

            if (this.quantity !== '') {
                this.quantity = parseInt(this.quantity);
            }

            this.updateProductAmount();
        },
        increment(e) {
            this.quantity++;
            this.updateProductAmount()
        },
        decrement(e) {
            this.quantity--;
            if (this.quantity <= 0) {
                this.quantity = 1;
            }
            this.updateProductAmount()
        },
        updateProductAmount() {
            this.product.amount = this.quantity;
            this.$emit('update-amount', this.product);
        }
    }
}
</script>

<style scoped>

</style>
