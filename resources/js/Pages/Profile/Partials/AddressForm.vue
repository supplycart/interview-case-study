<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    addr1: '',
    addr2: '',
    city: '',
    postcode: '',
    country: '',
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Address Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's address information.
            </p>
        </header>

        <form @submit.prevent="form.post(route('profile.store'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Billing Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="addr1" value="Address" />

                <TextInput
                    id="addr1"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.addr1"
                    required
                    autocomplete="addr1"
                />

                <InputError class="mt-2" :message="form.errors.addr1" />
            </div>

            <div>
                <TextInput
                    id="addr2"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.addr2"
                    required
                    autocomplete="addr2"
                />

                <InputError class="mt-2" :message="form.errors.addr2" />
            </div>

            <div>
                <InputLabel for="city" value="City" />

                <TextInput
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    required
                    autocomplete="city"
                />

                <InputError class="mt-2" :message="form.errors.city" />
            </div>

            <div>
                <InputLabel for="postcode" value="Post Code" />

                <TextInput
                    id="postcode"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.postcode"
                    required
                    autocomplete="postcode"
                />

                <InputError class="mt-2" :message="form.errors.postcode" />
            </div>

            <div>
                <InputLabel for="country" value="Country" />

                <select 
                v-model="form.country"
                class="m-2"
                name="country" 
                id="country">
                    <option selected value="United Kingdom">United Kingdom</option>
                </select>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
