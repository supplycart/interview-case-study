<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="#"
               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous </a>
            <a href="#"
               class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium">{{ perPage * (page - 1) + 1 }}</span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium">{{ perPage * page > total ? total : perPage * page }}</span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium">{{ total }}</span>
                    {{ ' ' }}
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <button @click="changePage(page - 1)"
                            :disabled="page === 1"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:bg-gray-100">
                        <span class="sr-only">Previous</span>
                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true"/>
                    </button>
                    <button v-for="i in max" @click="changePage(i)" :key="i"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                            :disabled="page === i"
                            :class="theClass(i)">{{ i }}
                    </button>
                    <!-- Current: "", Default: "" -->
                    <button @click="changePage(page + 1)"
                            :disabled="page === max"
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:bg-gray-100">
                        <span class="sr-only">Next</span>
                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true"/>
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import {ChevronLeftIcon, ChevronRightIcon} from '@heroicons/vue/solid'

export default {
    name: "Pagination",
    props: ["max", "perPage", "total", "page"],
    emits: ["change"],
    components: {ChevronLeftIcon, ChevronRightIcon},
    methods: {
        theClass(idx) {
            return {
                'z-11 bg-indigo-50 border-indigo-500 text-indigo-600': this.page === idx,
                'z-10 bg-white border-gray-300 text-gray-500 hover:bg-gray-50': this.page !== idx
            }
        },
        changePage(newVal) {
            this.$emit("change", newVal);
        }
    },

}
</script>

<style scoped>

</style>
