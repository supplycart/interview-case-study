
<script setup async lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import CartItem from '../components/CartItem.vue';
const props = defineProps({
    data: {
        type: Array
    },
});
const form = useForm(props.data);
const submit = () => {
    form.post(route('place_order'));
};

</script>

<template>
    <Head title="Shopping Cart" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div v-if="$page.props.data">
                    <div v-for="(item, index) in data" class="align-top">
                        <CartItem :item="item"/>
                    </div>
                </div>
                <div v-else>
                    No items added to shopping cart
                </div>
            </div>
                <div v-if="$page.props.data">
                    <form @submit.prevent="submit" class="flex flex-col gap-6">
                        <Button
                            type="submit" 
                            variant="ghost"
                            size="icon"
                            class=" size-10 w-auto rounded-full p-1 focus-within:ring-2 focus-within:ring-primary left-9"
                        >
                        Place Order
                        </Button>
                    </form>

                </div>
        </div>
    </AppLayout>
</template>