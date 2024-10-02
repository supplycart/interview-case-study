<script setup>
import { computed } from 'vue'

import { TableBody, TableCell, TableRow } from '@/Components/ui/table'

// Define Props
const props = defineProps({
    order_items: Array,
})

const order_items = computed(() => props.order_items)
</script>

<template>
    <TableBody v-for="item in order_items" :key="item.product_id">
        <TableRow>
            <TableCell class="sm:table-cell">
                <img
                    alt="Product image"
                    class="aspect-square rounded-md object-cover min-w-[64px]"
                    height="64"
                    src="https://picsum.photos/100"
                    width="64"
                />
            </TableCell>
            <TableCell class="font-medium">
                {{ item?.product_name }}
            </TableCell>
            <TableCell>
                {{ item?.product_brand }}
            </TableCell>
            <TableCell>
                {{ item?.product_category }}
            </TableCell>
            <TableCell>
                {{
                    new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: item?.price?.currency || 'USD',
                    }).format(item?.price?.amount || 0)
                }}
            </TableCell>
            <TableCell>
                {{ item?.quantity }}
            </TableCell>
        </TableRow>
    </TableBody>
</template>
