<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="font-roboto font-bold text-[#80041c] text-center text-[25px] mb-8">Create Account</div>

        <div class="mb-4 text-[14px] text-gray-700 text-center">
            Please enter the following details to create an account.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name:" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full rounded-sm border-gray-300"
                    placeholder="Name"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4 mb-8">
                <InputLabel for="email" value="Email:" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-sm border-gray-300"
                    placeholder="Email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="text-[13px] text-gray-900 text-left px-2">
                Minimum 6 Characters and 1 number.
            </div>

            <div class="mt-1">
                <InputLabel for="password" value="Password:" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full rounded-sm border-gray-300"
                    placeholder="Password"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Verify Password:" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full rounded-sm border-gray-300"
                    placeholder="Verify Password"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex mt-4 w-full justify-between">
                <label class="flex items-center">
                    <div class="font-roboto text-[13px]"> I have read and accepted the </div>
                    <span class="font-roboto font-bold text-[13px] pl-1"> Terms & Conditions</span>
                </label>
                <div class="justify-end">
                        <Checkbox name="terms" v-model:checked="form.terms" />
                </div>
            </div>

            <div class="flex mt-4 w-full justify-between">
                <label class="flex items-center">
                    <div class="font-roboto text-[13px]"> I have read and Understood the </div>
                    <span class="font-roboto font-bold text-[13px] pl-1">Privacy Policy</span>
                </label>
                <div class="justify-end">
                        <Checkbox name="privacy" v-model:checked="form.privacy" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="mb-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>

            <div class="flex items-center justify-center mt-4">
                <div 
                class="w-full border-[1px] 
                bg-white border-[#80041c] 
                p-1 
                text-[18px] 
                text-center
                font-roboto 
                text-[#80041c] 
                hover:bg-[#80041c] 
                hover:text-white 
                hover:underline 
                hover:font-bold 
                cursor-pointer">
                    <Link :href="route('login')">
                        Back to Log In page
                    </Link>
                </div>
            </div>
            
        </form>
    </GuestLayout>
</template>
