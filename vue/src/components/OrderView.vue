<template>
    <div
   >
    <table
    class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5 ">
        <tbody>
        <tr>
        <td class="font-bold py-1 px-2">Order #</td>
        <td>{{ order.id }}</td>
        </tr>
        <tr>
        <td class="font-bold py-1 px-2">Order Date</td>
        <td>{{ order.created_at }}</td>
        </tr>
        <tr>
        <td class="font-bold py-1 px-2">Order Status</td>
        <td v-if="order.delivered == 0">
            Not Delivered
        </td>
        <td v-else>
            Delivered
        </td>
        </tr>
        <tr>
        <td class="font-bold py-1 px-2">SubTotal</td>
        <td>RM{{ order.total}}</td>
        </tr>
        </tbody>
    </table>
    </div>
<!--/  Order Details-->
</template>

<script setup>
import store from "../store";
const { order } = defineProps({
    order: Object,
});


</script>

<style></style>
