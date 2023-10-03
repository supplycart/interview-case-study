<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    text: String,
    type: {
        type: String,
        default: "submit",
    },
    href: {
        type: String,
        default: null,
    },
    icon: {
        type: String,
        default: null,
    },
});

const classes =
    "w-full h-full inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 flex gap-2 justify-center";
</script>

<template>
    <div v-if="href">
        <Link :href="href" :class="classes">
            <vue-feather v-if="icon" :type="icon" size="20"></vue-feather>
            <slot />
            {{ text }}
        </Link>
    </div>
    <div v-else>
        <button :type="type" :class="classes">
            <vue-feather v-if="icon" :type="icon" size="20"></vue-feather>
            <slot />
            {{ text }}
        </button>
    </div>
</template>
