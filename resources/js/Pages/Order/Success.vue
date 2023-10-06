<template>
    <Head title="Success"></Head>
    <AuthenticatedLayout>
        <div class="flex space-x-3">
            <Link :href="route('dashboard')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center hover:underline"> &#x2190; Back</Link>
        </div>
        <div class="relative my-10 flex h-full flex-col overflow-hidden rounded-2xl bg-white text-gray-600 shadow-lg ring-1 ring-gray-200">
            <div class="border-b p-6">
                <h1 class="my-2 text-base text-center text-7xl font-semibold">&#10003;</h1>
                <h6 class="mb-2 text-base text-center text-5xl font-semibold">Order created successfully</h6>
                <p class="mb-4 text-sm font-light">
                    <i class="inline-block font-black not-italic text-green-600" aria-hidden="true"></i>
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>
