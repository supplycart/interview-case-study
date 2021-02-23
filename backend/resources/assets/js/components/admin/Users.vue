<template>
    <div class="flex flex-col max-w-full overflow-x-hidden shadow-md">
        <table class="overflow-x-auto w-full bg-white">
            <thead class="bg-blue-100 border-b border-gray-300">
                <tr>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Id
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Name
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Email
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Joined
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Total Orders
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
                <tr v-for="(user, index) in users" :key="index">
                    <td class="p-4 whitespace-nowrap">{{ index + 1 }}</td>
                    <td class="p-4 whitespace-nowrap">{{ user.name }}</td>
                    <td class="p-4 whitespace-nowrap">{{ user.email }}</td>
                    <td class="p-4 whitespace-nowrap">{{ user.created_at }}</td>
                    <td class="p-4 whitespace-nowrap">
                        {{ user.orders.length }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import dayjs from 'dayjs';
export default {
    data() {
        return {
            users: [],
        };
    },
    beforeMount() {
        axios.get("/api/users/").then((response) => {
            if (response && response.data) {
                response.data.forEach(function (value) {
                    value.created_at = dayjs(value.created_at).format("DD/MM/YYYY hh:mm:ss");

                });
            }
            this.users = response.data;
        });
    },
};
</script>
