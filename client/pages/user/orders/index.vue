<template>
  <div class="section">
    <h3 class="title">{{ pageTitle }}</h3>
    <div class="row">
      <div class="col-md-12" v-for="order in orders" :key="order.id">
        <VmOrdersList :order="order"></VmOrdersList>
      </div>
      <div class="section" v-if="orders.length === 0">
        <p>{{ noOrderLabel }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import VmOrdersList from '@/components/Orders';

export default {
	name: 'user-orders',

	data () {
    return {
      pageTitle: 'Your Orders History',
      noOrderLabel: 'Your orders is empty',
      orders: []
    }
  },
  components: { VmOrdersList },
  created() {
    this.$store.commit('setLoading', true)
    this.getOrders()
    this.$store.commit('setLoading', false)
  },
  methods: {
    async getOrders() {
      const res = await this.$store.dispatch('getOrders')
      this.orders = (res.statusCode === 200) ? res.data : []
    }
  }
}
</script>

<style lang="scss" scoped>
  .card {
    margin: 10px;
  }
</style>


