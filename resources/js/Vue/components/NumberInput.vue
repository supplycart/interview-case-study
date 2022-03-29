<template>
    <div class="custom-number-input w-32 border-2 border-gray-800 rounded-lg">
        <div class="flex flex-row w-full rounded-lg relative bg-transparent">
            <button @click="inputValue--" class="text-gray-600 hover:text-gray-700 hover:bg-gray-400 w-20 rounded-l cursor-pointer outline-none">
                <span class="m-auto text-2xl font-bold">−</span>
            </button>
            <input type="number"
                   class="outline-none focus:outline-none text-center w-full appearance-none border-transparent focus:border-transparent focus:ring-0 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                   name="custom-input-number"
                   @change=""
                    v-model="inputValue"/>
            <button @click="inputValue++" class="text-gray-600 hover:text-gray-700 hover:bg-gray-400 w-20 rounded-r cursor-pointer">
                <span class="m-auto text-2xl font-bold">+</span>
            </button>
        </div>
    </div>
</template>

<script>
import {isInteger} from 'lodash';
export default {
    name: "NumberInput",
    props: ["value", "min", "max"],
    watch: {
        inputValue: function(newVal, oldVal) {
            if (!isInteger(newVal)) {
                this.inputValue = oldVal;
            } else {
                if (newVal < (this.min ?? 0) || newVal > (this.max ?? 100)) {
                    this.inputValue = oldVal;
                    return;
                }
                this.$emit("change", newVal);
            }
        },
        value: function() {
            this.inputValue = this.value;
        }
    },
    data() {
        return {
            inputValue: 0
        }
    },
    mounted() {
        this.inputValue = this.value
    }
}
</script>

<style scoped>

</style>
