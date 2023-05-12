<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const url = usePage().props.s3.url;

const props = defineProps({
    activities: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="mx-auto container py-12">
            <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8">
                <div class="flex justify-center w-full lg:border-r border-gray-300 py-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="69" viewBox="0 0 64 69" fill="none">
                        <path d="M31.5 37C41.165 37 49 29.165 49 19.5C49 9.83502 41.165 2 31.5 2C21.835 2 14 9.83502 14 19.5C14 29.165 21.835 37 31.5 37Z" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M2 67V61C2 57.8174 4.10714 54.7652 7.85786 52.5147C11.6086 50.2643 16.6957 49 22 49H42C47.3043 49 52.3914 50.2643 56.1421 52.5147C59.8929 54.7652 62 57.8174 62 61V67" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <div class="text-gray-800 dark:text-white pl-12 w-1/2">
                        <h1 class="font-bold text-2xl lg:text-5xl tracking-1px">450</h1>
                        <h2 class="text-base lg:text-lg mt-4 leading-8 tracking-wide">Customer</h2>
                    </div>
                </div>
                <div class="flex justify-center w-full lg:border-r border-gray-300 py-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="72" height="57" viewBox="0 0 72 57" fill="none">
                        <path d="M54.9999 54.9998C59.1815 54.9998 62.5713 51.6099 62.5713 47.4283C62.5713 43.2468 59.1815 39.8569 54.9999 39.8569C50.8183 39.8569 47.4285 43.2468 47.4285 47.4283C47.4285 51.6099 50.8183 54.9998 54.9999 54.9998Z" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M39.8571 47.4285H9.57142H2V5.78571C2 4.78168 2.39885 3.81877 3.10881 3.10881C3.81877 2.39885 4.78168 2 5.78571 2H39.8571V24.7142M39.8571 47.4285V24.7142M39.8571 47.4285H62.5713H70.1427V24.7142M24.7142 47.4285H47.4285M70.1427 24.7142H39.8571M70.1427 24.7142L58.7856 5.78571H39.8571" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M20.9285 13.3569V28.4998M13.3571 20.9283H28.5H13.3571Z" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M17.1427 54.9998C21.3243 54.9998 24.7142 51.6099 24.7142 47.4283C24.7142 43.2468 21.3243 39.8569 17.1427 39.8569C12.9612 39.8569 9.57133 43.2468 9.57133 47.4283C9.57133 51.6099 12.9612 54.9998 17.1427 54.9998Z" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <div class="text-gray-800 dark:text-white w-1/2 pl-12">
                        <h1 class="font-bold text-2xl lg:text-5xl tracking-1px">10+</h1>
                        <h2 class="text-base lg:text-lg mt-4 leading-8 tracking-wide">Products Sold</h2>
                    </div>
                </div>
                <div class="flex justify-center w-full py-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="72" height="79" viewBox="0 0 72 79" fill="none">
                        <path d="M10.5 63.1375L2 58.5312V48.0625" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M2 31.3123V20.8435L10.5 16.2373" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M27.5 6.60624L36 2L44.5 6.60624" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M61.5 16.2373L70 20.8435V31.3123" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M70 48.0625V58.5312L61.5 63.2212" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M44.5 72.7686L36 77.3748L27.5 72.7686" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M36.0001 39.6873L44.5001 35.0811" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M61.5 25.45L70 20.8438" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M36.0001 39.6875V50.1562" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M36.0001 66.9062V77.375" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M36 39.6875L27.5 34.9976" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.5 25.45L2 20.8438" stroke="#805AD5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <div class="text-gray-800 dark:text-white w-1/2 pl-12">
                        <h1 class="font-bold text-2xl lg:text-5xl tracking-1px">530</h1>
                        <h2 class="text-base lg:text-lg mt-4 leading-8 tracking-wide">Products Listed</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full my-2 sm:px-6">
            <div class="px-4 md:px-10 py-4 md:py-7 bg-gray-100 rounded-tl-lg rounded-tr-lg">
                <div class="sm:flex items-center justify-between">
                    <p class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">
                        Activity
                    </p>
                </div>
            </div>
            <div
                class="bg-white shadow px-4 md:px-10 pt-4 md:pt-7 pb-5 overflow-y-auto"
            >
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800">
                            <th class="font-normal text-left pl-4">User</th>
                            <th class="font-normal text-left pl-12">Action</th>
                            <th class="font-normal text-left pl-12">Module</th>
                            <th class="font-normal text-left pl-12">Description</th>
                        </tr>
                    </thead>
                    <tbody class="w-full">
                        <tr v-for="activity in activities" tabindex="0" class="focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white hover:bg-gray-100 border-b border-t border-gray-100">
                            <td class="pl-4">
                                <p class="text-sm font-medium leading-none text-gray-800">{{ activity.user.name }}</p>
                            </td>
                            <td class="pl-12">
                                <p class="text-sm font-medium leading-none text-gray-800">{{ activity.module }}</p>
                            </td>
                            <td class="pl-12">
                                <p class="text-sm font-medium leading-none text-gray-800">{{ activity.module }}</p>
                            </td>
                            <td class="pl-12">
                                <p class="text-sm font-medium leading-none text-gray-800">{{ activity.description }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
