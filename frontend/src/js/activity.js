import Vue from 'vue';

export default {
  send(activity) {
    let data = { activity: activity, userid: Vue.$cookies.get('user').id, datetime: new Date() };
    Vue.prototype.$axios.post('/Activity/Add', data);
  }
}