<template>
    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
        <button @click="$emit('decrement')" data-action="decrement"
                class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
            <span class="m-auto text-2xl font-thin">−</span>
        </button>
        <input type="number"
               v-model.number="amount"
               class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
               name="custom-input-number"/>
        <button @click="$emit('increment')" data-action="increment"
                class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
            <span class="m-auto text-2xl font-thin">+</span>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        amount: 0
    },
    name: "QuantityCounter",
    watch: {
        amount(val) {
            if (val === "") return;

            if (this.amount <= 0) {
                this.$emit('update:amount', 1);
            }
        }
    },
    // methods: {
    //     increment() {
    //         this.$emit('update:amount', this.amount++);
    //     },
    //     decrement() {
    //         this.$emit('update:amount'
    //         this.amount--
    //     )
    //         ;
    //     },
    // }
}
</script>

<style scoped>

</style>
