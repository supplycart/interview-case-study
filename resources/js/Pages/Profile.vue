<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-2">Details</h1>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h2 class="text-lg font-bold">Name</h2>
                {{ user.name }}
              </div>
              <div>
                <h2 class="text-lg font-bold">Email</h2>
                {{ user.email }}
              </div>
              <div>
                <h2 class="text-lg font-bold">Rank</h2>
                {{ getCurrentRankName }}
              </div>
              <div>
                <h2 class="text-lg font-bold">Verified</h2>
                <span
                  v-if="user.email_verified_at"
                  class="font-bold text-green-500"
                  >Yes ({{ formatDate(user.email_verified_at) }})</span
                >
                <span v-else class="font-bold text-red-500">No</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pb-12">
      <div class="max-2-7xl mx-auto smLpx-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-2">Rank Upgrade</h1>
            <select
              name="rank"
              id="rank"
              class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
              v-model="rank_id"
              @change="updateRank"
            >
              <option v-for="rank in ranks" :key="rank.id" :value="rank.id">
                {{ rank.name }}
              </option>
            </select>
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
    user: Object,
    ranks: Object,
  },

  data() {
    return {
      rank_id: Number,
    };
  },

  computed: {
    getCurrentRankName() {
      var rank = this.ranks.find((rank) => this.rank_id == rank.id);
      return typeof rank == "undefined" ? "-" : rank.name;
    },
  },

  methods: {
    updateRank() {
      axios
        .put(route("profile.upgrade"), {
          rank_id: this.rank_id,
        })
        .then((res) => {
          if (res.status === 200) {
            this.$swal("Done!", "Successfully changed rank", "success");
          }
        })
        .catch((err) => {
          this.$swal("Oops!", err.message, "error");
        });
    },

    formatDate(date) {
      return this.moment(date).format("YYYY-MM-DD HH:MM:SS");
    },
  },

  mounted() {
    this.rank_id = this.user.rank_id;
  },
};
</script>
