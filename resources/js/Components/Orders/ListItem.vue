<template>
    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden px-2 py-1 text-s font-bold uppercase">Order #:</span>
            <div class="text-sm text-gray-900">{{ order.order_number }}</div>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden px-2 py-1 text-xs font-bold uppercase">Created at:</span>
            <div class="text-sm text-gray-900">{{ order.created_at }}</div>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden px-2 py-1 text-xs font-bold uppercase">Sent to:</span>
            <div class="text-sm text-gray-900 whitespace-pre text-sm">
                {{ order.formatted_shipping_info }}
            </div>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden px-2 py-1 text-xs font-bold uppercase">Status:</span>
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 uppercase">
              {{ order.status }}
            </span>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden px-2 py-1 text-xs font-bold uppercase">Total</span>
            <div class="text-sm text-gray-900">${{ order.total }}</div>
            <div class="text-sm text-gray-500">{{ order.item_count }} item(s)</div>
        </td>
    </tr>
</template>

<script>

export default {
    props: ['order'],
}
</script>
