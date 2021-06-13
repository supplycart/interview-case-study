<template>
  <div class="w-full p-3">
    <div class="sm:text-2xl text-lg font-bold mb-3">Found {{ allActivities.length }} activities</div>
    <div v-if="loading" class="flex items-center">
      <div class="border-spin rounded-full border-2 h-5 w-5 sm:h-8 sm:w-8 animate-spin"></div>
      <div class="sm:text-xl font-bold ml-3">Getting Activities</div>
    </div>
    <div v-for="(act, actIndex) in allActivities" :key="actIndex" class="border border-gray-500 border-solid mb-3 p-3">
      <div>At : {{ act['dateFormat'] }}</div>
      <div>You : {{ act['activity'] }}</div>  
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      loading: false,
      allActivities: []
    }
  },
  props: {
  },
  methods: {
  },
  async mounted() {
    this.loading = true;
    this.allActivities = (await this.$axios.get(`/Activity/Get?id=${this.$cookies.get('user').id}`)).data;
    this.allActivities.forEach((a) => {
      let date = new Date(a['datetime']).getTime();
      let dateInMY = new Date(date + (8 * 60 * 60 * 1000));
      a['dateFormat'] = `${dateInMY.getDate()}/${dateInMY.getMonth() + 1}/${dateInMY.getFullYear()} ${dateInMY.getHours()}:${dateInMY.getMinutes()}:${dateInMY.getSeconds()}`;
    });
    this.loading = false;
  }
};
</script>

<style lang="scss" scoped>

</style>