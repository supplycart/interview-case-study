<template>
  <div class="p-3 w-full">
    <div class="font-bold sm:text-xl text-sm">{{ history.length }} orders</div>
    <div class="mb-2 sm:text-xl text-sm">RM {{ history.reduce((a, b) => { return a + b['price'] }, 0).toFixed(2) }}</div>
    <div v-for="(hist, histIndex) in history" :key="histIndex" class="mb-2 border border-solid border-gray-600 p-3">
      <div class="font-bold sm:text-lg text-sm">Order on : {{ hist['date'].getDate() }}/{{ hist['date'].getMonth() + 1 }}/{{ hist['date'].getFullYear() }} {{ hist['date'].getHours() }}:{{ hist['date'].getMinutes() }}:{{ hist['date'].getSeconds() }}</div>
      <div class="font-bold sm:text-lg text-sm">Paid : RM {{ hist['price'].toFixed(2) }}</div>
      <div v-for="(order, orderIndex) in hist['orders']" :key="orderIndex" class="ml-3">
        ·  {{ order['name'] }} - {{ order['size'] }} {{ order['quantity'] }} pcs
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      history: []
    }
  },
  props: {
  },
  methods: {
  },
  async mounted() {
    this.history = (await this.$axios.get(`/Orders/History?userid=${this.$cookies.get('user').userID}`)).data;
    this.history.forEach((h) => {
      let date = new Date(h['orderat']).getTime();
      h['date'] = new Date(date + (8 * 60 * 60 * 1000));
    });
  }
};
</script>

<style lang="scss" scoped>

</style>