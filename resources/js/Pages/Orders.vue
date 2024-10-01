<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import axios from 'axios'
import { computed, onMounted, ref } from 'vue'

import { Button } from '@/Components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import { Label } from '@/Components/ui/label'
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/Components/ui/number-field'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import { useToast } from '@/Components/ui/toast/use-toast'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { useOrderStore } from '@/Stores/orderStore'

// Setup reactive products list and user tier
const orderStore = useOrderStore()
const orders = computed(() => orderStore.orders)

const user = usePage().props.auth.user

const { toast } = useToast()
</script>

<template>
    <Head title="Orders" />

    <AuthenticatedLayout>
        <!-- No orders available -->
        <div
            v-if="orders?.orders?.length === 0"
            class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm"
        >
            <div class="flex flex-col items-center gap-1 text-center">
                <h3 class="text-2xl font-bold tracking-tight">
                    You have no orders
                </h3>
            </div>
        </div>

        <div v-else>
            <Card>
                <CardHeader
                    class="flex flex-col md:flex-row justify-between gap-4 md:gap-1.5 items-center"
                >
                    <div class="flex flex-col gap-2">
                        <CardTitle>Orders</CardTitle>
                        <CardDescription>
                            Here are a list of orders that you've made.
                        </CardDescription>
                    </div>
                </CardHeader>
                <CardContent>
                    <Card>
                        <CardHeader
                            class="flex flex-col md:flex-row justify-between gap-4 md:gap-1.5 items-center"
                        >
                            <div class="flex flex-col gap-2 w-full">
                                <CardTitle
                                    class="flex flex-row justify-between items-center"
                                >
                                    <span> Order #{{}} </span>
                                    <span class="text-muted-foreground text-sm">
                                        {{ new Date().toLocaleString() }}
                                    </span>
                                </CardTitle>
                                <CardDescription>
                                    <span>{{}}</span>
                                </CardDescription>
                            </div>
                        </CardHeader>
                        <CardContent></CardContent>
                    </Card>
                </CardContent>
            </Card>
        </div>
    </AuthenticatedLayout>
</template>
