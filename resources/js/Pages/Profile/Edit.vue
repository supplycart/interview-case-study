<script setup>
// Import components and modules
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import AddressForm from './Partials/AddressForm.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from "vue";

// Define reactive variables using ref()
const accountView = ref(true);     
const addressView = ref(false);    

// Define props that are passed to the component
defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

// Define a function to format a date string into a localized date string
const formatDate = (dateTimeString) => {
    const date = new Date(dateTimeString); 
    
    // Format as a localized date string
    return date.toLocaleDateString();
};
</script>

<template>
    <!-- Set the page title -->
    <Head title="Profile" />

    <!-- Include the AuthenticatedLayout component -->
    <AuthenticatedLayout>

        <!-- Padding for the top of the page -->
        <div class="h-100 pt-[108px]"></div>

        <!-- Navigation tabs for Account Details, Address Book, and Order History -->
        <div class="flex justify-between bg-gray-100 p-2">
            <div class="flex gap-10 px-10">
                <!-- Account Details tab -->
                <div @click="accountView = true, addressView = false" 
                    :class="{'text-[13px] hover:text-[#80041c] hover:underline cursor-pointer': !accountView, 
                    'text-[13px] hover:text-[#80041c] underline cursor-pointer': accountView}">
                    Account Details
                </div>

                <!-- Address Book tab -->
                <div @click="accountView = false, addressView = true" 
                    :class="{'text-[13px] hover:text-[#80041c] hover:underline cursor-pointer': accountView || !addressView, 
                    'text-[13px] hover:text-[#80041c] underline cursor-pointer': !accountView && addressView}">
                    Address Book
                </div>

                <!-- Order History tab -->
                <div @click="accountView = false, addressView = false" 
                    :class="{'text-[13px] hover:text-[#80041c] hover:underline cursor-pointer': accountView || addressView, 
                    'text-[13px] hover:text-[#80041c] underline cursor-pointer': !accountView && !addressView}">
                    Order History
                </div>
            </div>

            <!-- Logout link -->
            <Link href="/logout" method="post" class="text-[13px] hover:text-[#80041c] hover:underline cursor-pointer">Log Off</Link>
            
        </div>

        <!-- Display Account Details -->
        <div v-if="accountView" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-center">
                    <!-- Include the UpdateProfileInformationForm component -->
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl w-[500px]"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-center">
                    <!-- Include the UpdatePasswordForm component -->
                    <UpdatePasswordForm class="max-w-xl w-[500px]" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-center">
                    <!-- Include the DeleteUserForm component -->
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>

        <!-- Display Address Book -->
        <div v-else-if="addressView" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-center">
                    <!-- Include the AddressForm component -->
                    <AddressForm
                        :status="status"
                        class="max-w-xl w-[500px]"
                    />
                </div>
            </div>
        </div>

        <!-- Display Order History -->
        <div v-else class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="font-roboto font-semibold">Past Orders</div>
                    <div class="border-b flex justify-between pr-20 mt-10 items-center">
                        <div class="w-[100px]">Date</div>
                        <div class="w-[600px]">Items</div>
                        <div class="w-[100px]">Price</div>
                    </div>
                    
                    <!-- Loop through past orders and display them -->
                    <template v-for="order in $page.props.auth.orders" :key="order.id">
                        <div class="border-b flex justify-between pr-20 mt-10 items-center">
                            <div class="w-[100px]">{{ formatDate(order.created_at) }}</div>
                            <div class="w-[600px]">
                                <!-- Display item titles from the order's items -->
                                <template v-for="(item, index) in JSON.parse(order.items)">
                                    <div v-if="index > 0" class="mt-2">{{ item.title }}</div>
                                    <div v-else>{{ item.title }}</div>
                                </template>
                            </div>
                            <div class="w-[100px]">£{{ order.total }}</div>
                        </div>
                    </template>
                    
                    <!-- If there are no past orders, display a message -->
                    <div v-if="$page.props.auth.orders.length === 0" class="text-center text-gray-500 mt-4">
                        No past orders available.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

