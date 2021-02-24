<template>
        <div>
            <table class="min-w-full divide-y divide-gray-100 shadow-sm border-gray-200 border">
                <thead>
                    <tr>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b"></th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Name</th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Email</th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Joined</th>
                        <th scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b">Total Orders</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <tr v-for="(user,index) in users" @key="index">
                        <td class="px-3 py-2 whitespace-no-wrap">{{index+1}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{user.name}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{user.email}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{user.created_at}}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{user.orders.length}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                users : []
            }
        },
        beforeMount() {
            axios.get('/api/users/').then(response => this.users = response.data)
        }
    }
    </script>