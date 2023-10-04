<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Layouts/Pagination.vue";
import { Head } from '@inertiajs/vue3'
import { string } from '@/Helpers'

const props = defineProps({
    activities: Object,
    carts_count: Number,
});
</script>

<template>
    <Head title="Activity" />

    <AuthenticatedLayout :carts_count="carts_count">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Activity
            </h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                User Activity Log
            </h2>

            <div class="divide-y divide-slate-200">
                <div
                    v-for="(activity, id) in props.activities.data"
                    v-bind:key="id"
                    class="bg-white rounded-lg p-4"
                >
                    <span v-if="activity.log_name === 'default'">
                        {{ activity.description }}
                    </span>
                    <span v-else>
                        {{ string.capitalize(activity.log_name) }} is {{ activity.description }}.
                    </span>
                </div>
            </div>
        </div>

        <Pagination :links="props.activities.links" />
    </AuthenticatedLayout>
</template>
