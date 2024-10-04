<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import StatisticCard from "@/Components/StatisticCard.vue";

const props = defineProps({
    orderStatistics: Object
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-[100rem] sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-3 gap-5 p-5">
                        <StatisticCard
                            @click="statistic.link ? router.visit(statistic.link) : null"
                            v-for="statistic in orderStatistics"
                            :name="statistic.name"
                            :number="statistic.value"
                            class="cursor-pointer relative p-6 rounded-2xl bg-indigo-50 shadow"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
