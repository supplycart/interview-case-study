<template>
    <tr :class="rowClass">
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static">
            <div class="flex justify-center lg:justify-start">
                <div class="flex-shrink-0 h-20 w-20">
                    <img
                        :src="productImage"
                        :alt="product.name"
                        class="h-20 w-20 rounded"
                    >
                </div>
                <div class="ml-4">
                    <div class="text-sm text-left font-medium text-gray-900">
                        {{ product.name }}
                    </div>
                    <div class="text-sm text-left text-gray-500">
                        {{ product.description }}
                    </div>
                </div>
            </div>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden px-2 py-1 text-xs font-bold uppercase">Price:</span>
            ${{ product.price }}
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b text-center block lg:table-cell relative lg:static">
            <input
                @change="updateCart"
                :value="product.incart_qty"
                min="0"
                max="10"
                type="number"
                class="lg:w-full w-3/4 border-none font-semibold text-center text-gray-700 bg-gray-100 outline-none focus:outline-none hover:text-black focus:text-black"
            />
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden px-2 py-1 text-xs font-bold uppercase">Subtotal:</span>
            ${{ subtotal }}
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b text-center block lg:table-cell relative lg:static">
            <a
                @click="removeFromCart"
                class="text-indigo-600 hover:text-indigo-900"
                href="#"
            >
                Delete
            </a>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['product'],
    computed: {
        productImage() {
            return this.product.image_url;
        },
        rowClass() {
            return this.product.incart_qty > 0
                ? 'bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0'
                : 'hidden';
        },
        subtotal() {
            return Number(this.product.incart_qty * this.product.price)
                .toFixed(2);
        },
    },
    methods: {
        async updateCart(e) {
            this.product.incart_qty = e.target.value;
            this.$emit('updateCart', this.product.id, this.product.incart_qty);
        },
        removeFromCart() {
            this.product.incart_qty = 0;
            this.$emit('updateCart', this.product.id, this.product.incart_qty);
        },
    },
}
</script>
