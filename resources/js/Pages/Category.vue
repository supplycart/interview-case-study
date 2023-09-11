<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import ProductComponent from '@/Components/ProductComponent.vue';
</script>

<template>
    <!-- Set the page title -->
    <Head title="Category" />

    <!-- Use the authenticated layout for the page -->
    <AuthenticatedLayout>
    
        <!-- Category breadcrumb -->
        <div class="p-3 font-bold font-roboto text-[15px] text-gray-600">{{ $page.props.category_name.name }}   /</div>

        <!-- Category title -->
        <div class="w-full text-center text-[25px]">{{ $page.props.category_name.name }} </div>

        <!-- Horizontal line as a separator -->
        <hr class="border-gray-300">

        <!-- Grid for displaying products -->
        <div class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-2 gap-4 p-6">
            <!-- Loop through products in the category -->
            <div v-for="product in $page.props.category_by_id" :key="product" class="m-1">
                <!-- Render the ProductComponent for each product -->
                <ProductComponent :product="product" />
            </div>
        </div>

    </AuthenticatedLayout>
</template>

