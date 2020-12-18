
<template>
  <div>
    <div class="section">
      <h3 class="title">{{ pageTitle }}</h3>
      <div class="row">
        <div class="col-md-12">
          <VmOrder :order="orderDetail"></VmOrder>
          <div class="clearfix">&nbsp;</div>
          <div class="clearfix">&nbsp;</div>
          <div class="clearfix">&nbsp;</div>
          <div class="order-details">
            <div class="text-center">
              <h3 class="title">Order Detail</h3>
            </div>
            <table class="table table-hover" width="100%">
              <thead class="thead-dark">
              <tr>
                <th scope="col">Detail ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Short Description</th>
                <th scope="col">Product Image</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="detail in orderDetail.detail" :key="detail.id">
                <th scope="row">#{{ detail.id }}</th>
                <td>{{ detail.name }}</td>
                <td>{{ detail.short }}</td>
                <td><img width="110" :src="getThumb(detail.thumb)" :alt="detail.name" /></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VmOrder from '@/components/Orders';
export default {
  name: 'order_detail-id',
  validate ({ params }) {
    return /^\d+$/.test(params.id)
  },
  components: { VmOrder },
  data () {
    return {
      pageTitle: 'Order Detail Page',
      orderDetail: {},
      orderId: this.$route.params.id
    };
  },
  created () {
    this.$store.commit('setLoading', true)
    this.getOrder()
    this.$store.commit('setLoading', false)
  },
  methods: {
    async getOrder() {
      const res = await this.$store.dispatch('getOrderById', this.orderId)
      this.orderDetail = (res.statusCode === 200) ? res.data : {}
    },
    getThumb (thumb) {
      return !thumb ? 'https://bulma.io/images/placeholders/1280x960.png' : ('/'+ thumb)
    }
  }
}
</script>

<style scoped>

</style>
