
<template>
  <div>
    <table class="table table-hover" width="100%">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">Total Amount</th>
          <th scope="col">Your Address</th>
          <th scope="col">Order Status</th>
          <th scope="col">Order Dated</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">
            <nuxt-link
                title="View Details"
                class="details btn btn-outline-primary"
                :to="{
                name: 'order_detail-id',
                params: { id: order.id }
              }">#{{ order.id }}
            </nuxt-link>
          </th>
          <td>${{ order.total_amount }}</td>
          <td>{{ order.address }}</td>
          <td>{{ order.status }}</td>
          <td>{{ order.created_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'orders',
  props: ['order']
}
</script>

<style scoped>

</style>
