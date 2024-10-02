<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ChevronLeft } from 'lucide-vue-next'
import { computed } from 'vue'

import { Button } from '@/Components/ui/button'
import {
    Card,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
    status: {
        type: String,
    },
})

const form = useForm({})

const submit = () => {
    form.post(route('verification.send'))
}

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent'
)
</script>

<template>
    <Head title="Email Verification" />

    <AppLayout>
        <div class="container">
            <div class="flex flex-col items-center justify-center h-[100dvh]">
                <form @submit.prevent="submit">
                    <Card class="w-full max-w-[380px]">
                        <CardHeader>
                            <CardTitle
                                class="flex flex-row justify-between text-center"
                            >
                                <Link class="w-fit" href="/">
                                    <ChevronLeft />
                                </Link>
                                You're one step closer!
                                <span></span>
                            </CardTitle>
                            <CardDescription class="text-center mt-4">
                                We've sent you a verification email. Do check
                                your inbox or spam for it!

                                <p
                                    v-if="verificationLinkSent"
                                    class="mt-8 font-medium text-green-600"
                                >
                                    A new verification link has been sent to the
                                    email address you provided during
                                    registration.
                                </p>
                            </CardDescription>
                        </CardHeader>
                        <CardFooter class="flex flex-col items-center">
                            <Button
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Re-send Verification Email
                            </Button>
                        </CardFooter>
                    </Card>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
