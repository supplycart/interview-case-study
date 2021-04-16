<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">Welcome back!</div>
        </div>
      </div>
    </div>

    <div class="pb-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-2">Purchases</h1>
            <table class="table-auto w-full">
              <thead>
                <tr class="border-b">
                  <th class="p-2">ID</th>
                  <th class="p-2">Fulfillment</th>
                  <th class="p-2">Created</th>
                  <th class="p-2"></th>
                </tr>
              </thead>

              <tbody v-if="orders && orders.length > 0">
                <tr v-for="order in orders" :key="order.id">
                  <td class="p-2 text-center">{{ order.id }}</td>
                  <td class="p-2 text-center">{{ order.fulfilled }}</td>
                  <td class="p-2 text-center">{{ order.created_at }}</td>
                  <td class="p-2 text-center">
                    <inertia-link
                      class="w-max p-2 mx-2 sm:rounded-lg shadow-sm bg-indigo-400 text-white"
                      :href="route('order.show', { id: order.id })"
                    >
                      View
                    </inertia-link>
                  </td>
                </tr>
              </tbody>

              <tbody v-else>
                <tr>
                  <td class="text-center p-2" colspan="4">No orders.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="pb-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-2">Activities</h1>
            <table class="table-auto w-full">
              <thead>
                <tr class="border-b">
                  <th class="p-2">Action</th>
                  <th class="p-2">Created</th>
                </tr>
              </thead>

              <tbody v-if="logs && logs.length > 0">
                <tr v-for="log in logs" :key="log.id">
                  <td class="p-2 text-center">{{ log.action }}</td>
                  <td class="p-2 text-center">{{ log.created_at }}</td>
                </tr>
              </tbody>

              <tbody v-else>
                <tr>
                  <td class="text-center p-2" colspan="3">No action.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";

export default {
  components: {
    BreezeAuthenticatedLayout,
  },

  props: {
    orders: Array,
    logs: Array,
  },
};
</script>
