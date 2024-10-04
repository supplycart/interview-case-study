<template>
    <tbody>
    <tr
        v-for="(row, index) in rows" :key="index"
        class="odd:bg-white even:bg-gray-50 border-b"
    >
        <th
            v-for="(item, index) in row" scope="row" class="px-6 py-4"
            :class="{'font-medium text-gray-900 whitespace-nowrap' : index === 0}"
        >
            <span v-if="!isValidUrl(item)">{{ item }}</span>
            <Link v-else :href="item" class="font-medium text-indigo-600 hover:underline">Edit</Link>
        </th>
    </tr>
    </tbody>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {isValidUrl} from "@/stringFormatter.js";

const props = defineProps({
    rows: Array
});
</script>
