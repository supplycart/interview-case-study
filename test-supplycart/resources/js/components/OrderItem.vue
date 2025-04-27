<script setup lang="ts">

const props = defineProps({
    order_id: {
        type: String
    },
    order: {
        type: Array
    },
    grand_total: {
        type: Number
    }
});
console.log([props.grand_total]);
</script>

<template>
    <div class="grid content-center overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
        <p>Order ID: {{ order_id }}</p>
            <div v-for="(item, index) in order" class="align-top">
                <div v-if="index !== 'grand_total'" class="align-top">
                    <div class="grid content-center overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <p>Name: {{item.name }}</p>
                        <p>Quantity: {{ item.quantity }}</p>
                        <p>Total: {{ item.total }}</p>
                    </div>
                </div>
            </div>
        <p>Grand Total: {{ grand_total }}</p>
    </div>
    <br><br>
</template>
