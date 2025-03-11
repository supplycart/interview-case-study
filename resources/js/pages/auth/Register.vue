<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';

const form = useForm({
    name: '',
    email: '',
    phone_no: '',
    address_line_1: '',
    address_line_2: '',
    address_line_3: '',
    is_member: 'no',
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
    <AuthBase title="Create an account" description="Enter your details below to create your account">
        <Head title="Register" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Name <span class="text-red-500">*</span></Label>
                    <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Full name" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email address <span class="text-red-500">*</span></Label>
                    <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="phone_no">Phone No. <span class="text-red-500">*</span></Label>
                    <Input id="phone_no" type="phone_no" required :tabindex="3" autocomplete="phone_no" v-model="form.phone_no" placeholder="0123456789" />
                    <InputError :message="form.errors.phone_no" />
                </div>

                <div class="grid gap-2">
                    <Label for="address_line_1">Address Line 1 <span class="text-red-500">*</span></Label>
                    <Input id="address_line_1" type="address_line_1" required :tabindex="4" autocomplete="address_line_1" v-model="form.address_line_1" placeholder="Enter address here" />
                    <InputError :message="form.errors.address_line_1" />
                </div>

                <div class="grid gap-2">
                    <Label for="address_line_2">Address Line 2</Label>
                    <Input id="address_line_2" type="address_line_2" :tabindex="5" autocomplete="address_line_2" v-model="form.address_line_2" placeholder="(optional)" />
                    <InputError :message="form.errors.address_line_2" />
                </div>

                <div class="grid gap-2">
                    <Label for="address_line_3">Address Line 3</Label>
                    <Input id="address_line_3" type="address_line_3" :tabindex="6" autocomplete="address_line_3" v-model="form.address_line_3" placeholder="(optional)" />
                    <InputError :message="form.errors.address_line_3" />
                </div>

                <div class="grid gap-2">
                    <Label for="is_member">Is Member <span class="text-red-500">*</span></Label>
                    <Select v-model="form.is_member">
                        <SelectTrigger :tabindex="7" >
                            <SelectValue placeholder="Are you a current member of Supply Cart?"/>
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem value="yes">Yes</SelectItem>
                                <SelectItem value="no">No</SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.is_member" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Password <span class="text-red-500">*</span></Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="8"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirm password <span class="text-red-500">*</span></Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="9"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm password"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="10" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Create account
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="11">Log in</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
