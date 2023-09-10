<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import AddressForm from './Partials/AddressForm.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from "vue";

const accountView = ref(true);

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="h-100 pt-[108px]"></div>

        <div class="flex justify-between bg-gray-100 p-2">
            <div class="flex gap-10 px-10">
                <div @click="accountView = true" 
                :class="{'text-[13px] hover:text-[#80041c] hover:underline cursor-pointer': !accountView, 
                'text-[13px] hover:text-[#80041c] underline cursor-pointer': accountView}">
                    Account Details
                </div>

                <div @click="accountView = false" 
                :class="{'text-[13px] hover:text-[#80041c] hover:underline cursor-pointer': accountView, 
                'text-[13px] hover:text-[#80041c] underline cursor-pointer': !accountView}">
                    Address Book
                </div>
            </div>
            <Link href="/logout" method="post" class="text-[13px] hover:text-[#80041c] hover:underline cursor-pointer">Log Off</Link>
        </div>

        <div v-if="accountView" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>

        <div v-else class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <AddressForm
                        :status="status"
                        class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
