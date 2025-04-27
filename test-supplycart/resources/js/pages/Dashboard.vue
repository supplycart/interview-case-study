
<script setup async lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import axios from "axios"
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import ItemDashboard from '../components/ItemDashboard.vue';
const props = defineProps({
    data: {
        type: Array
    },
});

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3 ">
                <div v-for="data in data">
                    <ItemDashboard :data="data"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>