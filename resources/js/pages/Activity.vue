<template>
  <div>

    <div class="container mx-auto h-screen text-gray-800 flex flex-wrap">

      <div class="w-full lg:w-3/12 flex-0 p-5">
        Sidebar

      </div>
      <div class="w-full lg:w-9/12 flex-0 p-5 bg-white shadow-lg rounded-b-lg">
        <h2>Activity History</h2>
        <div class="pt-4">
          <table class="table-fixed">
            <thead>
            <tr>
              <td></td>
              <td class="font-semibold text-gray-600 text-xs text-center w-1/2">User Agent</td>
              <td class="font-semibold text-gray-600 text-xs text-center w-1/4">Action</td>
              <td class="font-semibold text-gray-600 text-xs text-center w-1/4">Date</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in activities" :key="order.id">
              <td></td>
              <td class="text-center">{{ order.properties.user_agent }}</td>
              <td class="text-center">{{ order.description }}</td>
              <td class="text-center">{{ formatDate(order.created_at) }}</td>
            </tr>

            </tbody>
          </table>
        </div>
        <pagination :pagination="pagination" @paginate="fetchActivities" :offset="4"/>
      </div>


    </div>

  </div>
</template>

<script>
import Pagination from "../components/Pagination";
import axios from "axios";

const dayjs = require('dayjs');
const localizedFormat = require('dayjs/plugin/localizedFormat')
dayjs.extend(localizedFormat);

export default {
  components: {pagination: Pagination},

  middleware: 'auth',

  metaInfo() {
    return {title: "Home"}
  },
  data() {

    return {

      activities: [],
      offset: 4,
      pagination: {},
    }
  },

  computed: {},

  async created() {
    this.fetchActivities();
  },
  methods: {
    formatDate(val) {
      return dayjs(val).format('LLL');
    },
    fetchActivities: function () {
      let current_page = this.pagination.current_page;
      let page_number = current_page ? current_page : 1;
      let filter = this.serialize(this.filter);
      axios.get('/api/activities?page=' + page_number + '&' + filter).then(response => {
        this.pagination = response.data.pagination;
        this.activities = response.data.activities;
        console.log(this.activities)
      })
          .catch(error => console.log(error))
    },
    serialize: function (obj, prefix) {
      var str = [],
          p;
      for (p in obj) {
        if (obj.hasOwnProperty(p)) {
          var k = prefix ? prefix + "[" + p + "]" : p,
              v = obj[p];
          str.push((v !== null && typeof v === "object") ?
              this.serialize(v, k) :
              k + "=" + encodeURIComponent(v));
        }
      }
      return str.join("&");
    },
  }
}
</script>
