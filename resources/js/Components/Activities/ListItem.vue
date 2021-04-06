<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ activity.created_at_new }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ activity.description_new }}</div>
        </td>
    </tr>
</template>

<script>

export default {
    props: ['activity'],
}
</script>
