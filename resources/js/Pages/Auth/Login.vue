<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        
        <div class="font-roboto font-bold text-[#80041c] text-center text-[25px] mb-10">Log In to your Account</div>
        <form @submit.prevent="submit">

            
            <div>
                <InputLabel for="email" value="Email:"/>

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-sm border-gray-300"
                    placeholder="Email Address"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-5">
                <InputLabel for="password" value="Password:"/>

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full rounded-sm border-gray-300"
                    placeholder="Password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex mt-1 justify-end">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="font-sans text-gray-900 text-[14px] hover:text-[#80041c] hover:underline"
                >
                    Reset Password
                </Link>
            </div>

            <div class="justify-center text-center my-5">

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log In
                </PrimaryButton>
            </div>
        </form>

        <hr class="border-[#80041c] mt-2">
        <br>
        <div class="justify-center text-center">
            <div class="font-roboto font-bold">New to MUJI Online?</div>
            <div class="font-roboto text-[13px] my-4">MUJI Online now has an Account feature that let's you manage your order details and delivery addresses to make your checkout faster.</div>
            <div 
            class="border-[1px] 
            bg-white border-[#80041c] 
            p-1 
            text-[18px] 
            font-roboto 
            text-[#80041c] 
            hover:bg-[#80041c] 
            hover:text-white 
            hover:underline 
            hover:font-bold 
            cursor-pointer">
                <Link :href="route('register')">
                    Create Account
                </Link>
            </div>
        </div>
    </GuestLayout>
</template>
