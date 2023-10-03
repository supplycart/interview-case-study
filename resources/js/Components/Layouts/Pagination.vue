<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";

const props = defineProps({
    links: Array,
});

const buttons = ref([]);
const button_prev_url = ref(null);
const button_next_url = ref(null);

const init = () => {
    let links = props.links;
    let selected_index = null;

    // remove prev & next
    links.shift();
    links.pop();

    // select index
    links.map((link, i) => {
        if (link.active) selected_index = i;
    });

    button_prev_url.value = links[selected_index - 1]?.url;
    button_next_url.value = links[selected_index + 1]?.url;

    buttons.value = links;
};

watch(
    () => props.links,
    () => init(),
);

onMounted(() => init());
</script>

<template>
    <div v-if="buttons.length > 1" class="flex justify-center my-5">
        <div
            class="flex flex-wrap justify-center bg-white py-2 min-w-2/5 rounded-lg shadow"
        >
            <Link
                class="px-4 py-2 ml-2 mr-4 text-sm rounded-lg"
                :class="
                    button_prev_url
                        ? 'text-slate-500 focus:text-main-500 hover:bg-main-50 font-bold'
                        : 'text-slate-300'
                "
                :href="button_prev_url"
            >
                Previous
            </Link>
            <template v-for="(btn, i) in buttons" v-bind:key="i">
                <Link
                    class="px-4 py-2 mx-0.5 text-sm font-bold rounded-lg hover:bg-main-50 focus:text-main-500"
                    :class="
                        btn.active ? 'bg-main-600 text-white' : 'text-slate-500'
                    "
                    :href="btn.url"
                >
                    {{ btn.label }}
                </Link>
            </template>
            <Link
                class="px-4 py-2 ml-4 mr-2 text-sm rounded-lg"
                :class="
                    button_next_url
                        ? 'text-slate-500 focus:text-main-500 hover:bg-main-50 font-bold'
                        : 'text-slate-300'
                "
                :href="button_next_url"
            >
                Next
            </Link>
        </div>
    </div>
</template>
