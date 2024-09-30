<script setup>
import { Head, useForm } from '@inertiajs/vue3'

import { Button } from '@/Components/ui/button'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { useToast } from '@/Components/ui/toast/use-toast'
import AppLayout from '@/Layouts/AppLayout.vue'

const { toast } = useToast()

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset(['password', 'password_confirmation']),
                toast({
                    title: 'Looks good to us!',
                    description:
                        "We'll need to verify your email. Check your inbox!",
                })
        },
        onError: () => {
            if (Object.keys(form.errors).length !== 0) {
                toast({
                    title: 'Oops, there was an issue logging you in.',
                    description: Object.values(form.errors).flat().join(' '),
                    variant: 'destructive',
                })
            }
        },
    })
}
</script>

<template>
    <Head title="Sign Up" />
    <AppLayout>
        <form @submit.prevent="submit">
            <div
                class="w-full lg:grid lg:min-h-[600px] lg:grid-cols-2 xl:min-h-[800px]"
            >
                <div class="flex items-center justify-center py-12">
                    <div class="mx-auto grid w-[350px] gap-6">
                        <div class="grid gap-2 text-center">
                            <h1 class="text-3xl font-bold">Sign Up</h1>
                            <p class="text-balance text-muted-foreground">
                                Enter your email below to create your account
                            </p>
                        </div>
                        <div class="grid gap-4">
                            <div class="grid gap-2">
                                <Label for="email">Name</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    placeholder="John Doe"
                                    v-model="form.name"
                                    required
                                />
                            </div>
                            <div class="grid gap-2">
                                <Label for="email">Email</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    placeholder="m@example.com"
                                    v-model="form.email"
                                    required
                                />
                            </div>
                            <div class="grid gap-2">
                                <div class="flex items-center">
                                    <Label for="password">Password</Label>
                                </div>
                                <Input
                                    id="password"
                                    type="password"
                                    v-model="form.password"
                                    required
                                />
                            </div>
                            <div class="grid gap-2">
                                <div class="flex items-center">
                                    <Label for="password"
                                        >Confirm Password</Label
                                    >
                                </div>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    v-model="form.password_confirmation"
                                    required
                                />
                            </div>
                            <Button type="submit" class="w-full"
                                >Sign up</Button
                            >
                        </div>
                        <div class="mt-4 text-center text-sm">
                            Already have an account?
                            <a href="/" class="underline">Sign in</a>
                        </div>
                    </div>
                </div>
                <div class="hidden bg-muted lg:block">
                    <img
                        src="/placeholder.webp"
                        alt="Hero"
                        class="h-screen w-full object-cover object-bottom dark:brightness-[0.2] dark:grayscale"
                    />
                </div>
            </div>
        </form>
    </AppLayout>
</template>
